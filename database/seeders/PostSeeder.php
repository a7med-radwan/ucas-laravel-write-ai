<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Add 10 Categories
        $categories = [];
        for ($i = 0; $i < 10; $i++) {
            $name = $faker->words(2, true);
            $categories[] = [
                'name' => ucfirst($name),
                'slug' => Str::slug($name),
                'description' => $faker->sentence,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('categories')->insert($categories);

        // Get some category and user IDs
        $categoryIds = DB::table('categories')->pluck('id')->toArray();
        $userIds = DB::table('users')->pluck('id')->toArray();

        if (empty($userIds) || empty($categoryIds)) {
            return;
        }

        // Add 20 Posts
        $posts = [];
        $images = [
            'https://images.unsplash.com/photo-1499750310107-5fef28a66643?q=80&w=2070&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1501504905252-473c47e087f8?q=80&w=1974&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1455390582262-044cdead27d8?q=80&w=1973&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1432821596592-e2c18b78144f?q=80&w=2070&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1517842645767-c639042777db?q=80&w=2070&auto=format&fit=crop'
        ];

        $statuses = ['published', 'draft', 'archived'];

        for ($i = 0; $i < 20; $i++) {
            $title = $faker->sentence;
            $posts[] = [
                'user_id' => $faker->randomElement($userIds),
                'category_id' => $faker->randomElement($categoryIds),
                'title' => $title,
                'content' => $faker->paragraphs(3, true),
                'slug' => Str::slug($title) . '-' . ($i + 1),
                'excerpt' => $faker->paragraph,
                'cover_image' => $faker->randomElement($images),
                'status' => $statuses[$i % count($statuses)],
                'views' => $faker->numberBetween(10, 1000),
                'created_at' => $faker->dateTimeBetween('-1 month', 'now'),
                'updated_at' => now(),
            ];
        }
        DB::table('posts')->insert($posts);
    }
}