<?php

namespace App\Services;

use App\Models\Basket;
use App\Models\Order;

class BasketService
{
    public static function convertBasketToOrder(Basket $basket)
    {
        $totalPrice = 0;
        $totalDiscount = 0;
        $orderItems = [];

        foreach ($basket->basketItems as $basketItem) {
            $totalPrice += $basketItem->total_price;
            $totalDiscount += $basketItem->total_discount;

            /* Make Order Item */
            $orderItems[] = [
                'quantity' => $basketItem->quantity,
                'total_price' => $basketItem->total_price,
                'total_discount' => $basketItem->total_discount,
                'json' => json_encode($basketItem->toArray()),
                'product_variant_id' => $basketItem->product_variant_id,
            ];
            /* Make Order Item */
        }

        /* Create Order */
        $order = $basket->user->orders()->create([
            'total_price' => $totalPrice,
            'total_discount' => $totalDiscount,
        ]);
        /* Create Order */

        /* Create Order Items */
        $order->orderItems()->createMany($orderItems);
        /* Create Order Items */

        /* Delete Basket */
        $basket->delete();
        /* Delete Basket */
    }
}
