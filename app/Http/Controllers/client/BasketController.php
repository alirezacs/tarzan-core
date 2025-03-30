<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\BasketItemRequest;
use App\Models\ProductVariant;
use App\Models\Transaction;
use App\Services\BasketService;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function addToBasket(BasketItemRequest $request)
    {
        $basket = auth()->user()->basket()->firstOrCreate();

        /* Check For Exists In Basket */
        if($request->type === 'product_variant'){
            if($basket->basketItems()->where([
                'basketable_type' => 'App\Models\ProductVariant',
                'basketable_id' => $request->product_variant_id,
            ])->exists()){
                session()->flash('notification', 'این محصول از قبل در سبد شما موجود میباشد');
                return redirect()->back();
            }
        }
        /* Check For Exists In Basket */

        /* Check For Discount */
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
        /* Check For Discount */

        /* Add To Basket */
        $basket->basketItems()->create([
            'basketable_type' => $request->type === 'product_variant' ? 'App\Models\ProductVariant' : 'App\Models\Request',
            'basketable_id' => $request->type === 'product_variant' ? $request->product_variant_id : $request->request_id,
            'quantity' => $request->type === 'product_variant' ? $request->quantity : 1,
            'total_price' => $totalPrice,
            'total_discount' => $totalDiscount

        ]);
        /* Add To Basket */

        session()->flash('notification-success');
        session()->flash('notification', 'با موفقیت به سبد شما اضافه شد');
        return redirect(route('dashboard') . '#profile-basket');
    }

    public function removeFromBasket(Request $request)
    {
        $request->validate([
            'basket_id' => ['required', 'exists:basket_items,id']
        ]);

        if($item = auth()->user()->basket->basketItems->find($request->basket_id)){
            $item->delete();
        }

        session()->flash('notification-success');
        session()->flash('notification', 'با موفقیت از سبد حذف شد');

        return redirect(route('dashboard') . '#profile-basket');
    }

    public function increaseItem(Request $request)
    {
        $request->validate([
            'basket_item_id' => ['required', 'exists:basket_items,id']
        ]);

        if($item = auth()->user()->basket->basketItems->find($request->basket_item_id)){
            if($item->basketable_type === 'App\Models\ProductVariant'){
                $product = $item->basketable;
                if($item->quantity + 1 <= $product->stock){
                    $item->increment('quantity');
                }else{
                    session()->flash('notification', 'تهداد مورد نظر در انبار موجود نمیباشد');
                    return redirect(route('dashboard') . '#profile-basket');
                }
            }
        }

        session()->flash('notification-success');
        session()->flash('notification', 'با موفقیت تعداد اضافه شد');

        return redirect(route('dashboard') . '#profile-basket');
    }

    public function decreaseItem(Request $request)
    {
        $request->validate([
            'basket_item_id' => ['required', 'exists:basket_items,id']
        ]);

        if($item = auth()->user()->basket->basketItems->find($request->basket_item_id)){
            if($item->basketable_type === 'App\Models\ProductVariant'){
                if($item->quantity - 1 === 0){
                    $item->delete();
                }else{
                    $item->decrement('quantity');
                }
            }
        }

        session()->flash('notification-success');
        session()->flash('notification', 'با موفقیت تعداد کم شد');

        return redirect(route('dashboard') . '#profile-basket');
    }

    public function pay()
    {
        $user = auth()->user();
        $basket = $user->basket()->firstOrCreate();

        /* Check For Exists Any Basket Item */
        if(!count($basket->basketItems)){
            session()->flash('notification', 'سبد خرید شما خالی میباشد');
            return redirect(route('dashboard') . '#profile-basket');
        }
        /* Check For Exists Any Basket Item */

        /* Calc Total Price */
        $totalPrice = 0;
        foreach ($basket->basketItems as $basketItem){
            $totalPrice += $basketItem->total_price;
        }
        /* Calc Total Price */

        try {
            $zarinpal = zarinpal()
                ->amount($totalPrice)
                ->request()
                ->description('خرید محصول از فروشگاه تارزان')
                ->callbackUrl(route('basket.verify'))
                ->send();
            if(!$zarinpal->success()){
                session()->flash('notification', 'خطا در ساخت درگاه');
                return redirect(route('dashboard') . '#profile-basket');
            }
        }catch (\Exception $e){
            // todo Event
            session()->flash('notification', $e->getMessage());
            return redirect(route('dashboard') . '#profile-basket');
        }

        /* Make Transaction */
        $user->transactions()->create([
            'amount' => $totalPrice,
            'authority' => $zarinpal->authority(),
            'fee' => $zarinpal->fee(),
            'fee_type' => $zarinpal->feeType(),
            'link' => $zarinpal->url()
        ]);
        /* Make Transaction */

        return redirect($zarinpal->url());
    }

    public function verify(Request $request)
    {
        $authority = $request->Authority;
        $transaction = Transaction::query()->where('authority', $authority)->first();

        /* Verify Payment */
        try {
            $zarinpal = zarinpal()
                ->amount($transaction->amount)
                ->verification()
                ->authority($transaction->authority)
                ->send();
        }catch (\Exception $e){
            // todo Event
            dd('fail verify');
        }
        /* Verify Payment */

        if($zarinpal->success()){
            $transaction->update([
                'status' => 'payed'
            ]);

            // Convert Basket To Order
            BasketService::convertBasketToOrder($transaction->user->basket->first());

            // Return To Front
            return redirect()->route('payment.success');
        }else{
            $transaction->update([
                'status' => 'cancelled'
            ]);

            // Return To Front
            return redirect()->route('payment.failed');
        }
    }
}
