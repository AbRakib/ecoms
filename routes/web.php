<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', [AppController::class, 'index'])->name('app.index');
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/product-details/{slug}', [ShopController::class, 'productDetails'])->name('shop.product.details');
Route::get('/cart-wishlist-count', [ShopController::class, 'getCartAndWishlistCount'])->name('shop.cart.wishlist.count');

// cart route
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/store', [CartController::class, 'addToCart'])->name('cart.store');
Route::put('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
Route::delete('/cart/remove', [CartController::class, 'removeItem'])->name('cart.remove');
Route::delete('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');

// Wishlist route
Route::get('/wishlist', [WishlistController::class, 'getWishlistedProducts'])->name('wishlist.list');
Route::post('/wishlist/add', [WishlistController::class, 'addProductToWishlist'])->name('wishlist.store');

Auth::routes();


// frontend
Route::middleware(['auth'])->group(function () {
    Route::get('/my-account', [UserController::class, 'index'])->name('user.index');
});



// backend
Route::middleware(['auth', 'auth.admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});