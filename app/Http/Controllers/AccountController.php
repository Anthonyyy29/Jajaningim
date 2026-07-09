<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
    public function edit(Request $request)
    {
        $user = $request->user();

        // Transaksi belum punya kolom user_id (checkout masih tamu, cuma minta email),
        // jadi riwayat di sini dicocokkan lewat email akun sebagai pendekatan terbaik saat ini.
        $transactions = Transaction::with(['game', 'gameDetail'])
            ->where('email', $user->email)
            ->latest()
            ->take(10)
            ->get();

        return view('pages.account', compact('user', 'transactions'));
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
        ]);

        $user->update($validated);

        return back()->with('status', 'Informasi akun berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $user->update(['password' => Hash::make($validated['password'])]);

        return back()->with('status', 'Password berhasil diperbarui.');
    }
}
