<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\InboxController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\InformasiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\MerekController;
//use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TestimoniController;
use App\Http\Controllers\CartController;

// Route landing page
Route::get('/', [HomeController::class, 'index'])->name('home.main');
Route::get('/articles', [HomeController::class, 'articles'])->name('home.articles.index');
Route::get('/articles/{slug}', [HomeController::class, 'articlesShow'])->name('home.articles.show');
Route::get('/articles/categories/{id}', [HomeController::class, 'articlesCategories'])->name('home.articles.categories');
Route::get('/informasi', [HomeController::class, 'informasi'])->name('home.informasi.index');
Route::get('/informasi/{slug}', [HomeController::class, 'informasiShow'])->name('home.informasi.show');
Route::get('/contact', [HomeController::class, 'contact'])->name('home.contact.index');
Route::post('/contact', [HomeController::class, 'contactStore'])->name('home.contact.store');
Route::get('/team', [HomeController::class, 'team'])->name('home.team.index');
Route::get('/testimoni', [HomeController::class, 'testimoni'])->name('home.testimoni.index');
Route::get('/product', [HomeController::class, 'product'])->name('home.product.index');
Route::get('/product/{slug}', [HomeController::class, 'productShow'])->name('home.product.show');
Route::get('/product/categories/{id}', [HomeController::class, 'productCategories'])->name('home.product.categories');

// Routes untuk Keranjang (Frontend)
Route::prefix('cart')->name('cart.')->group(function () {
    // Tambahkan middleware 'auth' di sini
    Route::post('/add/{product:slug}', [CartController::class, 'addToCart'])->name('add')->middleware('auth');
    Route::get('/', [CartController::class, 'showCart'])->name('show');
    Route::post('/update/{slug}', [CartController::class, 'updateCart'])->name('update');
    Route::delete('/remove/{slug}', [CartController::class, 'removeCart'])->name('remove');
});

// Routes untuk Checkout (Frontend)
// Checkout juga harus memerlukan autentikasi
Route::prefix('checkout')->name('checkout.')->middleware('auth')->group(function () {
    Route::get('/', [CartController::class, 'checkout'])->name('index');
    Route::post('/process', [CartController::class, 'processCheckout'])->name('process');
    Route::get('/success/{orderNumber}', [CartController::class, 'checkoutSuccess'])->name('success');
});

//Route halaman admin/dashboard
Route::middleware(['auth'])->name('admin.')->group(function () {
    //route untuk dashboard
    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('admin/articles', ArticleController::class); // manajemen artikel
    Route::resource('admin/informasi', InformasiController::class); // manajemen informasi
    Route::resource('admin/testimoni', TestimoniController::class); // manajemen kategori

    // Rute profil user yang login
    Route::get('admin/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('admin/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('admin/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route hanya untuk admin
Route::middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
    // Semua rute di dalam grup ini akan memerlukan otentikasi dan peran 'admin'
    Route::resource('admin/users', UserController::class); // manajemen user
    Route::resource('admin/categories', CategoryController::class); // manajemen kategori
    Route::resource('admin/informasi', InformasiController::class); // manajemen kategori
    Route::resource('admin/merek', MerekController::class); // manajemen merek
    Route::resource('admin/product', ProductController::class); // manajemen produk
    Route::resource('admin/testimoni', TestimoniController::class); // manajemen testimoni



    // route untuk inbox
    Route::get('admin/inbox', [InboxController::class, 'index'])->name('inbox.index');
    Route::put('admin/inbox/{inbox}/toggle-status', [InboxController::class, 'toggleStatus'])->name('inbox.toggleStatus');
    Route::delete('admin/inbox/{inbox}', [InboxController::class, 'destroy'])->name('inbox.destroy');

    // Route untuk manajemen pesanan
    Route::get('admin/orders', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
    Route::get('admin/orders/{order}', [App\Http\Controllers\Admin\OrderController::class, 'show'])->name('orders.show');
    Route::put('admin/orders/{order}/status', [App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('orders.updateStatus');

});
