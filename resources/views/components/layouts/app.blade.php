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

    {{-- Footer (opsional) --}}
    <footer class="text-center py-3 mt-4">
        <small>&copy; {{ date('Y') }} Jajaningim. All rights reserved.</small>
    </footer>

</body>
</html>
