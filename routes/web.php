<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [PostController::class, 'index'])->middleware('auth');

Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');

Route::post('/login', [AuthController::class, 'login'])->name('user_login');
Route::post('/register', [AuthController::class, 'register'])->name('user_register');
Route::get('/logout', [AuthController::class, 'logout'])->name('user_logout');

Route::resource('posts', PostController::class);
