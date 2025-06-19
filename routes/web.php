<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

// Register
Route::match(['get', 'post'], '/register', [RegisterController::class, 'form'])
    ->name('register')->middleware('guest');

// Halaman publik
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Login form & proses logout
Route::match(['get', 'post'], '/login', [LoginController::class, 'form'])->name('login')->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Produk - bisa diakses publik (seperti katalog), sebagian khusus admin
Route::prefix('products')->controller(ProductController::class)->group(function () {
    Route::get('/', 'index')->name('products');                // katalog
    Route::get('/show/{id}', 'show')->name('products.show');   // detail produk

    // Buat, edit hanya jika login (admin)
    Route::middleware('auth')->group(function () {
        Route::get('/create', 'create')->name('products.create');
        Route::get('/edit/{id}', 'edit')->name('products.edit');
        Route::post('/store', 'store')->name('products.store');
        Route::post('/update/{id}', 'update')->name('products.update');
    });
});

// Manajemen user (admin)
Route::controller(UserController::class)->middleware('auth')->group(function () {
    Route::get('/users', 'list')->name('user.list');
    Route::match(['get', 'post'], '/users/create', 'create')->name('user.create');
    Route::match(['get', 'post'], '/users/{id}/edit', 'edit')->name('user.edit');
    Route::post('/users/{id}/delete', 'delete')->name('user.delete');
});

// Fitur toko yang butuh login
Route::middleware('auth')->group(function () {

    // Keranjang
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');

    // Checkout dan pesanan
    Route::get('/checkout', [CheckOutController::class, 'form'])->name('checkout.form');
    Route::post('/checkout/process', [CheckOutController::class, 'process'])->name('checkout.process');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
});
