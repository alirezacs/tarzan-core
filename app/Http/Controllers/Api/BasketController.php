<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BasketRequest;
use App\Models\Transaction;
use App\Services\BasketService;
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

        /* Make Zarinpal */
        try {
            $zarinpal = zarinpal()
                ->amount($totalPrice)
                ->request()
                ->description('خرید محصول از فروشگاه تارزان')
                ->callbackUrl(route('basket.verify'))
                ->send();
            if(!$zarinpal->success()){
                return apiResponse(message: $zarinpal->error()->message(), status: 500);
            }
        }catch (\Exception $e){
            // todo Event
            return apiResponse(message: 'Error In Make Payment');
        }
        /* Make Zarinpal */

        /* Make Transaction */
        $user->transactions()->create([
            'amount' => $totalPrice,
            'authority' => $zarinpal->authority(),
            'fee' => $zarinpal->fee(),
            'fee_type' => $zarinpal->feeType(),
            'link' => $zarinpal->url()
        ]);
        /* Make Transaction */

        return apiResponse(data: ['payment' => $zarinpal->url()], message: 'Payment Created Successfully');

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
            return apiResponse(message: 'Error In Verify Payment:' . $e->getMessage());
        }
        /* Verify Payment */

        if($zarinpal->success()){
            $transaction->update([
                'status' => 'payed'
            ]);

            // Convert Basket To Order
            BasketService::convertBasketToOrder($transaction->user->basket->first());

            // Return To Front
            dd('Payed');
        }else{
            $transaction->update([
                'status' => 'cancelled'
            ]);

            // Return To Front
            dd('failed');
        }
    }
}
