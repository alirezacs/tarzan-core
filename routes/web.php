<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\client\HomeController;

/* Home Route */
Route::get('/', [HomeController::class, 'index'])->name('home');
/* Home Route */
