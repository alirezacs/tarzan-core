<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductVariantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductVariant::create([
            'title' => 'First Variant',
            'price' => 1000,
            'stock' => 10,
            'is_active' => true,
            'product_id' => Product::first()->id,
            'color_id' => Color::first()->id,
            'size_id' => Size::first()->id
        ]);
    }
}
