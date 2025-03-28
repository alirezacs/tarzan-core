<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\client\HomeController;
use App\Http\Controllers\Client\Auth\AuthController;
use App\Http\Controllers\Client\DashboardController;
use App\Http\Controllers\Client\UserController;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\Client\FavoriteController;
use App\Http\Controllers\Client\BasketController;

/* Home Route */
Route::get('/', [HomeController::class, 'index'])->name('home');
/* Home Route */

/* Login Routes */
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authentication'])->name('authentication');
/* Login Routes */

Route::middleware('auth')->prefix('profile')->group(function () {
    /* Dashboard Route */
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/profile', [UserController::class, 'update'])->name('profile.update');
    /* Dashboard Route */

    /* Favorite Routes */
    Route::post('/favorite', [FavoriteController::class, 'store'])->name('favorite.store');
    /* Favorite Routes */

    /* Basket Controller */
    Route::post('basket/add', [BasketController::class, 'addToBasket'])->name('basket.add');
    /* Basket Controller */
});

/* Product Routes */
Route::get('store', [ProductController::class, 'index'])->name('product.index');
Route::get('store/product/{product}', [ProductController::class, 'show'])->name('product.show');
/* Product Routes */
