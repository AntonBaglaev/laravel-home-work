<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyUserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('user', [MyUserController::class, 'index']);
Route::get('user/{id}', [MyUserController::class, 'get']);
Route::get('show_form', [MyUserController::class, 'showForm']);
Route::post('store_user', [MyUserController::class, 'store'])->name('post');
Route::get('resume/{id}', [MyUserController::class, 'resume']);
Route::get('pdf/{id}', [PdfGeneratorController::class, 'index'])->name('pdf');
