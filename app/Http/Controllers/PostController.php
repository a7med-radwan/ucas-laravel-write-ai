<?php

namespace App\Http\Controllers;

use App\Events\PostViewed;
use App\Models\Post;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::query()->published()->latest()->get();

        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

    public function show(string $slug)
    {
        $post = Post::query()
            ->published()
            ->slug($slug)
            ->firstOrFail();

        // $post->increment('views');
        // event('posts.viewed', $post);
        // event(new PostViewed($post));
        broadcast(new PostViewed($post))->toOthers();

        return view('posts.show', [
            'post' => $post,
        ]);
    }
}