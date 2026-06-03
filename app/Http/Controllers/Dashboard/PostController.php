<?php

namespace App\Http\Controllers\Dashboard;

use App\Actions\FileUpload;
use App\Actions\SyncPostTags;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Number;
use Illuminate\Support\Str;
use Throwable;

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

        $user = Auth::user();

        // select * from posts where user_id = ? and status = ? order by created_at desc
        // select * from categories where id in (....)
        $posts = $user->posts()
            //->leftJoin('categories', 'posts.category_id', '=', 'categories.id')
            ->with('category') // Eager loading
            ->select([
                'posts.id',
                'category_id',
                'title',
                'posts.slug',
                'views',
                'status',
                'posts.created_at',
                //'categories.name as category_name',
            ])
            // ->addSelect(
            //     DB::raw('(SELECT COUNT(*) FROM comments WHERE comments.post_id = posts.id) AS comments_count')
            // )
            ->withCount('comments')
            ->where('status', $status)
            ->orderBy('created_at', 'desc')
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
    public function store(PostRequest $request, FileUpload $fileUpload, SyncPostTags $syncPostTags)
    {
        //$fileUpload = app(FileUpload::class);
        $clean = $request->validated();

        $data = array_merge($clean, [
            'user_id' => $request->user()->id,
            'slug' => Str::slug($request->post('title')),
            'status' => 'published',
            'cover_image' => $fileUpload->handle(key: 'cover', path: 'covers'),
        ]);

        DB::beginTransaction();

        try {
            $post = Post::create($data);
            $syncPostTags->handle($post, $clean['tags'] ?? '');

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->withErrors([
                    'error' => 'Failed to create post: ' . $e->getMessage(),
                ]);
        }
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
    public function update(PostRequest $request, FileUpload $fileUpload, SyncPostTags $syncPostTags, string $id)
    {
        $post = Post::findOrFail($id);

        $clean = $request->validated();
        $data = \array_merge($clean, [
            'cover_image' => $fileUpload->handle(key: 'cover', path: 'covers')
        ]);

        $previousCover = $post->cover_image;

        try {
            DB::transaction(function () use ($post, $data, $syncPostTags, $clean) {
                $post->update($data);

                $syncPostTags->handle($post, $clean['tags'] ?? '');
            });
        } catch (Throwable $e) {
            return back()
                ->withInput()
                ->withErrors([
                    'error' => 'Failed to update post: ' . $e->getMessage(),
                ]);
        }

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