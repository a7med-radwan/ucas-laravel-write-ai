<?php

namespace App\Jobs;

use App\Ai\Agents\SeoAgent;
use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Laravel\Ai\Enums\Lab;
use Laravel\Ai\Image;
use Throwable;

class GeneratePostAiMetadata implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Post $post)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // 1. Generate SEO metadata using SeoAgent
        try {
            $content = strip_tags($this->post->content);
            $prompt = "Generate SEO metadata and summary (maximum words: 100) for this blog post.
                - Post title: {$this->post->title}
                - Post Content: {$content}";

            $seoAgent = new SeoAgent;
            $response = $seoAgent->prompt(
                prompt: $prompt,
                provider: [Lab::Groq, Lab::Gemini],
            );

            $this->post->meta = [
                'title' => $response['title'] ?? '',
                'description' => $response['description'] ?? '',
                'keywords' => is_array($response['keywords'] ?? null)
                    ? implode(', ', $response['keywords'])
                    : ($response['keywords'] ?? ''),
                'summary' => $response['summary'] ?? '',
            ];
        } catch (Throwable $e) {
            report($e);
        }

        // 2. Generate cover image if not exists
        if (!$this->post->cover_image) {
            try {
                $prompt = "Create a cover image for an article/post has title: \"{$this->post->title}\". The aspect ratio of the generated image should be 16:9. Minimum image width is 1024px.";
                $image = Image::of($prompt)
                    ->generate(
                        provider: Lab::Gemini,
                        model: 'gemini-2.5-flash-image',
                    );

                // Store image on public disk
                $this->post->cover_image = $image->store('covers', 'public');
            } catch (Throwable $e) {
                report($e);
            }
        }

        $this->post->save();
    }
}
