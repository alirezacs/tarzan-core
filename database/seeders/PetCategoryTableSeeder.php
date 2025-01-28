<?php

namespace Database\Seeders;

use App\Models\PetCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PetCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PetCategory::create([
            'name' => 'Doberman',
            'is_active' => 1
        ]);
    }
}
