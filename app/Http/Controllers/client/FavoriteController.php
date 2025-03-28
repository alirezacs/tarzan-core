<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id']
        ]);

        /* Check For Already Exists */
        if(auth()->user()->favorites()->exists($request->product_id)){
            toastr()->error('از قبل در لیست موجود میباشد');
            return redirect()->back();
        }
        /* Check For Already Exists */

        $product = Product::query()->find($request->product_id);

        auth()->user()->favorites()->attach($product->id);

        toastr()->success('با موفقیت به لیست علاقه مندی ها اضافه شد');

        return redirect()->route('back');
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
