<?php

namespace Database\Seeders;

use App\Models\RequestType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RequestTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RequestType::create([
            'name' => 'visit',
            'description' => 'Visit Request',
            'is_active' => true,
            'min_price' => '15000',
            'max_price' => '200000',
        ]);
    }
}
