<?php

use App\Http\Controllers\ProductController;

use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index'])->name('home');

// route untuk halaman produk
Route::resource('products', ProductController::class);
