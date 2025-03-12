<?php

use App\Models\BasketItem;
use App\Models\RequestType;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BasketController;

/* Basket Routes */
Route::get('basket/verify', [BasketController::class, 'verify'])->name('basket.verify');
/* Basket Routes */
