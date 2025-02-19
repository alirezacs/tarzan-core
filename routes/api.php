<?php

use App\Http\Controllers\Api\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* Auth Routes */
Route::post('login', [LoginController::class, 'authentication']);
/* Auth Routes */
