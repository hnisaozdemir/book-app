<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Giriş formu (login ekranı)
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

// Giriş formundan gelen post işlemi
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
// Kayıt formu
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');

// Kayıt formundan gelen post işlemi
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// Oturumu kapatma
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Buyer Dashboard
Route::get('/user/dashboard', function () {
    return view('user.dashboard');
})->name('user.dashboard');

// Seller Dashboard
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');