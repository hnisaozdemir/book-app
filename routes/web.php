<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;

//  Giriş ve Kayıt İşlemleri
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/login', [LoginController::class, 'showLoginForm']);
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');


//  Admin Paneli (İsteğe bağlı olarak middleware: admin ekleyebilirsin)
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/product/create', [AdminController::class, 'create'])->name('product.create');
    Route::post('/product/store', [AdminController::class, 'store'])->name('product.store');
    Route::get('/product/{id}/edit', [AdminController::class, 'edit'])->name('product.edit');
    Route::put('/product/{id}', [AdminController::class, 'update'])->name('product.update');
    Route::delete('/product/{id}', [AdminController::class, 'destroy'])->name('product.delete');
    Route::get('/sold-books', [AdminController::class, 'showSoldBooks'])->name('soldBooks');
    Route::get('/available-books', [AdminController::class, 'showAvailableBooks'])->name('availableBooks');
    Route::get('/earnings', [AdminController::class, 'earnings'])->name('earnings');
});


//  Kullanıcı Paneli
Route::middleware(['auth'])->group(function () {

    // Kullanıcı Dashboard ve Ürünler
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/products', [UserController::class, 'products'])->name('user.products');
    Route::get('/product/{id}', [UserController::class, 'showProduct'])->name('user.products.show');

    // Sepet
    Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('user.cart.add');
    Route::get('/cart', [CartController::class, 'cart'])->name('user.cart');
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('user.cart.remove');

    // Adres
    Route::get('/address', [UserController::class, 'showAddressForm'])->name('user.address');
    Route::post('/address', [UserController::class, 'saveAddress'])->name('user.address.save');

    // Checkout & Ödeme
    Route::get('/checkout', [CartController::class, 'checkout'])->name('user.checkout');
    Route::post('/checkout/confirm', [CartController::class, 'confirmPurchase'])->name('user.purchase.confirm');
    Route::get('/checkout/confirm', [CartController::class, 'checkout'])->name('user.checkout.get');

    // Siparişlerim
    Route::get('/orders', [UserController::class, 'myOrders'])->name('user.orders');
   

});
