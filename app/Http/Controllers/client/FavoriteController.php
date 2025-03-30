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
            'product_id' => ['required', 'exists:products,id'],
        ]);

        /* Validate For Already Exists */
        if(auth()->user()->favorites()->exists($request->product_id)){
            session()->flash('notification', 'این محصول از قبل در لیست شما موجود میباشد');
            return redirect()->back();
        }
        /* Validate For Already Exists */

        auth()->user()->favorites()->attach($request->product_id);

        session()->flash('notification-success');
        session()->flash('notification', 'با موفقیت به لیست شما اضافه شد');

        return redirect()->route('product.show', $request->product_id);
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
