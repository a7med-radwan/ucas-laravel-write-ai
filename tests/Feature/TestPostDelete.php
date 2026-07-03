<?php

use App\Models\Post;
use App\Models\User;

test('test delete post', function () {

    $user = User::factory()->create();
    $this->actingAs($user);

    $post = Post::factory()->create([
        'title' => 'Test Post',
        'content' => 'This is a test post content.',
        'user_id' => $user->id,
    ]);


    $response = $this->delete("/app/api/v1/posts/{$post->id}", [], [
        'Accept' => 'application/json',
    ]);

    $response->assertStatus(204);
});