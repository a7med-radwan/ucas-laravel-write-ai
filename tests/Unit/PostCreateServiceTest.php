<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Services\PostService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostCreateServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     */
    public function test_create_with_valid_data(): void
    {
        $service = app(PostService::class);

        $user = User::factory()->create();

        $post = $service->create([
            'title' => 'New Test Post',
            'content' => 'This is a test post content.',
            'tags' => 'test,post',
            'user_id' => $user->id,
        ]);

        $this->assertInstanceOf(Post::class, $post);
        $this->assertEquals('New Test Post', $post->title);
        $this->assertEquals('This is a test post content.', $post->content);
    }

    public function test_create_with_invalid_data(): void
    {
        $service = app(PostService::class);

        $this->expectException(\Illuminate\Validation\ValidationException::class);

        $service->create([
            'title' => '', // Invalid title
            'content' => '', // Invalid content
            'tags' => 'test,post',
            'user_id' => 9999, // Non-existent user
        ]);
    }
}