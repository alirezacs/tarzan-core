<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\client\HomeController;
use App\Http\Controllers\Client\Auth\AuthController;
use App\Http\Controllers\Client\DashboardController;
use App\Http\Controllers\Client\UserController;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\Client\FavoriteController;
use App\Http\Controllers\Client\BasketController;
use App\Http\Controllers\Client\BlogController;

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
    Route::post('basket/remove', [BasketController::class, 'removeFromBasket'])->name('basket.remove');
    Route::post('basket/increase', [BasketController::class, 'increaseItem'])->name('basket.increase');
    Route::post('basket/decrease', [BasketController::class, 'decreaseItem'])->name('basket.decrease');
    Route::post('basket/pay', [BasketController::class, 'pay'])->name('basket.pay');
    /* Basket Controller */
});

/* Product Routes */
Route::get('store', [ProductController::class, 'index'])->name('product.index');
Route::get('store/product/{product}', [ProductController::class, 'show'])->name('product.show');
/* Product Routes */

Route::get('basket/verify', [BasketController::class, 'verify'])->name('basket.verify');

/* Payment Routes */
Route::view('payment/success', 'client.payment.success')->name('payment.success');
Route::view('payment/failed', 'client.payment.failed')->name('payment.failed');
/* Payment Routes */

/* About Us Page */
Route::view('about', 'client.about')->name('about');
/* About Us Page */

/* Contact Us Page */
Route::view('contact', 'client.contact')->name('contact');
/* Contact Us Page */

/* Blog Routes */
Route::resource('article', BlogController::class)->only(['index']);
/* Blog Routes */
