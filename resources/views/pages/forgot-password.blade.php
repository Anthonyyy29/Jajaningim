<x-layouts.app>
    <div class="auth-wrapper">
        <div class="auth-left d-none d-md-flex">
            <span class="auth-star auth-star-1"><i class="bi bi-star-fill"></i></span>
            <span class="auth-star auth-star-2"><i class="bi bi-star-fill"></i></span>
            <div class="auth-circle auth-circle-1"></div>
            <div class="auth-circle auth-circle-2"></div>

            <div class="auth-left-content">
                <img src="{{ asset('assets/logo_jajaningim/logo.png') }}" alt="JajaninGim" class="auth-logo">
                <h2 class="auth-left-title">Lupa password?<br>Santai, kita bantu.</h2>
                <p class="auth-left-sub">Masukkan email akun kamu, kami kirim link buat bikin password baru.</p>
            </div>
        </div>

        <div class="auth-right">
            <div class="auth-form-wrap">
                <h1 class="auth-title">Reset Password</h1>
                <p class="auth-subtitle">Ingat password-nya? <a href="{{ route('login') }}" class="auth-link">Masuk di sini</a></p>

                @if (session('status'))
                    <div class="account-status mb-3">{{ session('status') }}</div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="auth-label" for="email">Email</label>
                        <div class="auth-input-group">
                            <i class="bi bi-envelope"></i>
                            <input type="email" id="email" name="email" class="auth-input" placeholder="Contoh@gmail.com"
                                   value="{{ old('email') }}">
                        </div>
                        @error('email')
                            <div class="auth-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="auth-btn-primary w-100">Kirim Link Reset</button>
                </form>

                <p class="text-center mt-3 mb-0">
                    <a href="{{ route('login') }}" class="auth-link-muted">&larr; Kembali ke halaman login</a>
                </p>
            </div>
        </div>
    </div>
</x-layouts.app>
