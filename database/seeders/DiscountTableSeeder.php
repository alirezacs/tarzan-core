<?php

namespace Database\Seeders;

use App\Models\Discount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiscountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Discount::create([
           'title' => 'Norooz',
           'description' => 'Norooz',
           'expired_at' => now()->addDays(30),
           'discount_type' => 'percent',
           'discount_value' => 50,
           'is_active' => true
        ]);
    }
}
