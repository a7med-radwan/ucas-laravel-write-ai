<?php

namespace App\Services;

use App\Actions\FileUpload;
use App\Actions\SyncPostTags;
use App\Ai\Agents\SeoAgent;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Laravel\Ai\Enums\Lab;
use Throwable;

class PostService
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected FileUpload $fileUpload, protected SyncPostTags $syncTags)
    {
        //
    }

    public function create(PostRequest $request): Post
    {
        $clean = $request->validated();

        $data = array_merge($clean, [
            'status' => 'published',
            'cover_image' => $this->fileUpload->handle(key: 'cover', path: 'covers'),
        ]);

        DB::beginTransaction();

        try {
            $post = Post::create($data);
            $this->syncTags->handle($post, $clean['tags'] ?? '');

            //if (empty($post->meta)) {
            $content = strip_tags($post->content);
            $prompt = "Generate SEO metadata and summary (maximum words: 100) for this blog post.
                - Post title: {$post->title}
                - Post Content: {$content}";
            $seoAgent = new SeoAgent;
            $response = $seoAgent->prompt(
                prompt: $prompt,
                provider: Lab::Groq,
                model: 'openai/gpt-oss-20b',
            );

            $post->meta = [
                'title' => $response['title'] ?? '',
                'description' => $response['description'] ?? '',
                'keywords' => implode(', ', $response['keywords'] ?? []),
                'summary' => $response['summary'] ?? '',
            ];
            $post->save();

            if (!$post->cover_image) {
                // \Laravel\Ai\Image::of('')
                //     ->generate(
                //         provider: '',
                //         model: ''
                //     );
            }

            $this->syncTags->handle($post, $response['keywords']);
            //}

            DB::commit();

            return $post;
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update(Post $post, PostRequest $request): Post
    {
        $clean = $request->validated();
        $data = \array_merge($clean, [
            'cover_image' => $this->fileUpload->handle(key: 'cover', path: 'covers')
        ]);

        try {
            DB::transaction(function () use ($post, $data, $clean) {
                $post->update($data);

                $this->syncTags->handle($post, $clean['tags'] ?? '');
            });

            $previous = $post->getPrevious();
            $prev_cover_image = $previous['cover_image'] ?? null;
            if ($prev_cover_image && $prev_cover_image !== $post->cover_image) {
                Storage::disk('public')->delete($previous['cover_image']); // Delete the old cover image from storage
            }

            return $post;
        } catch (Throwable $e) {
            throw $e;
        }
    }
}