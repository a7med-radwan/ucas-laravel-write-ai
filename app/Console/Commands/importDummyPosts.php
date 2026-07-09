<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

#[Signature('app:import-posts {--count=20 : The number of dummy posts to import}')]
#[Description('Import dummy posts')]
class ImportDummyPosts extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $count = $this->option('count');

        $this->info('Importing dummy posts...');

        $user = User::query()
            ->where('status', 'active')
            ->where('type', 'user')
            ->first();

        if (!$user) {
            $user = User::query()->where('status', 'active')->first();
        }

        if (!$user) {
            $user = User::query()->first();
        }

        if (!$user) {
            $this->error('No users found in the database. Please seed the database first.');
            return;
        }

        $category = \App\Models\Category::query()
            ->first();

        $response = Http::baseUrl('https://jsonplaceholder.typicode.com')
            ->withHeaders([
                'Accept' => 'application/json',
                //'Authorization' => 'Bearer [your_api_token_here]',
            ])
            ->withToken('[your_api_token_here]')
            ->get('/posts', [
                'page' => 1,
                'limit' => 10,
            ]);

        if ($response->failed()) {
            $this->error($response->status() . ': Failed to fetch dummy posts.');
            return;
        }

        $posts = $response->json();
        $posts = array_slice($posts, 0, $count);

        foreach ($posts as $post) {
            \App\Models\Post::create([
                'title' => $post['title'] . ' (Dummy)',
                'content' => $post['body'],
                'user_id' => $user->id,
                'category_id' => $category?->id ?? null, // Assign to a default category
                'published_at' => now(),
            ]);
        }

        $this->info('Dummy posts imported successfully.');
    }
}