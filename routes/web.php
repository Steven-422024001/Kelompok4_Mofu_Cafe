<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;

use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index'])->name('home');

//route resource for products
Route::resource('/products', \App\Http\Controllers\ProductController::class);
Route::resource('category', App\Http\Controllers\CategoryController::class);

//route resource for suppliers  
Route::resource('suppliers', \App\Http\Controllers\SupplierController::class);