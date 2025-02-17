<?php

namespace Database\Seeders;

use App\Models\Basket;
use App\Models\BasketItem;
use App\Models\ProductVariant;
use App\Models\Request;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BasketTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $basket = Basket::create([
            'user_id' => User::first()->id
        ]);

        $basketItem = BasketItem::create([
            'basket_id' => $basket->id,
            'product_variant_id' => ProductVariant::first()->id,
            'quantity' => 1,
            'total_price' => '150000'
        ]);
    }
}
