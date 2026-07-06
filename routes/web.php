<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;

// // // // // // //
// PUBLIC ROUTES  //
// // // // // // //

// Home page route
Route::get('/', [GameController::class, 'populerIndex'])->name('home');

// Games page route
Route::get('/Games', [GameController::class, 'index'])->name('games');
Route::get('/game/{id}', [GameController::class, 'show'])->name('game.show');

// Search not found page
Route::get('/game-not-found', function () {
    return view('pages.game-not-found');
})->name('game.not-found');

// About page route
Route::get('/about', function () {
    return view('pages.about');
})->name('about');

// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[AuthController::class, 'register'])->name('register.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
