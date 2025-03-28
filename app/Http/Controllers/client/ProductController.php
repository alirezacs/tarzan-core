<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $where = [
            'is_active' => 1,
        ];
        if($request->has('category')){
            if(ProductCategory::query()->find($request->get('category'))){
                $where['product_category_id'] = $request->get('category');
            }
        }
        $products = Product::query()->where($where)->get();

        $categories = ProductCategory::query()->where('is_active', 1)->get();
        return view('client.product.index', compact('categories', 'products'));
    }

    public function show(Product $product)
    {
        dd($product);
    }
}
