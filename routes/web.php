<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('register', [RegisterController::class, 'register'])->name('register');
Route::post('/store', [RegisterController::class, 'store'])->name('store');
Route::get('/login', [RegisterController::class, 'login'])->name('login');
Route::post('/authenticate', [RegisterController::class, 'authenticate'])->name('authenticate');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [RegisterController::class, 'home'])->name('home');
    Route::get('/logout', [RegisterController::class, 'logout'])->name('logout');
});

