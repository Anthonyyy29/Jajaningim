<x-layouts.app>
    <h1>All Games</h1>
    @isset($games)
                    <div class="row g-3">
                        @foreach ($games as $game)
                            <div class="col-6 col-md-4 col-lg-2">
                                <div class="text-center p-3 rounded-4 promo_banner h-100">
                                    <a href="{{ route('game.show', $game->id) }}">
                                        <img src="{{ asset('assets/logo_game/' . $game->image) }}" alt="{{ $game->name }}" class="img-fluid mb-2" style="max-height: 100px;">                                    </a>
                                    <div class="small fw-semibold">{{ $game->name }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4">
                        {{ $games->links('pagination::bootstrap-5') }}
                    </div>
                @else
                    <p>Belum ada game untuk ditampilkan.</p>
                @endisset
</x-layouts.app>
