<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $featuredPost = Post::published()
            ->with(['category', 'user'])
            ->orderBy('views', 'desc')
            ->first();

        $posts = Post::published()
            ->with(['category', 'user'])
            ->when($featuredPost, function ($query) use ($featuredPost) {
                $query->where('id', '!=', $featuredPost->id);
            })
            ->orderBy('views', 'desc')
            ->paginate(5);

        $categories = Category::take(10)->get();

        $trendingPosts = Post::published()
            ->with(['category'])
            ->orderByDesc('views')
            ->take(3)
            ->get();

        return view('home', compact('featuredPost', 'posts', 'categories', 'trendingPosts'));
    }
}
