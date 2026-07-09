<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    // =========================================================
    // TAMPILKAN HALAMAN LOGIN
    // Dipanggil saat user buka GET /login.
    // Hanya mengembalikan view, tidak ada logika di sini.
    // =========================================================
    public function showLogin()
    {
        return view('pages.login');
    }

    // =========================================================
    // PROSES LOGIN
    // Dipanggil saat user submit form login (POST /login).
    //
    // Alur:
    // 1. Validasi input — email harus format email, password wajib ada
    // 2. Auth::attempt() — Laravel cek email & password ke tabel users
    //    - Jika cocok: session dibuat, user dianggap login
    //    - Jika tidak: kembalikan error
    // 3. session()->regenerate() — ganti session ID lama dengan baru
    //    (mencegah session fixation attack)
    // 4. redirect()->intended() — kirim user ke halaman yang
    //    sebelumnya ingin dibuka, atau ke home kalau tidak ada
    // =========================================================
    public function login(Request $request)
    {
        // Validasi input dari form
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Coba login dengan kredensial yang diberikan
        // Parameter ke-2 (remember) untuk fitur "ingat saya"
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('home'));
        }

        // Kalau login gagal, kembali ke form dengan pesan error
        // onlyInput('email') → password tidak ikut dikembalikan ke form (keamanan)
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // =========================================================
    // TAMPILKAN HALAMAN REGISTER
    // Dipanggil saat user buka GET /register.
    // =========================================================
    public function showRegister()
    {
        return view('pages.register');
    }

    // =========================================================
    // PROSES REGISTER
    // Dipanggil saat user submit form registrasi (POST /register).
    //
    // Alur:
    // 1. Validasi input:
    //    - name     : wajib, string, maks 100 karakter
    //    - email    : wajib, format email, harus unik di tabel users
    //    - password : wajib, minimal 8 karakter, harus sama dengan
    //                 field password_confirmation (aturan 'confirmed')
    // 2. Buat user baru di database
    //    - Hash::make() → enkripsi password sebelum disimpan
    //      (password TIDAK boleh disimpan dalam bentuk plain text)
    // 3. Auto login setelah register berhasil
    // 4. Redirect ke home
    // =========================================================
    public function register(Request $request)
    {
        // Validasi semua input dari form register
        $data = $request->validate([
            'name'     => ['required', 'string', 'max:100'],
            'email'    => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        // Simpan user baru ke database
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']), // enkripsi password
        ]);

        // Langsung login setelah register — user tidak perlu login manual
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('home');
    }

    // =========================================================
    // PROSES LOGOUT
    // Dipanggil saat user klik tombol Logout (POST /logout).
    //
    // Alur:
    // 1. Auth::logout()              → hapus data autentikasi user
    // 2. session()->invalidate()     → hancurkan semua data session
    // 3. session()->regenerateToken()→ buat CSRF token baru
    //    (penting agar form di halaman lain tidak bisa dipakai lagi)
    // 4. Redirect ke home
    // =========================================================
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();      // hapus session lama
        $request->session()->regenerateToken(); // buat CSRF token baru

        return redirect()->route('home');
    }

    // =========================================================
    // TAMPILKAN HALAMAN LUPA PASSWORD
    // Dipanggil saat user buka GET /forgot-password.
    // =========================================================
    public function showForgotPassword()
    {
        return view('pages.forgot-password');
    }

    // =========================================================
    // KIRIM LINK RESET PASSWORD
    // Dipanggil saat user submit form lupa password (POST /forgot-password).
    // Password::sendResetLink() generate token, simpan ke tabel
    // password_reset_tokens, lalu kirim notifikasi email berisi link
    // reset (dikirim lewat MAIL_MAILER di .env -- default 'log', jadi
    // link-nya masuk ke storage/logs/laravel.log kalau belum diset SMTP asli).
    // =========================================================
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    // =========================================================
    // TAMPILKAN HALAMAN RESET PASSWORD
    // Dipanggil saat user klik link reset dari email (GET /reset-password/{token}).
    // =========================================================
    public function showResetPassword(Request $request, string $token)
    {
        return view('pages.reset-password', [
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    }

    // =========================================================
    // PROSES RESET PASSWORD
    // Dipanggil saat user submit password baru (POST /reset-password).
    // Password::reset() validasi token & email ke tabel password_reset_tokens,
    // kalau valid: update password user via callback lalu hapus token-nya.
    // =========================================================
    public function resetPassword(Request $request)
    {
        $validated = $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $status = Password::reset(
            $validated,
            function (User $user, string $password) {
                $user->forceFill(['password' => Hash::make($password)])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }
}
