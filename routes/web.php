<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\OrderController;
use Illuminate\Support\Facades\Route;

// ... file routes/web.php ...

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'store'])->name('cart.store');
Route::delete('/cart/remove/{productId}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // !!! TAMBAHKAN BARIS INI !!!
    // Rute untuk Manajemen Menu (CRUD Products)
    Route::resource('admin/products', \App\Http\Controllers\Admin\ProductController::class)->names('products');

    Route::get('admin/orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('admin/orders/{order}', [OrderController::class, 'show'])->name('admin.orders.show');

    Route::patch('admin/orders/{order}', [OrderController::class, 'updateStatus'])->name('admin.orders.update');
});

require __DIR__.'/auth.php';
