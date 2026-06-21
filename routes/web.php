<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $games = [
        ['name' => 'Mobile Legends', 'logo' => 'assets/logo_game/mlbb.png'],
        ['name' => 'Free Fire', 'logo' => 'assets/logo_game/freefire.png'],
        ['name' => 'PUBG Mobile', 'logo' => 'assets/logo_game/pubgm.png'],
        ['name' => 'Valorant', 'logo' => 'assets/logo_game/valorant.png'],
        ['name' => 'Genshin Impact', 'logo' => 'assets/logo_game/genshin.png'],
        ['name' => 'Call of Duty Mobile', 'logo' => 'assets/logo_game/codm.png'],
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
