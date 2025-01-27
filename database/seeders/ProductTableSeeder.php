<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'title' => fake()->title,
            'slug' => fake()->slug,
            'description' => fake()->text('200'),
            'product_category_id' => ProductCategory::first()->id,
            'brand_id' => Brand::first()->id,
            'is_active' => true,
            'body' => fake()->text(100000),
        ]);
    }
}
