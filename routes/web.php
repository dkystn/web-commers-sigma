<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('general.index');
})->name('home');

Route::get('/category/{category?}', function ($category = 'wanita') {
    return view('general.category', compact('category'));
})->name('category');

Route::get('/product/{id?}', function ($id = 1) {
    return view('general.product', compact('id'));
})->name('product');


