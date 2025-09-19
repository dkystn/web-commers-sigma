<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataCenterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MidtransController;

Route::get('/', function () {
    return view('general.index');
})->name('home');

Route::get('/category/{category?}', function ($category = 'wanita') {
    return view('general.category', compact('category'));
})->name('category');

Route::get('/product/{id?}', function ($id = 1) {
    return view('general.product', compact('id'));
})->name('product');

Route::get('/payment', function () {
    return view('general.payment');
})->name('payment');

Route::get('/cart', function () {
    return view('general.cart');
})->name('cart');

// Midtrans Routes
Route::post('/midtrans/notification', [MidtransController::class, 'notification']);
Route::get('/midtrans/finish', [MidtransController::class, 'finish']);
Route::get('/midtrans/unfinish', [MidtransController::class, 'unfinish']);
Route::get('/midtrans/error', [MidtransController::class, 'error']);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');

Route::get('/panel-product', [DataCenterController::class, 'product'])->name('panel.product');
Route::get('/panel-get-product', [DataCenterController::class, 'getProduct'])->name('panel.get.product');
Route::get('/panel-get-product-detail/{id}', [DataCenterController::class, 'getProductDetail'])->name('panel.get.product.detail');

