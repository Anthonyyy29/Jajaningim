<?php
use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GameController::class, 'index'])->name('home');

Route::get('/allgames', [GameController::class, 'AllGamesIndex'])->name('games');
Route::get('/game/{id}', [GameItemController::class, 'show'])->name('game.show');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/login', function () {
    return view('pages.login');
})->name('login');

Route::get('/register', function () {
    return view('pages.register');
})->name('register');
