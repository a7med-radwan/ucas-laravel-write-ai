<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected array $posts = [];

    public function __construct()
    {
        $this->posts = include resource_path('data/posts.php');
        // You can add middleware here if needed
    }

    public function index()
    {
        return view('blog.index', [
            'posts' => $this->posts,
        ]);
    }

    public function show(string $slug)
    {
        $post = Post::query()->where('slug', $slug)->firstOrFail();

        return view('posts.show', [
            'post' => $post,
        ]);
    }
}