<?php

namespace App\Jobs;

use App\Actions\SyncPostTags;
use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncTagsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Post $post,
        public string|array $tags
    ) {}

    /**
     * Execute the job.
     */
    public function handle(SyncPostTags $syncPostTags): void
    {
        $syncPostTags->handle($this->post, $this->tags);
    }
}
