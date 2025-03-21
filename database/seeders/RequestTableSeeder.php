<?php

namespace Database\Seeders;

use App\Models\HandlingType;
use App\Models\Pet;
use App\Models\Request;
use App\Models\RequestType;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RequestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Request::create([
            'user_id' => User::first()->id,
            'pet_id' => Pet::first()->id,
            'request_type_id' => RequestType::first()->id,
            'handling_type_id' => HandlingType::first()->id,
            'status' => null,
            'description' => null,
            'address_id' => User::first()->addresses()->first()->id,
            'total_paid' => '20000000',
            'handling_date' => now(),
            'is_emergency' => true,
        ]);
    }
}
