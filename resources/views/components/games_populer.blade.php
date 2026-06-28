<div class="jumbotron text-left mt-4">
    <h2>POPULER</h2>

    <div class="container">
        <div class="container text-center">
            @isset($games)
                <div class="row g-3">
                    @foreach ($games as $game)
                        <div class="col-6 col-md-4 col-lg-2">
                            <div class="text-center p-3 rounded-4 promo_banner h-100">
                                <a href="{{ route('games', $game->id_game) }}">
                                    <img src="{{ asset($game->gambar_game) }}" alt="{{ $game->nama_game }}" class="img-fluid mb-2" style="max-height: 100px;">
                                </a>
                                <div class="small fw-semibold">{{ $game->nama_game }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>Belum ada game populer untuk ditampilkan.</p>
            @endisset
        </div>
    </div>
</div>