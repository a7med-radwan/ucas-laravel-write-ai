<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $featuredPost = Post::where('status', 'published')
            ->latest()
            ->first();

        $posts = Post::where('status', 'published')
            ->when($featuredPost, function ($query) use ($featuredPost) {
                $query->where('id', '!=', $featuredPost->id);
            })
            ->latest()
            ->paginate(5);

        $categories = Category::take(5)->get();

        $trendingPosts = Post::where('status', 'published')
            ->orderByDesc('views')
            ->take(3)
            ->get();

        return view('home', compact('featuredPost', 'posts', 'categories', 'trendingPosts'));
    }
}
