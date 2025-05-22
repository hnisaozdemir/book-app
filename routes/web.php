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
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/product/create', [AdminController::class, 'create'])->name('product.create');
    Route::post('/product/store', [AdminController::class, 'store'])->name('product.store');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
     Route::delete('/product/{id}', [AdminController::class, 'destroy'])->name('product.delete');
    Route::get('/product/{id}/edit', [AdminController::class, 'edit'])->name('product.edit');
    Route::put('/product/{id}', [AdminController::class, 'update'])->name('product.update');
     Route::get('/sold-books', [AdminController::class, 'showSoldBooks'])->name('soldBooks');
    Route::get('/available-books', [AdminController::class, 'showAvailableBooks'])->name('availableBooks');
    Route::get('/earnings', [AdminController::class, 'earnings'])->name('earnings');

    
});




// Kullanıcı Paneli
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/products', [UserController::class, 'products'])->name('user.products');
    Route::get('/products/{id}', [UserController::class, 'showProduct'])->name('user.products.show');

    // Sepet İşlemleri
    Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('user.cart.add');
    Route::get('/cart', [CartController::class, 'cart'])->name('user.cart');
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('user.cart.remove');

    // Admin Ürün Güncelleme (Not: Admin'e özelse middleware ayrıştırabilirsin)
    Route::post('/admin/product/update/{id}', [AdminController::class, 'update'])->name('admin.product.update');

    // Adres Bilgisi
Route::get('/address', [UserController::class, 'showAddressForm'])->name('user.address');
Route::post('/address', [UserController::class, 'saveAddress'])->name('user.address.save');

    // Satın Alma İşlemleri
    Route::get('/checkout', [CartController::class, 'checkout'])->name('user.checkout');
    Route::post('/checkout/confirm', [CartController::class, 'confirmPurchase'])->name('user.purchase.confirm');
});
