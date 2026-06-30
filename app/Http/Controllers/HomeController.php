<?php

namespace App\Http\Controllers;

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
        $tag = $request->query('tag');

        $posts = Post::published()
            ->with(['category', 'user'])
            ->when($tag, function ($query, $tag) {
                $query->whereHas('tags', function ($query) use ($tag) {
                    $query->where('name', $tag)
                        ->orWhere('slug', $tag);
                });
            })
            ->orderBy('views', 'desc')
            ->paginate(4
            );

        $tags = Tag::with('posts')->get();

        $trendingPosts = Post::published()
            ->with(['category', 'user'])
            ->orderByDesc('views')
            ->take(3)
            ->get();

        return view('home', compact('posts', 'tags', 'trendingPosts'));
    }
}
