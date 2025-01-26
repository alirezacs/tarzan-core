<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Alireza',
            'last_name' => 'Mardani',
            'email' => 'alireza@gmail.com',
            'phone' => '09216799604',
            'password' => Hash::make('123456'),
            'is_active' => 1
        ]);
    }
}
