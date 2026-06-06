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
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'username' => 'admin',
                'timezone' => 'Asia/Gaza',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Editor User',
                'email' => 'editor@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'username' => 'editor',
                'timezone' => 'Asia/Gaza',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Writer User',
                'email' => 'writer@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'username' => 'writer',
                'timezone' => 'Asia/Gaza',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('users')->insert($users);
    }
}
