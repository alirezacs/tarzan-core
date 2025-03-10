<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transaction::create([
            'amount' => '10000',
            'authority' => 'test',
            'fee' => 'test',
            'fee_type' => 'test',
            'code' => 'test',
            'status' => 'payed',
            'user_id' => User::first()->id,
        ]);
    }
}
