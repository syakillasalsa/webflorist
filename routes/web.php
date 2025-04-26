<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\FloristController;

Route::get('/', [FloristController::class, 'index'])->name('home');
Route::get('/order', [FloristController::class, 'showOrders'])->name('order.index');
Route::get('/about', [FloristController::class, 'about'])->name('about');

Route::get('/order/create', [FloristController::class, 'create'])->name('order.create');
Route::post('/order', [FloristController::class, 'store'])->name('order.store');
Route::get('/tambah', [FloristController::class, 'create'])->name('bouquet.create');
Route::post('/tambah', [FloristController::class, 'store'])->name('bouquet.store');
Route::resource('bouquet', FloristController::class);
Route::get('/bouquet/{id}/edit', [FloristController::class, 'edit'])->name('bouquet.edit');
Route::put('/bouquet/{id}', [FloristController::class, 'update'])->name('bouquet.update');
Route::delete('/bouquet/{id}', [FloristController::class, 'destroy'])->name('bouquet.destroy');
Route::get('/menu', [FloristController::class, 'menu'])->name('menu.filter');

Route::put('/bouquet/{id}/update-category', [FloristController::class, 'updateCategory'])->name('bouquet.updateCategory');
Route::get('/cart/remove/{id}', [FloristController::class, 'removeItem'])->name('cart.remove');
Route::get('/cart/decrease/{id}', [FloristController::class, 'decrease'])->name('cart.decrease');
Route::get('/cart/increase/{id}', [FloristController::class, 'increase'])->name('cart.increase');
Route::get('/checkout', [FloristController::class, 'checkout'])->name('checkout');
Route::post('/cart/note', [FloristController::class, 'saveNote'])->name('cart.note');
Route::get('/admin/home', [FloristController::class, 'home'])->name('admin.home');

use App\Http\Controllers\AuthController;

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'prosesLogin'])->name('login.proses');

Route::post('/login', [AuthController::class, 'authenticate'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/home', function () {
    return view('halaman.home'); // Pastikan ada home.blade.php
})->name('home')->middleware('auth');

use App\Http\Controllers\CheckoutController;
// Halaman Cart + Checkout
Route::get('/cart', [CheckoutController::class, 'showCart'])->name('cart.show');
Route::post('/cart/update', [CheckoutController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/note', [CheckoutController::class, 'saveNote'])->name('cart.note');
Route::post('/checkout/process', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
Route::post('/checkout/add-to-cart/{id}', [CheckoutController::class, 'addToCart'])->name('checkout.addToCart');
Route::get('/shipping-cost', [CheckoutController::class, 'getShippingCost'])->name('get.shipping.cost');

// Halaman Pembayaran
Route::get('/payment', [CheckoutController::class, 'paymentPage'])->name('payment.page');
use App\Http\Controllers\TransactionController;

// Untuk user melihat riwayat transaksi
// Untuk admin melihat semua transaksi
Route::get('/admin/transactions', [TransactionController::class, 'adminTransactions'])->name('admin.transactions');
Route::get('/admin/transactions/{id}', [TransactionController::class, 'showDetail'])->name('transaction.detail');

// Proses pembayaran (harus POST)
Route::post('/payment/process', [TransactionController::class, 'processPayment'])->name('payment.process');

// Halaman nota setelah pembayaran berhasil
Route::get('/payment-success/{id}', [TransactionController::class, 'success'])->name('payment.success');
