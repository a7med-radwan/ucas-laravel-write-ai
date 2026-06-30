<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Handle the search request.
     */
    public function __invoke(Request $request)
    {
        $search = $request->query('search', '');

        $posts = Post::published()
            ->with(['category', 'user'])
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('content', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('views')
            ->paginate(8);

        return view('search', compact('posts', 'search'));
    }
}
