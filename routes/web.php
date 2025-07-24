<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MerekController;
use App\Http\Controllers\Admin\ArticleController;    
use App\Http\Controllers\Admin\ProductController;   
use App\Http\Controllers\Admin\InformasiController;

Route::get('/', function () {
    return view('welcome');
});

//Route semua pengguna
Route::middleware(['auth'])->name('admin.')->group(function () {
    //route untuk dashboard
    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('admin/articles', ArticleController::class); // manajemen artikel
    Route::resource('admin/product', ProductController::class); // manajemen produk
    Route::resource('admin/informasi', InformasiController::class); // manajemen informasi
});

// Route hanya untuk admin
Route::middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
    // Semua rute di dalam grup ini akan memerlukan otentikasi dan peran 'admin'
    Route::resource('admin/users', UserController::class); // manajemen user
    Route::resource('admin/categories', CategoryController::class); // manajemen kategori
    Route::resource('admin/merek', MerekController::class); // manajemen merek
});