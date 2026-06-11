@props(['post'])

<article class="flex flex-col md:flex-row gap-8 group">
    <div class="w-full md:w-1/3 aspect-video md:aspect-square overflow-hidden rounded-lg border border-outline-variant">
        <img alt="{{ $post->title }}"
            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
            src="{{ $post->cover_image ?? 'https://images.unsplash.com/photo-1501504905252-473c47e087f8?q=80&w=1974&auto=format&fit=crop' }}" />
    </div>
    <div class="w-full md:w-2/3 space-y-3">
        <div class="flex items-center gap-2 font-metadata text-metadata text-secondary">
            <span class="text-primary font-bold">{{ $post->category->name }}</span>
            <span>•</span>
            <span>{{ $post->publishTime->format('M d, Y') }}</span>
        </div>
        <h3 class="font-headline-md text-[24px] leading-snug text-on-surface group-hover:text-primary transition-colors">
            <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
        </h3>
        <p class="text-on-surface-variant font-body-md text-body-md line-clamp-2">{{ $post->excerpt ?? Str::limit(strip_tags($post->content), 100) }}</p>
        <div class="flex items-center gap-3 pt-2">
            <p class="font-ui-label text-ui-label text-on-surface font-medium">{{ $post->user?->name ?? 'Unknown Author' }}</p>
            <span class="text-secondary text-metadata">•</span>
            <span class="text-secondary font-metadata text-metadata">{{ $post->views ?? 0 }} views</span>
        </div>
    </div>
</article>