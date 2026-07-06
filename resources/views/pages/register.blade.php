<x-layouts.app>
    <div class="auth-wrapper">
        <div class="auth-left d-none d-md-flex">
            <span class="auth-star auth-star-1"><i class="bi bi-star-fill"></i></span>
            <span class="auth-star auth-star-2"><i class="bi bi-star-fill"></i></span>
            <div class="auth-circle auth-circle-1"></div>
            <div class="auth-circle auth-circle-2"></div>

            <div class="auth-left-content">
                <img src="{{ asset('assets/logo_jajaningim/logo.png') }}" alt="JajaninGim" class="auth-logo">
                <h2 class="auth-left-title">Belanja game favoritmu sekarang!</h2>
                <p class="auth-left-sub">Top up cepat, dan harga bersahabat.</p>

                <div class="auth-promo-box">
                    <span class="auth-promo-icon">🎁</span>
                    <span>Dapatkan promo pembelian pertama <strong class="text-of-accent">10%</strong> hanya dengan register.</span>
                </div>
            </div>
        </div>

        <div class="auth-right">
            <div class="auth-form-wrap">
                <h1 class="auth-title">Daftar Akun Baru</h1>
                <p class="auth-subtitle">Buat akun untuk mulai top up &amp; belanja game di JajaninGim.</p>

                <form method="POST" action="{{ route('register.post') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="auth-label" for="name">Username / Nama</label>
                        <div class="auth-input-group">
                            <i class="bi bi-person"></i>
                            <input type="text" id="name" name="name" class="auth-input" placeholder="Contoh: Jajanipro"
                                   value="{{ old('name') }}">
                        </div>
                        @error('name')
                            <div class="auth-error">{{ $message }}</div>
                        @enderror
                    </div>

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

                    <div class="mb-3">
                        <label class="auth-label" for="password">Password</label>
                        <div class="auth-input-group">
                            <i class="bi bi-lock"></i>
                            <input type="password" id="password" name="password" class="auth-input" placeholder="Minimal 8 karakter">
                            <i class="bi bi-eye auth-input-toggle" data-target="password"></i>
                        </div>
                        @error('password')
                            <div class="auth-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="auth-label" for="password_confirmation">Konfirmasi Password</label>
                        <div class="auth-input-group">
                            <i class="bi bi-lock"></i>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="auth-input" placeholder="Ulangi password">
                            <i class="bi bi-eye auth-input-toggle" data-target="password_confirmation"></i>
                        </div>
                    </div>

                    <button type="submit" class="auth-btn-primary w-100">Daftar dan mulai Top Up 🚀</button>
                </form>

                <p class="text-center mt-3 mb-0">
                    Sudah punya akun? <a href="{{ route('login') }}" class="auth-link">Login di sini &rarr;</a>
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
