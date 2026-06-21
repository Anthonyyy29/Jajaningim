<x-layouts.app>
    <div class="auth-wrapper">
        <div class="auth-left d-none d-md-flex">
            <span class="auth-star auth-star-1"><i class="bi bi-star-fill"></i></span>
            <span class="auth-star auth-star-2"><i class="bi bi-star-fill"></i></span>
            <div class="auth-circle auth-circle-1"></div>
            <div class="auth-circle auth-circle-2"></div>

            <div class="auth-left-content">
                <img src="{{ asset('assets/logo_jajaningim/logo.png') }}" alt="JajaninGim" class="auth-logo">
                <h2 class="auth-left-title">Selamat datang kembali, juragan!</h2>
                <p class="auth-left-sub">Masuk dan lanjutkan top up game favoritmu.</p>
            </div>
        </div>

        <div class="auth-right">
            <div class="auth-form-wrap">
                <h1 class="auth-title">Masuk ke Akun</h1>
                <p class="auth-subtitle">Belum punya akun? <a href="{{ route('register') }}" class="auth-link">Daftar di sini</a></p>

                <form method="POST" action="#">
                    @csrf

                    <div class="mb-3">
                        <label class="auth-label" for="email">Email</label>
                        <div class="auth-input-group">
                            <i class="bi bi-envelope"></i>
                            <input type="email" id="email" name="email" class="auth-input" placeholder="Contoh@gmail.com">
                        </div>
                    </div>

                    <div class="mb-2">
                        <label class="auth-label" for="password">Password</label>
                        <div class="auth-input-group">
                            <i class="bi bi-lock"></i>
                            <input type="password" id="password" name="password" class="auth-input" placeholder="Masukkan password">
                            <i class="bi bi-eye auth-input-toggle" data-target="password"></i>
                        </div>
                    </div>

                    <div class="text-end mb-3">
                        <a href="#" class="auth-link-muted">Lupa password?</a>
                    </div>

                    <button type="submit" class="auth-btn-primary w-100">Masuk &amp; mulai Top Up 🚀</button>
                </form>

                <div class="auth-divider"><span>atau masuk dengan</span></div>

                <button type="button" class="auth-btn-google w-100">
                    <i class="bi bi-google"></i> Lanjut dengan Google
                </button>

                <p class="text-center mt-3 mb-0">
                    <a href="{{ route('home') }}" class="auth-link-muted">&larr; Kembali ke beranda</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.auth-input-toggle').forEach(function (icon) {
            icon.addEventListener('click', function () {
                const input = document.getElementById(icon.dataset.target);
                const show = input.type === 'password';
                input.type = show ? 'text' : 'password';
                icon.classList.toggle('bi-eye', !show);
                icon.classList.toggle('bi-eye-slash', show);
            });
        });
    </script>
</x-layouts.app>
