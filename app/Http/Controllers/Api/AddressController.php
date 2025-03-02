<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AddressRequest;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        return apiResponse(auth()->user()->addresses->toArray());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddressRequest $request): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $data = $request->only([
            'name',
            'address',
            'latitude',
            'longitude'
        ]);

        /* Create Address */
        $address = auth()->user()->addresses()->create($data);
        /* Create Address */

        return apiResponse($address->toArray(), 'Address created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        return apiResponse($address->toarray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AddressRequest $request, Address $address): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $data = $request->only([
            'name',
            'address',
            'latitude',
            'longitude'
        ]);

        /* Update Address */
        $address->update($data);
        /* Update Address */

        return apiResponse(message: 'Address updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
