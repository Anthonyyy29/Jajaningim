<?php
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\TransactionController;
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

// Checkout / transaction routes
Route::post('/transaction', [TransactionController::class, 'store'])->name('transaction.store');
Route::get('/transaction/{orderId}', [TransactionController::class, 'show'])->name('transaction.show');

// Midtrans payment notification webhook (server-to-server, no CSRF token available)
Route::post('/payment/callback', [TransactionController::class, 'callback'])->name('payment.callback');

// Midtrans dashboard Finish/Unfinish/Error Redirect URLs — all funnel to the same
// status lookup since the real payment state only ever comes from our own DB.
Route::get('/payment/finish', [TransactionController::class, 'redirectAfterPayment'])->name('payment.finish');
Route::get('/payment/unfinish', [TransactionController::class, 'redirectAfterPayment'])->name('payment.unfinish');
Route::get('/payment/error', [TransactionController::class, 'redirectAfterPayment'])->name('payment.error');

// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[AuthController::class, 'register'])->name('register.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Account routes (butuh login)
Route::middleware('auth')->group(function () {
    Route::get('/account', [AccountController::class, 'edit'])->name('account.edit');
    Route::put('/account', [AccountController::class, 'update'])->name('account.update');
    Route::put('/account/password', [AccountController::class, 'updatePassword'])->name('account.password');
});
