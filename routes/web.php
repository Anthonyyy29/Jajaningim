<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $games = [
        ['id' => 1, 'name' => 'Mobile Legends', 'logo' => 'assets/logo_game/mlbb.png'],
        ['id' => 2, 'name' => 'Free Fire', 'logo' => 'assets/logo_game/freefire.png'],
        ['id' => 3, 'name' => 'PUBG Mobile', 'logo' => 'assets/logo_game/pubgm.png'],
        ['id' => 4, 'name' => 'Valorant', 'logo' => 'assets/logo_game/valorant.png'],
        ['id' => 5, 'name' => 'Genshin Impact', 'logo' => 'assets/logo_game/genshin.png'],
        ['id' => 6, 'name' => 'Call of Duty Mobile', 'logo' => 'assets/logo_game/codm.png'],
    ];

    return view('pages/home', compact('games'));
})->name('home');
Route::get('/games', function () {
    return view('pages/games');
})->name('games');
Route::get('/about', function () {
    return view('pages/about');
})->name('about');
Route::get('/login', function () {
    return view('pages/login');
})->name('login');
Route::get('/register', function () {
    return view('pages/register');
})->name('register');
