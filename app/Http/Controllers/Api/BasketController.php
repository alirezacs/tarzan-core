<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BasketRequest;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        return apiResponse(auth()->user()->basket->basketItems->toArray());
    }

    public function pay(Request $request)
    {
        $user = auth()->user();
        $basket = $user->basket()->firstOrCreate();

        /* Check For Exists Item In Basket */
        if(!count($basket->basketItems)){
            return apiResponse(message: 'Basket Is Empty');
        }
        /* Check For Exists Item In Basket */

        /* Calc Total Price */
        $totalPrice = 0;
        foreach ($basket->basketItems as $basketItem){
            $totalPrice += $basketItem->total_price;
        }
        /* Calc Total Price */

        /* Make Transaction */

        /* Make Transaction */

        /* Make Zarinpal */

        /* Make Zarinpal */
    }
}
