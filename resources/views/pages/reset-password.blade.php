<x-layouts.app>
    <div class="auth-wrapper">
        <div class="auth-left d-none d-md-flex">
            <span class="auth-star auth-star-1"><i class="bi bi-star-fill"></i></span>
            <span class="auth-star auth-star-2"><i class="bi bi-star-fill"></i></span>
            <div class="auth-circle auth-circle-1"></div>
            <div class="auth-circle auth-circle-2"></div>

            <div class="auth-left-content">
                <img src="{{ asset('assets/logo_jajaningim/logo.png') }}" alt="JajaninGim" class="auth-logo">
                <h2 class="auth-left-title">Buat password baru</h2>
                <p class="auth-left-sub">Pastikan password barunya gampang kamu ingat, tapi susah ditebak orang lain.</p>
            </div>
        </div>

        <div class="auth-right">
            <div class="auth-form-wrap">
                <h1 class="auth-title">Password Baru</h1>
                <p class="auth-subtitle">Untuk akun <strong>{{ $email }}</strong></p>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">

                    <div class="mb-3">
                        <label class="auth-label" for="password">Password baru</label>
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
                        <label class="auth-label" for="password_confirmation">Konfirmasi password baru</label>
                        <div class="auth-input-group">
                            <i class="bi bi-lock"></i>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="auth-input" placeholder="Ulangi password baru">
                            <i class="bi bi-eye auth-input-toggle" data-target="password_confirmation"></i>
                        </div>
                    </div>

                    @error('email')
                        <div class="auth-error mb-3">{{ $message }}</div>
                    @enderror

                    <button type="submit" class="auth-btn-primary w-100">Simpan Password Baru</button>
                </form>
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
