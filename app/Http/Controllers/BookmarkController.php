<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class BookmarkController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $user = $request->user();

        if (! $user->bookmarkedPosts()->where('post_id', $post->id)->exists()) {
            $user->bookmarkedPosts()->attach($post->id);
        }

        return Redirect::back();
    }

    public function destroy(Request $request, Post $post)
    {
        $user = $request->user();

        $user->bookmarkedPosts()->detach($post->id);

        return Redirect::back();
    }
}
