<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrCreate(['email' => 'super-admin@gmail.com',],[
            'name' => 'Super Admin',
            'password' => Hash::make('12345678'),
        ]);
        $role = Role::firstOrCreate(['name' => 'super-admin'], ['description' => 'This is the highest role ']);
        $user->roles()->sync($role->id);
    }
}
