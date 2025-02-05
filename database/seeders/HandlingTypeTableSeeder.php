<?php

namespace Database\Seeders;

use App\Models\HandlingType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HandlingTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HandlingType::create([
            'name' => 'online',
            'description' => 'Online Handling',
            'is_active' => true,
        ]);
    }
}
