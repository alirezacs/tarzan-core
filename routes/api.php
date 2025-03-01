<?php

use App\Http\Controllers\Api\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

/* Auth Routes */
Route::post('login', [LoginController::class, 'authentication']);
Route::post('login/verify', [LoginController::class, 'verifyCode']);
/* Auth Routes */

Route::middleware(['auth:sanctum'])->group(function (){
    /* Me Route */
    Route::get('me', [LoginController::class, 'me']);
    Route::put('user', [UserController::class, 'update']);
    /* Me Route */
});
