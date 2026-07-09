<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class GameController extends Controller
{
    // Menampilkan semua game yang aktif (halaman "Discover"), dipaginasi
    public function index()
    {
        $games = Game::where('is_active', 'true')->paginate(12);
        return view('pages.allgames', compact('games'));
    }

    // Menampilkan game "Populer" di homepage, diurutkan dari jumlah
    // transaksi paid terbanyak (bukan sekadar daftar yang sama dengan Discover).
    // Game yang belum pernah laku tetap ikut tampil (sold_count 0) supaya
    // section ini tidak kosong di instalasi baru yang belum ada transaksi.
    public function populerIndex()
    {
        $games = Game::where('is_active', 'true')
            ->withCount(['details as sold_count' => function ($query) {
                $query->join('transactions', 'transactions.game_detail_id', '=', 'game_detail.id')
                    ->where('transactions.status', 'paid');
            }])
            ->orderByDesc('sold_count')
            ->take(6)
            ->get();

        return view('pages.home', compact('games'));
    }

    // Menampilkan detail game tertentu
    public function show($id)
    {
        $game = Game::findOrFail($id);
        $paymentMethods = PaymentMethod::where('is_active', 'true')->get();
        return view('pages.game', compact('game', 'paymentMethods'));
    }
}
