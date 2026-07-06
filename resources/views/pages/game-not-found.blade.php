<x-layouts.app>
    <div class="d-flex flex-column align-items-center justify-content-center text-center py-5">

        <div class="mb-4" style="font-size: 5rem; line-height: 1;">&#128534;</div>

        <h1 class="fw-bold mb-2">Game Tidak Ditemukan</h1>

        @if(request('q'))
            <p style="color: var(--of-text-2);">
                Tidak ada game dengan nama
                <span class="fw-semibold" style="color: var(--of-text);">"{{ request('q') }}"</span>
                dalam daftar kami.
            </p>
        @else
            <p style="color: var(--of-text-2);">Game yang kamu cari tidak tersedia.</p>
        @endif

        <div class="d-flex gap-3 mt-3">
            <a href="{{ route('games') }}" class="btn btn-of-accent px-4">Lihat Semua Game</a>
            <a href="{{ route('home') }}" class="btn px-4"
               style="background-color: var(--of-surface-2); border: 1px solid var(--of-border); color: var(--of-text);">
                Kembali ke Home
            </a>
        </div>

    </div>
</x-layouts.app>
