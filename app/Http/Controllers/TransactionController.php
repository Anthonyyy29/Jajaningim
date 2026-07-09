<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\GameDetail;
use App\Models\PaymentMethod;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Notification;
use Midtrans\Snap;

class TransactionController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function store(Request $request)
    {
        $game = Game::findOrFail($request->input('game_id'));

        $rules = [
            'game_id' => ['required', 'exists:games,id'],
            'detail_id' => ['required', 'exists:game_detail,id'],
            'payment_method' => ['required', 'exists:table_payment_method,id'],
            'email' => ['nullable', 'email'],
        ];

        foreach ($game->form_fields ?? [] as $field) {
            $rules[$field] = ['required', 'string', 'max:100'];
        }

        $validated = $request->validate($rules);

        $detail = GameDetail::where('game_id', $game->id)->findOrFail($validated['detail_id']);
        $paymentMethod = PaymentMethod::findOrFail($validated['payment_method']);

        $formData = collect($game->form_fields ?? [])
            ->mapWithKeys(fn ($field) => [$field => $validated[$field]])
            ->all();

        $orderId = 'JJN-'.now()->format('Ymd').'-'.Str::upper(Str::random(8));

        $transaction = Transaction::create([
            'order_id' => $orderId,
            'game_id' => $game->id,
            'game_detail_id' => $detail->id,
            'payment_method_id' => $paymentMethod->id,
            'form_data' => $formData,
            'email' => $validated['email'] ?? null,
            'amount' => $detail->price,
            'status' => 'pending',
        ]);

        $snapParams = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $detail->price,
            ],
            'customer_details' => [
                'email' => $transaction->email,
            ],
            'item_details' => [[
                'id' => (string) $detail->id,
                'price' => $detail->price,
                'quantity' => 1,
                'name' => "{$game->name} - {$detail->name}",
            ]],
            'credit_card' => [
                'secure' => true,
            ],
        ];

        // Batasi Snap ke metode yang dipilih customer di web (bukan Snap yang
        // nunjukin semua metode lagi) -- lihat PaymentMethod::midtrans_code.
        // Kalau kode belum diisi admin, key ini sengaja tidak disertakan sama
        // sekali (bukan null) supaya Snap fallback nunjukin semua metode aktif,
        // daripada checkout gagal total gara-gara payload tidak valid.
        if ($paymentMethod->midtrans_code) {
            $snapParams['enabled_payments'] = [$paymentMethod->midtrans_code];
        } else {
            Log::warning('midtrans.payment_method_missing_code', [
                'payment_method_id' => $paymentMethod->id,
                'metode_payment' => $paymentMethod->metode_payment,
            ]);
        }

        $snapResponse = Snap::createTransaction($snapParams);

        $transaction->update(['midtrans_snap_token' => $snapResponse->token]);

        Log::info('midtrans.snap_token_created', [
            'order_id' => $orderId,
            'amount' => $detail->price,
        ]);

        return redirect()->away($snapResponse->redirect_url);
    }

    /**
     * Midtrans hits this URL server-to-server when a transaction's status changes.
     * Notification::__construct re-fetches the status from Midtrans by transaction_id,
     * so the result is trusted even though the request itself is unauthenticated.
     */
    public function callback(Request $request)
    {
        $notification = new Notification();

        $transaction = Transaction::where('order_id', $notification->order_id)->first();

        if (! $transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        $status = $notification->transaction_status;
        $fraud = $notification->fraud_status;

        $resolvedStatus = match (true) {
            $status === 'capture' && $fraud === 'accept' => 'paid',
            $status === 'settlement' => 'paid',
            in_array($status, ['cancel', 'deny']) => 'failed',
            $status === 'expire' => 'expired',
            default => 'pending',
        };

        Log::info('midtrans.notification_received', [
            'order_id' => $notification->order_id,
            'payment_type' => $notification->payment_type,
            'transaction_status' => $status,
            'fraud_status' => $fraud,
            'resolved_status' => $resolvedStatus,
            'previous_status' => $transaction->status,
        ]);

        // A late/duplicate notification (e.g. a delayed "pending" after settlement already
        // landed) must never downgrade an already-paid transaction back to unpaid.
        if ($transaction->status === 'paid') {
            return response()->json(['message' => 'OK']);
        }

        $transaction->status = $resolvedStatus;
        $transaction->save();

        return response()->json(['message' => 'OK']);
    }

    public function show(string $orderId)
    {
        $transaction = Transaction::with(['game', 'gameDetail', 'paymentMethod'])
            ->where('order_id', $orderId)
            ->firstOrFail();

        return view('pages.transaction-status', compact('transaction'));
    }

    /**
     * Shared target for Midtrans dashboard Finish/Unfinish/Error Redirect URLs.
     * Midtrans appends order_id as a query param on redirect; the real status is
     * always re-read from our own DB on the status page, never trusted from the query string.
     */
    public function redirectAfterPayment(Request $request)
    {
        $orderId = $request->query('order_id');

        if ($orderId && Transaction::where('order_id', $orderId)->exists()) {
            return redirect()->route('transaction.show', $orderId);
        }

        return redirect()->route('home');
    }
}
