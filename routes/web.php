<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController; 

// Giriş ve Kayıt İşlemleri
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/login', [LoginController::class, 'showLoginForm']);
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// Admin Paneli
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::post('/admin/product/store', [AdminController::class, 'store'])->name('admin.product.store');

// Kullanıcı Paneli
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/products', [UserController::class, 'products'])->name('user.products');
    Route::get('/products/{id}', [UserController::class, 'showProduct'])->name('user.products.show');

    // Sepet İşlemleri
    Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('user.cart.add');
    Route::get('/cart', [CartController::class, 'cart'])->name('user.cart');  // Sepeti gösterir
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('user.cart.remove');

    // Satın Alma İşlemleri
    Route::get('/checkout', [CartController::class, 'checkout'])->name('user.checkout');
    Route::post('/checkout/confirm', [CartController::class, 'confirmPurchase'])->name('user.purchase.confirm');
});
