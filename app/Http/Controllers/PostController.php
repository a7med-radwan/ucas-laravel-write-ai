<?php

namespace App\Http\Controllers;

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

    public function show(int $id, string $slug = '')
    {
        $post = null;
        foreach ($this->posts as $p) {
            if ($p['id'] === $id) {
                $post = $p;
                break;
            }
        }
        if (!$post) {
            abort(404);
        }
        return view('blog.single-standard', [
            'post' => $post,
        ]);
    }


}
