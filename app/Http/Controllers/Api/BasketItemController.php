<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BasketItemRequest;
use App\Models\BasketItem;
use App\Models\ProductVariant;
use App\Models\User;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class BasketItemController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(BasketItemRequest $request): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        /* Check For Exists Basket */
        $basket = \auth()->user()->basket()->firstOrCreate();
        /* Check For Exists Basket */

        /* Check For Exists In Basket */
        if($request->input('type') === 'product_variant') {
            if($basket->basketItems()->where([
                'basketable_type' => 'App\Models\ProductVariant',
                'basketable_id' => $request->product_variant_id
            ])->exists()){
                return apiResponse(message: 'Product Variant is already added to your basket', status: 422);
            };
        }else{
            if($basket->basketItems()->where([
                'basketable_type' => 'App\Models\Request',
                'basketable_id' => $request->request_id
            ])->exists()){
                return apiResponse(message: 'Request is already added to your basket', status: 422);
            }
        }
        /* Check For Exists In Basket */

        /* Check For Discount On Item */
        if($request->type === 'product_variant') {
            $product = ProductVariant::query()->find($request->product_variant_id);
            if($discount = $product->discount()->first()){
                if($discount->discount_type == 'percent'){
                    $totalDiscount = $request->quantity * ($product->price * $discount->discount_value) / 100;
                    $totalPrice = $request->quantity * ($product->price - (($product->price * $discount->discount_value) / 100));
                }else{
                    $totalDiscount = $request->quantity * ($product->price - $discount->discount_value);
                    $totalPrice = $request->quantity * ($product->price - $discount->discount_value);
                }
            }else{
                $totalPrice = $product->price;
                $totalDiscount = 0;
            }
        }else{
            $requestModel = \App\Models\Request::query()->find($request->request_id);
            $totalPrice = $requestModel->request_type->min_price;
            $totalDiscount = null;
        }
        /* Check For Discount On Item */

        /* Add Item To Basket */
        $basket->basketItems()->create([
            'basketable_type' => $request->type === 'product_variant' ? 'App\Models\ProductVariant' : 'App\Models\Request',
            'basketable_id' => $request->type === 'product_variant' ? $request->product_variant_id : $request->request_id,
            'quantity' => $request->type === 'product_variant' ? $request->quantity : 1,
            'total_price' => $totalPrice,
            'total_discount' => $totalDiscount,
        ]);
        /* Add Item To Basket */

        return apiResponse(message: 'Item Added to Basket');
    }

    /**
     * @param Request $request
     * @return Application|Response|\Illuminate\Contracts\Foundation\Application|ResponseFactory
     */
    public function addQuantity(Request $request): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $request->validate([
            'basket_item_id' => ['required', 'exists:basket_items,id'],
        ]);

        $basketItem = BasketItem::query()->find($request->basket_item_id);

        if($basketItem->basketable_type === 'App\Models\Request') {
            return apiResponse(message: 'Can not Add Quantity Of This Item', status: 422);
        }

        /* Check For Exists Quantity */
        if($basketItem->basketable_type === 'App\Models\ProductVariant' && $basketItem->quantity + 1 > $basketItem->basketable->stock){
            return apiResponse(message: 'Quantity Exceeded', status: 422);
        }
        /* Check For Exists Quantity */

        /* Calc Price */
        $product = $basketItem->basketable;
        if($discount = $product->discount()->first()){
            if($discount->discount_type == 'percent'){
                $totalDiscount = ($basketItem->quantity + 1) * ($product->price * $discount->discount_value) / 100;
                $totalPrice = ($basketItem->quantity + 1) * ($product->price - (($product->price * $discount->discount_value) / 100));
            }else{
                $totalDiscount = ($basketItem->quantity + 1) * ($product->price - $discount->discount_value);
                $totalPrice = ($basketItem->quantity + 1) * ($product->price - $discount->discount_value);
            }
        }else{
            $totalPrice = ($basketItem->quantity + 1) * $product->price;
            $totalDiscount = null;
        }
        /* Calc Price */

        $basketItem->update([
            'quantity' => $basketItem->quantity += 1,
            'total_price' => $totalPrice,
            'total_discount' => $totalDiscount,
        ]);

        return apiResponse(message: 'Quantity Added to Basket');
    }

    /**
     * @param Request $request
     * @return Application|Response|\Illuminate\Contracts\Foundation\Application|ResponseFactory
     */
    public function decreaseQuantity(Request $request): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $request->validate([
            'basket_item_id' => ['required', 'exists:basket_items,id'],
        ]);

        $basketItem = BasketItem::query()->find($request->basket_item_id);

        /* Check For Exists Quantity */
        if($basketItem->basketable_type === 'App\Models\ProductVariant'){
            if($basketItem->quantity - 1 === 0){
                $basketItem->delete();
                return apiResponse(message: 'Basket Deleted');
            }

            /* Calc Price */
            $product = $basketItem->basketable;
            if($discount = $product->discount()->first()){
                if($discount->discount_type == 'percent'){
                    $totalDiscount = ($basketItem->quantity - 1) * ($product->price * $discount->discount_value) / 100;
                    $totalPrice = ($basketItem->quantity - 1) * ($product->price - (($product->price * $discount->discount_value) / 100));
                }else{
                    $totalDiscount = ($basketItem->quantity - 1) * ($product->price - $discount->discount_value);
                    $totalPrice = ($basketItem->quantity - 1) * ($product->price - $discount->discount_value);
                }
            }else{
                $totalPrice = ($basketItem->quantity - 1) * $product->price;
                $totalDiscount = null;
            }
            /* Calc Price */
        }else{
            $basketItem->delete();
            return apiResponse(message: 'Basket Deleted');
        }
        /* Check For Exists Quantity */



        $basketItem->update([
            'quantity' => $basketItem->quantity -= 1,
            'total_price' => $totalPrice,
            'total_discount' => $totalDiscount,
        ]);

        return apiResponse(message: 'Basket Quantity Decreased');
    }
}
