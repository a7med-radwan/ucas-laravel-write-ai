<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->delete();

        DB::table('users')->insert([
            'name' => 'Mohammed Safadi',
            'email' => 'm@safadi.ps',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'username' => 'msafadi',
            'timezone' => 'Asia/Gaza',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Ahmed Mohammed',
            'email' => 'a@example.net',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'username' => 'ahmed',
            'timezone' => 'Asia/Gaza',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
