<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\client\HomeController;
use App\Http\Controllers\Client\Auth\AuthController;
use App\Http\Controllers\Client\DashboardController;
use App\Http\Controllers\Client\UserController;

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
});
