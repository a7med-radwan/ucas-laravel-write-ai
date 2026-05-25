<!-- Trending Section -->
<div class="bg-white border border-outline-variant rounded-xl p-6 space-y-6">
    <h3 class="font-headline-md text-[20px] text-on-surface">Trending on Ink</h3>
    <div class="space-y-6">
        @forelse ($trendingPosts ?? [] as $index => $post)
            <div class="flex gap-4">
                <span class="font-display-lg text-secondary opacity-30 leading-none">{{ sprintf('%02d', $index + 1) }}</span>
                <div class="space-y-1">
                    <h4 class="font-ui-label text-ui-label font-bold text-on-surface leading-tight hover:text-primary cursor-pointer">
                        <a href="{{ route('dashboard.posts.show', $post->id) }}">{{ $post->title }}</a>
                    </h4>
                    <p class="font-metadata text-metadata text-secondary">{{ \App\Models\Category::find($post->category_id)?->name ?? 'Uncategorized' }} • {{ $post->views ?? 0 }} views</p>
                </div>
            </div>
        @empty
            <p class="text-on-surface-variant text-sm">No trending posts yet.</p>
        @endforelse
    </div>
</div>
