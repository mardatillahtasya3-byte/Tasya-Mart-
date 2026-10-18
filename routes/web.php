<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

// Halaman utama
Route::get('/', function () {
    return redirect()->route('products.index');
});

// Halaman login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Route CRUD produk
Route::resource('products', ProductController::class);

// Route CRUD kategori
Route::resource('categories', CategoryController::class);
