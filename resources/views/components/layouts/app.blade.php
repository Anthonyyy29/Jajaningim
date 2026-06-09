<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Jajaningim</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <livewire:navbar />   {{-- ← navbar dipasang di sini --}}

    <main>
        {{ $slot }}        {{-- ← isi tiap halaman masuk ke sini --}}
    </main>
</body>
</html>
