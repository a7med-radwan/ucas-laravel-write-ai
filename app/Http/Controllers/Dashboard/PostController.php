<?php

namespace App\Http\Controllers\Dashboard;

use App\Actions\FileUpload;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use id;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Number;
use Illuminate\Support\Str;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->query('status', 'published');

        $status_options = array_map(function ($value) {
            return [
                'name' => ucfirst($value),
                'count' => Post::query()->where('status', $value)->count(),
            ];
        }, [
            'published',
            'draft',
            'archived',
        ]);

        $posts = Post::query()
            ->where('status', '=', $status)
            ->where('user_id', '=', Auth::id() ?? 1)
            ->latest()
            ->get();

        return view('dashboard.posts.index', [
            'posts' => $posts,
            'status' => $status,
            'status_options' => $status_options,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.posts.create', [
            'post' => new Post(),
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request, FileUpload $fileUpload)
    {
        //$fileUpload = app(FileUpload::class);
        $clean = $request->validated();

        $data = array_merge($clean, [
            'user_id' => $request->user()?->id ?? Auth::id() ?? 1,
            'slug' => Str::slug($request->post('title')),
            'status' => 'published',
            'cover_image' => $fileUpload->handle(key: 'cover', path: 'covers'),
        ]);

        $post = Post::create($data);

        // PRG: POST Redirect GET
        return redirect()
            ->route('dashboard.posts.index')
            ->with('status', 'Post created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $post = Post::findOrFail($id);

        return view('dashboard.posts.show', [
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $post = Post::findOrFail($id);

        return view('dashboard.posts.edit', [
            'post' => $post,
            'categories' => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, FileUpload $fileUpload, string $id)
    {
        $post = Post::findOrFail($id);

        $clean = $request->validated();
        $data = \array_merge($clean, [
            'cover_image' => $fileUpload->handle(key: 'cover', path: 'covers')
        ]);

        $previousCover = $post->cover_image;

        $post->update($data);

        $prev_cover_image = $previousCover;
        if ($prev_cover_image && $prev_cover_image !== $post->cover_image) {
            Storage::disk('public')->delete($prev_cover_image); // Delete the old cover image from storage
        }

        // PRG: POST Redirect GET
        return redirect()->route('dashboard.posts.index')
            ->with('status', 'Post updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //Post::destroy($id);
        $post = Post::findOrFail($id);
        $post->delete();

        if ($post->cover_image) {
            Storage::disk('public')->delete($post->cover_image); // Delete the cover image from storage
        }

        // PRG: POST Redirect GET
        return redirect()->route('dashboard.posts.index')
            ->with('status', 'Post deleted!');
    }
}