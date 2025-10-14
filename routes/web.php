<?php

use App\Http\Controllers\ProductController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

Route::get('/', [ProductController::class, 'index'])->name('home');

//route resource for products
Route::resource('/products', \App\Http\Controllers\ProductController::class);
