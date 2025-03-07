<?php

use App\Http\Controllers\Api\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\PetController;

/* Auth Routes */
Route::post('login', [LoginController::class, 'authentication']);
Route::post('login/verify', [LoginController::class, 'verifyCode']);
/* Auth Routes */

Route::middleware(['auth:sanctum'])->group(function (){
    /* Me Route */
    Route::get('me', [LoginController::class, 'me']);
    /* Me Route */

    /* Update Profile */
    Route::put('user', [UserController::class, 'update']);
    /* Update Profile */

    /* Logout */
    Route::post('logout', [LoginController::class, 'logout']);
    /* Logout */

    /* Address Routes */
    Route::apiResource('address', AddressController::class);
    /* Address Routes */

    /* Pet Routes */
    Route::apiResource('pet', PetController::class);
    /* Pet Routes */
});
