<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;


// Route untuk halaman utama/dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Route untuk semua fitur CRUD (Create, Read, Update, Delete)
Route::resource('products', ProductController::class);
Route::resource('suppliers', SupplierController::class);
Route::resource('transaksi', TransaksiController::class);
Route::resource('category', CategoryController::class);
