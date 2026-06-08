<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\HomeController;



Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/games/{games_id}', [GameController::class, 'games_show'])->name('games.show');
