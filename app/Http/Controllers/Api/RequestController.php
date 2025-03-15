<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RequestValidationRequest;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        return apiResponse(data: auth()->user()->requests->toArray());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestValidationRequest $request): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $data = $request->only([
            'pet_id',
            'request_type_id',
            'handling_type_id',
            'description',
            'address_id',
            'handling_date',
            'is_emergency',
        ]);

        /* Set Total Paid */
        $data['total_paid'] = 0;
        /* Set Total Paid */

        /* Create Request */
        $requestModel = auth()->user()->requests()->create($data);
        /* Create Request */

        /* Add To Basket */
        auth()->user()->basket->basketItems()->create([
            'basketable_id' => $requestModel->id,
            'basketable_type' => get_class($requestModel),
            'quantity' => 1,
            'total_price' => $requestModel->request_type->min_price,
        ]);
        /* Add To Basket */

        return apiResponse($requestModel->toArray(), message: 'Request Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
