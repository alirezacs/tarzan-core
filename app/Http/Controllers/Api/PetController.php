<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PetRequest;
use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        return apiResponse(auth()->user()->pets->toArray());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PetRequest $request): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $data = $request->only([
            'name',
            'birthdate',
            'gender',
            'skin_color',
            'is_active',
            'pet_category_id',
            'breed_id',
        ]);

        /* Create Pet */
        $pet = auth()->user()->pets()->create($data);
        /* Create Pet */

        return apiResponse($pet->toArray(), 'Pet created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pet $pet): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        return apiResponse($pet->toArray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PetRequest $request, Pet $pet): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
    {
        $data = $request->only([
            'name',
            'birthdate',
            'gender',
            'skin_color',
            'is_active',
            'pet_category_id',
            'breed_id',
        ]);

        /* Update Pet */
        $pet->update($data);
        /* Update Pet */

        return apiResponse(message: 'Pet updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
