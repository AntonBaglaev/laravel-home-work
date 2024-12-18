<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\PdfGeneratorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyUserController;
use App\Http\Controllers\LogController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('user', [MyUserController::class, 'index']);
Route::get('user/{id}', [MyUserController::class, 'get']);
Route::get('show_form', [MyUserController::class, 'showForm']);
Route::post('store_user', [MyUserController::class, 'store'])->name('post');
Route::get('resume/{id}', [MyUserController::class, 'resume']);
Route::get('pdf/{id}', [PdfGeneratorController::class, 'index'])->name('pdf');

Route::get('logs', LogController::class);

Route::get('/news/create-test', [NewsController::class, 'createTest']);
Route::get('/news/{id}/hide', [NewsController::class, 'hiddenNews']);
