<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('categories')->insert([
            'name' => 'General',
            'slug' => 'general',
            'description' => 'Category for general posts.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $category = DB::table('categories')
            ->where('slug', 'general')
            ->orderBy('id', 'desc')
            ->limit(1)
            ->first();

        DB::table('posts')->insert([
            'user_id' => 1,
            'category_id' => $category->id,
            'title' => 'My First Post',
            'content' => 'This is the content of my first post.',
            'slug' => 'my-first-post',
            'excerpt' => 'This is the content of my first post.',
            'cover_image' => null,
            'status' => 'published',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('posts')->insert([
            'user_id' => 1,
            'category_id' => $category->id,
            'title' => 'My Second Post',
            'content' => 'This is the content of my second post.',
            'slug' => 'my-second-post',
            'excerpt' => 'This is the content of my second post.',
            'cover_image' => null,
            'status' => 'published',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
