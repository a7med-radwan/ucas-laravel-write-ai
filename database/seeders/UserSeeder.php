<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'username' => 'admin2',
            'type' => 'admin',
            'timezone' => 'Asia/Gaza',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $superAdmin = \App\Models\User::create([
            'name' => 'Super Admin',
            'email' => 'super-admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'username' => 'superadmin',
            'timezone' => 'Asia/Gaza',
            'type' => 'super-admin',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $superAdminRole = \App\Models\Role::where('name', 'Super Admin')->first();
        if ($superAdminRole) {
            $superAdmin->roles()->attach($superAdminRole->id);
        }

        $managerRole = \App\Models\Role::where('name', 'Manager')->first();
        if ($managerRole) {
            $admin->roles()->attach($managerRole->id);
        }
        // $users = [
        //     [
        //         'name' => 'Admin User',
        //         'email' => 'admin@example.com',
        //         'email_verified_at' => now(),
        //         'password' => Hash::make('password'),
        //         'username' => 'admin',
        //         'timezone' => 'Asia/Gaza',
        //         'status' => 'active',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'name' => 'Editor User',
        //         'email' => 'editor@example.com',
        //         'email_verified_at' => now(),
        //         'password' => Hash::make('password'),
        //         'username' => 'editor',
        //         'timezone' => 'Asia/Gaza',
        //         'status' => 'active',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'name' => 'Writer User',
        //         'email' => 'writer@example.com',
        //         'email_verified_at' => now(),
        //         'password' => Hash::make('password'),
        //         'username' => 'writer',
        //         'timezone' => 'Asia/Gaza',
        //         'status' => 'active',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        // ];

        // DB::table('users')->insert($users);
    }
}
