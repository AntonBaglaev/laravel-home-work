<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/users', [UsersController::class, 'index']);

Route::get('/store', [RegisteredUserController::class,'store']);

Route::get('/test-telegram', function () {
    Telegram::sendMessage([
        'chat_id' => env('TELEGRAM_CHANNEL_ID'),
        'parse_mod' => 'html',
        'text' => 'Произошло тестовое событие'
    ]);
    return response()->json([
        'status' => 'success'
    ]);
});

require __DIR__.'/auth.php';
