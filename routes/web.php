<?php

use App\Http\Controllers\ProductController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

Route::get('/', [ProductController::class, 'index'])->name('home');

// route untuk halaman produk
Route::resource('products', ProductController::class);


//route resource for products
Route::resource('/products', \App\Http\Controllers\ProductController::class);
Route::resource('category', App\Http\Controllers\CategoryController::class);
