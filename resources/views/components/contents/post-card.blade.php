@props(['post'])

<article class="flex flex-col sm:flex-row gap-6 group pb-10 border-b border-outline-variant last:border-0 last:pb-0">
    <div class="w-full sm:w-[220px] lg:w-[260px] shrink-0 aspect-video sm:aspect-square overflow-hidden rounded-xl border border-outline-variant">
        <img alt="{{ $post->title }}"
            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
            src="{{ $post->cover_image ?? 'https://images.unsplash.com/photo-1501504905252-473c47e087f8?q=80&w=1974&auto=format&fit=crop' }}" />
    </div>
    <div class="flex-1 min-w-0 space-y-2">
        <div class="flex items-center gap-2 font-metadata text-metadata text-secondary">
            <span class="text-primary font-bold">{{ $post->category->name }}</span>
            <span>•</span>
            <span>{{ $post->publishTime->format('M d, Y') }}</span>
        </div>
        <h3 class="font-headline-md text-[24px] leading-snug text-on-surface group-hover:text-primary transition-colors">
            <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
        </h3>
        <p class="text-on-surface-variant font-body-md text-body-md line-clamp-2">{{ $post->excerpt ?? Str::limit(strip_tags($post->content), 100) }}</p>
        <div class="flex items-center justify-between pt-2">
            <div class="flex items-center gap-3">
                <p class="font-ui-label text-ui-label text-on-surface font-medium">{{ $post->user?->name ?? 'Unknown Author' }}</p>
                <span class="text-secondary text-metadata">•</span>
                <span class="text-secondary font-metadata text-metadata">{{ $post->views ?? 0 }} views</span>
            </div>
            <x-contents.bookmark-button :post="$post" />
        </div>
    </div>
</article>