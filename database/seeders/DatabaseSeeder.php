<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
           UserTableSeeder::class,
           RolePermissionTableSeeder::class,
           ProductCategoryTableSeeder::class,
           BrandTableSeeder::class,
           ProductTableSeeder::class,
           ColorTableSeeder::class,
           SizeTableSeeder::class,
           ProductVariantTableSeeder::class,
           PetCategoryTableSeeder::class,
           BreedTableSeeder::class,
           PetTableSeeder::class,
           AddressTableSeeder::class,
           HandlingTypeTableSeeder::class,
           RequestTypeTableSeeder::class,
        ]);
    }
}
