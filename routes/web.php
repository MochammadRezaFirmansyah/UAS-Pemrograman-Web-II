<?php

use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController as PublicProductController;
use App\Http\Controllers\ProductReviewController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::name('admin.')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::resource('products', ProductController::class);
        Route::resource('orders', OrderController::class);
    });
});

Route::get('/products', [PublicProductController::class, 'index'])->name('products.index');
Route::get('/product/{product:id}', [PublicProductController::class, 'show'])->name('products.show');
Route::post('/product/{product:id}', [ProductReviewController::class, 'store'])->name('products.store');

Route::get('/carts', [CartController::class, 'index'])->name('carts.index');
Route::get('/carts/add/{product:id}', [CartController::class, 'add'])->name('carts.add');
Route::patch('/carts/update', [CartController::class, 'update'])->name('carts.update');
Route::delete('/carts/remove', [CartController::class, 'remove'])->name('carts.remove');