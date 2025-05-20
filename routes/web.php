<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/login', [LoginController::class, 'showLoginForm']); // ← bu satır eklendi
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');


Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::post('/admin/product/store', [AdminController::class, 'store'])->name('admin.product.store');
Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

Route::get('/products', [UserController::class, 'products'])->name('user.products');
Route::get('/products/{id}', [UserController::class, 'showProduct'])->name('user.products.show');
Route::post('/cart/add/{id}', [UserController::class, 'addToCart'])->name('user.cart.add');

Route::get('/user/cart', [UserController::class, 'cart'])->name('user.cart');
