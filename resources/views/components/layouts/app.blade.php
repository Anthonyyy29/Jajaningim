<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Jajaningim') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Saira+Stencil+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    {{-- Vite (Bootstrap masuk dari sini) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @php $allGames = \App\Models\Game::where('is_active', 'true')->get(['id', 'name']); @endphp
    <script>
        window.GAMES           = @json($allGames);
        window.GAME_BASE_URL   = '{{ url('/game') }}';
        window.NOT_FOUND_URL   = '{{ url('/game-not-found') }}';
    </script>
</head>
<body>

    {{-- Navbar --}}
    @include('components.layouts.navigation')

    {{-- Header Halaman (opsional) --}}
    {{-- @if (isset($header))
        <div class="bg-white shadow-sm py-3">
            <div class="container">
                {{ $header }}
            </div>
        </div>
    @endif --}}

    {{-- Konten Utama --}}
    <main class="container py-4">
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <footer class="mt-4 pt-5 pb-4" style="border-top: 1px solid var(--of-border);">
        <div class="container">
            <div class="row g-4">
                <div class="col-12 col-md-4">
                    <h6 class="fw-bold mb-3" style="color: var(--of-text);">Development Team</h6>
                    <div style="color: var(--of-text-2); font-size: .9rem;">
                        <div>Adi Ezra Anthoni &mdash; 20240801036</div>
                        <div>Rivan Aufar Prayudi &mdash; 20240801089</div>
                        <div>Rafdi Muliawan &mdash; 20240801160</div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <h6 class="fw-bold mb-3" style="color: var(--of-text);">Campus Information</h6>
                    <div style="color: var(--of-text-2); font-size: .9rem;">
                        <div>Esa Unggul - Harapan Indah University</div>
                        <div>Jl. Harapan Indah Boulevard No.2, Pusaka Rakyat, Kec. Tarumajaya, Kabupaten Bekasi, Jawa Barat 17214</div>
                        <div>Course: Web Programming</div>
                        <div>Lecturer: Mrs. Dewi Setiowati, A.Md., S.Pd., M.Tr.Kom.</div>
                        <div>Class: KH002</div>
                        <div>Academic Year: 2025/2026 (Even Semester)</div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <h6 class="fw-bold mb-3" style="color: var(--of-text);">About This App</h6>
                    <div style="color: var(--of-text-2); font-size: .9rem;">
                        <div>Status: Beta</div>
                        <div>Version: 0.1.1</div>
                        <div>Domain: jajaningim.my.id</div>
                        <div class="mt-2">
                            <a href="https://github.com/Anthonyyy29/Jajaningim" target="_blank" rel="noopener" class="auth-link-muted">GitHub</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4 pt-3" style="border-top: 1px solid var(--of-border); color: var(--of-muted); font-size: .85rem;">
                &copy; {{ date('Y') }} Jajaningim - All rights reserved.
            </div>
        </div>
    </footer>

</body>
</html>
