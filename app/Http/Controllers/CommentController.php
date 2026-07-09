<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Events\CommentCreated;
use App\Models\Post;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        abort_unless($post->status === \App\Enums\PostStatus::Published, 403, 'You cannot comment on this post.');

        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment = $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $validated['content'],
            'user_name' => auth()->check() ? auth()->user()->name : 'Guest',
        ]);

        broadcast(new CommentCreated($comment))->toOthers();

        // if ($request->wantsJson()) {
        //     return response()->json([
        //         'success' => true,
        //         'comment' => [
        //             'id' => $comment->id,
        //             'content' => $comment->content,
        //             'user_name' => $comment->user_name,
        //             'created_at' => $comment->created_at->diffForHumans(),
        //             'user' => $comment->user ? [
        //                 'name' => $comment->user->name,
        //                 'avatar_url' => $comment->user->avatarUrl,
        //             ] : null,
        //         ],
        //     ]);
        // }

        return back();
    }
}
