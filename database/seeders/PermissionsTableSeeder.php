<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['name' => 'create-user', 'description' => 'Create a new user'],
            ['name' => 'edit-user', 'description' => 'Edit an existing user'],
            ['name' => 'delete-user', 'description' => 'Delete a user'],
            ['name' => 'create-product', 'description' => 'Create a new product'],
            ['name' => 'edit-product', 'description' => 'Edit an existing product'],
            ['name' => 'delete-product', 'description' => 'Delete a product'],
            ['name' => 'create-category', 'description' => 'Create a new category'],
            ['name' => 'edit-category', 'description' => 'Edit an existing category'],
            ['name' => 'delete-category', 'description' => 'Delete a category'],
            ['name' => 'create-role', 'description' => 'Create a new role'],
            ['name' => 'edit-role', 'description' => 'Edit an existing role'],
            ['name' => 'delete-role', 'description' => 'Delete a role'],
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission['name']], ['description' => $permission['description']]);
        }
    }
}
