<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FloristController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\TransactionController;

// ===================
// Halaman Utama
// ===================
Route::get('/', [FloristController::class, 'index'])->name('home');
Route::get('/about', [FloristController::class, 'about'])->name('about');


// ===================
// Order
// ===================
Route::get('/order', [FloristController::class, 'showOrders'])->name('order.index');
Route::get('/order/create', [FloristController::class, 'create'])->name('order.create');
Route::post('/order', [FloristController::class, 'store'])->name('order.store');
Route::get('/menu', [FloristController::class, 'menu'])->name('menu.filter');

// ===================
// Bouquet Management
// ===================
Route::get('/tambah', [FloristController::class, 'create'])->name('bouquet.create');
Route::post('/tambah', [FloristController::class, 'store'])->name('bouquet.store');
Route::resource('bouquet', FloristController::class);
Route::get('/bouquet/{id}/edit', [FloristController::class, 'edit'])->name('bouquet.edit');
Route::put('/bouquet/{id}', [FloristController::class, 'update'])->name('bouquet.update');
Route::delete('/bouquet/{id}', [FloristController::class, 'destroy'])->name('bouquet.destroy');
Route::put('/bouquet/{id}/update-category', [FloristController::class, 'updateCategory'])->name('bouquet.updateCategory');

// ===================
// Cart & Checkout
// ===================
Route::get('/cart', [CheckoutController::class, 'showCart'])->name('cart.show');
Route::post('/cart/update', [CheckoutController::class, 'updateCart'])->name('cart.update');
Route::get('/cart/remove/{id}', [FloristController::class, 'removeItem'])->name('cart.remove');
Route::get('/cart/decrease/{id}', [FloristController::class, 'decrease'])->name('cart.decrease');
Route::get('/cart/increase/{id}', [FloristController::class, 'increase'])->name('cart.increase');
Route::post('/cart/note', [CheckoutController::class, 'saveNote'])->name('cart.note');

Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::post('/checkout/process', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
Route::post('/checkout/add-to-cart/{id}', [CheckoutController::class, 'addToCart'])->name('checkout.addToCart');
Route::get('/shipping-cost', [CheckoutController::class, 'getShippingCost'])->name('get.shipping.cost');

// ===================
// Payment
// ===================
Route::get('/payment', [CheckoutController::class, 'paymentPage'])->name('payment.page');
Route::post('/payment/process', [TransactionController::class, 'processPayment'])->name('payment.process');
Route::get('/payment-success/{id}', [TransactionController::class, 'success'])->name('payment.success');

// ===================
// Admin (Dashboard & Transaksi)
// ===================
Route::get('/admin/home', [FloristController::class, 'adminHome'])->name('admin.home')->middleware('auth');
Route::get('/admin/transactions', [TransactionController::class, 'adminTransactions'])->name('admin.transactions')->middleware('auth');
Route::get('/admin/transactions/{id}', [TransactionController::class, 'showDetail'])->name('transaction.detail')->middleware('auth');
Route::get('/transactions/{id}/download', [TransactionController::class, 'download'])->name('transactions.download');

// ===================
// Authentication
// ===================
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ===================
// Redirect setelah login (User biasa)
// ===================

