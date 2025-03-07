<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Foundation\Application
    {
        $products = Product::query()->where('is_active', true)->get()->toArray();

        return apiResponse($products);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        return apiResponse($product->load('product_variants')->toArray());
    }
}
