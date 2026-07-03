<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use JsonSerializable;
use Tests\TestCase;

class PostResourceApiTest extends TestCase
{

    use RefreshDatabase;

    protected $posts;

    public function setUp(): void
    {
        parent::setUp();

        $this->posts = Post::factory(5)->create();
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * A basic feature test example.
     */
    public function test_posts_can_be_retrieved(): void
    {
        $response = $this->get('/app/api/v1/posts');

        $response->assertStatus(200);
        $response->assertJson(function (AssertableJson $json) {

            $json->has('data');
            $json->has('data.0', function (AssertableJson $json) {
                $json->has('id');
                $json->has('title');
                $json->has('content');
                $json->has('slug');
                $json->etc();
            });

            $json->has('links');
            $json->has('meta');
        });
    }

    public function test_posts_can_be_created_by_user(): void
    {
        $user = \App\Models\User::factory()->create();

        $this->actingAs($user);

        $response = $this->post('/app/api/v1/posts', [
            'title' => 'New Test Post 4',
            'content' => 'This is a test post content.',
            'tags' => 'test,post',
            'user_id' => $user->id,
        ], [
            'Accept' => 'application/json',
        ]);

        $response->assertStatus(201);
        $response->assertJson(function (AssertableJson $json) use ($user) {
            $json->has('data');
            $json->has('data.id');
            $json->where('data.user_id', $user->id);
            $json->where('data.title', 'New Test Post 4');
            $json->where('data.content', 'This is a test post content.');
            $json->where('data.slug', 'new-test-post-4');
            $json->etc();
        });
    }
}