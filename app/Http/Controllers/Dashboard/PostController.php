<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
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
            ->where('user_id', '=', 1) // TODO: get from auth()->id()
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
    public function store(Request $request)
    {
        $request->merge([
            'user_id' => 1, // TODO: get from auth()->id()
            'slug' => Str::slug($request->post('title')),
            'status' => 'published',
        ]);

        $post = Post::create($request->all());

        // PRG: POST Redirect GET
        return redirect()->route('dashboard.posts.index');
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
    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->except([
            '_method',
            '_token',
        ]));

        // PRG: POST Redirect GET
        return redirect()->route('dashboard.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Post::destroy($id);

        // PRG: POST Redirect GET
        return redirect()->route('dashboard.posts.index');
    }
}
