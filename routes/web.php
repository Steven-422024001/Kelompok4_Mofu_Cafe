<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransaksiController;

// Halaman utama
Route::get('/', [ProductController::class, 'index'])->name('home');

// Route resource untuk produk
Route::resource('products', ProductController::class);

// Route resource untuk supplier
Route::resource('suppliers', SupplierController::class);

// Route resource untuk transaksi
Route::resource('transaksi', TransaksiController::class);