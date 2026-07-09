<?php

namespace App\Services;

use App\Actions\FileUpload;
use App\Actions\SyncPostTags;
use App\Ai\Agents\SeoAgent;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Laravel\Ai\Embeddings;
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

    public function create(array|PostRequest $request): Post
    {
        $clean = $request instanceof PostRequest ? $request->validated() : $request;

        $data = array_merge($clean, [
            'status' => 'published',
            'cover_image' => $this->fileUpload->handle(key: 'cover', path: 'covers'),
        ]);

        DB::beginTransaction();

        try {
            $post = Post::create($data);
            $this->syncTags->handle($post, $clean['tags'] ?? '');

            //if (empty($post->meta)) {
            /*$content = strip_tags($post->content);
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
            ];*/
            //$this->syncTags->handle($post, $response['keywords']);

            // TODO: Move to a separate job
            // if (!$post->cover_image) {
            //     set_time_limit(0);
            //     $prompt = <<<EOT
            //         Create a cover image for an article/post has title: "{$post->title}".
            //         The aspect ratio of the generated image should be 16:9.
            //         Minimum image width is 1024px.
            //         EOT;
            //     $image = \Laravel\Ai\Image::of($prompt)
            //         ->generate(
            //             provider: Lab::Gemini,
            //             model: 'gemini-2.5-flash-image',
            //         );

            //     $post->cover_image = $image->store('covers', 'public');
            // }

            try {
                $response = Embeddings::for([$post->content])
                    ->generate(
                        provider: Lab::Gemini
                    );
                //dd($response->embeddings[0]);
                //$post->embedding = $response->embeddings[0];
            } catch (Throwable $e) {
                report($e);
            }

            $post->save();


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