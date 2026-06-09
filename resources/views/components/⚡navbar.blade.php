<?php

use Livewire\Component;
use App\Models\Game;

new class extends Component
{
        public string $search = '';

    public function clear(): void
    {
        $this->search = '';
    }

    public function with(): array
    {
        $results = collect();

        if (strlen(trim($this->search)) >= 2) {
            $results = Game::query()
                ->where('name', 'like', '%' . $this->search . '%')
                ->orderBy('name')
                ->limit(8)
                ->get(['id_game', 'name']);
        }

        return ['results' => $results];
    }
};
?>

<div>
    {{-- I have not failed. I've just found 10,000 ways that won't work. - Thomas Edison --}}
    <nav class="navbar">
    <a href="/" class="logo">Logo</a>

    <div class="search-wrapper" x-data @click.outside="$wire.clear()">
        <div class="search-box">
            <input
                type="text"
                wire:model.live.debounce.300ms="search"
                placeholder="Cari artikel..."
                autocomplete="off"
            >
            <span wire:loading wire:target="search" class="spinner">⏳</span>
        </div>

        @if(strlen(trim($search)) >= 2)
            <ul class="search-results" wire:loading.remove wire:target="search">
                @forelse($results as $post)
                    <li><a href="/games/{{ $post->id_game }}">{{ $post->name }}</a></li>
                @empty
                    <li class="no-result">Tidak ada hasil untuk "{{ $search }}"</li>
                @endforelse
            </ul>
        @endif
    </div>

    <ul class="menu">
        <li><a href="/">Home</a></li>
        <li><a href="/about">About</a></li>
    </ul>
</nav>
</div>
