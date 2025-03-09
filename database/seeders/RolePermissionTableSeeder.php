<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Permissions
        $permissions = [
            'read-address',
            'create-address',
            'edit-address',
            'delete-address',

            'read-basket',
            'create-basket',
            'edit-basket',
            'delete-basket',

            'read-brand',
            'create-brand',
            'edit-brand',
            'delete-brand',

            'read-breed',
            'create-breed',
            'edit-breed',
            'delete-breed',

            'read-color',
            'create-color',
            'edit-color',
            'delete-color',

            'read-discount',
            'create-discount',
            'edit-discount',
            'delete-discount',

            'read-handling_type',
            'create-handling_type',
            'edit-handling_type',
            'delete-handling_type',

            'read-permission',
            'create-permission',
            'edit-permission',
            'delete-permission',

            'read-pet',
            'create-pet',
            'edit-pet',
            'delete-pet',

            'read-pet_category',
            'create-pet_category',
            'edit-pet_category',
            'delete-pet_category',

            'read-product',
            'create-product',
            'edit-product',
            'delete-product',

            'read-product_category',
            'create-product_category',
            'edit-product_category',
            'delete-product_category',

            'read-product_variant',
            'create-product_variant',
            'edit-product_variant',
            'delete-product_variant',

            'read-request',
            'create-request',
            'edit-request',
            'delete-request',

            'read-request_type',
            'create-request_type',
            'edit-request_type',
            'delete-request_type',

            'read-role',
            'create-role',
            'edit-role',
            'delete-role',

            'read-service',
            'create-service',
            'edit-service',
            'delete-service',

            'read-size',
            'create-size',
            'edit-size',
            'delete-size',

            'read-user',
            'create-user',
            'edit-user',
            'delete-user',

            'read-article_category',
            'create-article_category',
            'edit-article_category',
            'delete-article_category',

            'read-article',
            'create-article',
            'edit-article',
            'delete-article',
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
            ]);
        }

        // Create Roles
        $roles = [
            'developer',
            'manager'
        ];

        foreach ($roles as $role) {
            Role::create([
                'name' => $role,
            ]);
        }

        /* Assign Permissions */
        Role::query()->where('name', 'developer')->first()->givePermissionTo($permissions);

        /* Assign Role To User */
        User::first()->assignRole('developer');
    }
}
