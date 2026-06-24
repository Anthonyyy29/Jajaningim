<x-layouts.app>
<div class="jumbotron text-center">    {{--Judul Besar Di Home--}}
        <h1 class="display-4 heading-jumbotron">Selamat Datang Juragan!</h1>
        <p class="lead">Di JajaninGim.site dijamin paling cepat dan murah </p>
        <h3 class="heading-jumbotron text-of-accent">SEGERA HABISKAN UANG GAJIAN MU DENGAN TOP UP!!!</h3>
</div>

<x-promo_banner />

<div class="jumbotron text-left mt-4">
    <h2>POPULER</h2>

    <div class="container">
        <div class="container text-center">
            @isset($games)
                <div class="row g-3">
                    @foreach ($games as $game)
                        <div class="col-6 col-md-4 col-lg-2">
                            <div class="text-center p-3 rounded-4 promo_banner h-100">
                                <a href="{{ route('games', $game['id']) }}">
                                    <img src="{{ asset($game['logo']) }}" alt="{{ $game['name'] }}" class="img-fluid mb-2" style="max-height: 100px;">
                                </a>
                                <div class="small fw-semibold">{{ $game['name'] }}</div>
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

</x-layouts.app>
