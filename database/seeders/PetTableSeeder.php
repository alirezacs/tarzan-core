<?php

namespace Database\Seeders;

use App\Models\Breed;
use App\Models\Pet;
use App\Models\PetCategory;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pet::create([
            'name' => 'Ashly',
            'birthdate' => '2004/05/25',
            'gender' => 'male',
            'skin_color' => 'Red',
            'is_active' => 1,
            'pet_category_id' => PetCategory::first()->id,
            'breed_id' => Breed::first()->id,
            'user_id' => User::first()->id
        ]);
    }
}
