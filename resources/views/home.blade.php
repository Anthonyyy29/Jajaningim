<x-layouts.app>
    <h1>Home</h1>
    @foreach ($games as $game)
        <div>
            <h2>{{ $game->name }}</h2>
            <p>{{ $game->image }}</p>
        </div>
    @endforeach
</x-layouts.app>
