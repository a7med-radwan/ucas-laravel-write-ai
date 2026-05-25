<x-layout title="{{ $post->title }}">
    <x-slot:style>
        <style>
            .material-symbols-outlined {
                font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            }
            .article-column {
                max-width: 720px;
            }
        </style>
    </x-slot:style>

    <main class="flex-grow pt-24 pb-section-gap">
        <article class="mx-auto article-column px-margin-mobile md:px-0">
            <!-- Headline -->
            <header class="mb-12">
                <h1 class="font-display-lg text-display-lg mb-8 text-on-surface">{{ $post->title }}</h1>
                <!-- Author Bio -->
                <div class="flex items-center justify-between py-6 border-y border-outline-variant">
                    <div class="flex items-center gap-4">
                        <img class="w-12 h-12 rounded-full grayscale"
                            src="https://ui-avatars.com/api/?name={{ urlencode(\App\Models\User::find($post->user_id)?->name ?? 'Unknown') }}&background=random" />
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="font-ui-label text-ui-label font-bold text-on-surface">{{ \App\Models\User::find($post->user_id)?->name ?? 'Unknown Author' }}</span>
                                <span class="text-secondary-fixed-dim">•</span>
                                <span class="text-primary font-ui-label text-ui-label font-semibold">{{ \App\Models\Category::find($post->category_id)?->name ?? 'Uncategorized' }}</span>
                            </div>
                            <p class="font-metadata text-metadata text-secondary">{{ $post->created_at->format('M j, Y') }} · {{ max(1, ceil(str_word_count(strip_tags($post->content)) / 200)) }} min read</p>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button class="material-symbols-outlined text-secondary hover:text-primary transition-colors">share</button>
                        <button class="material-symbols-outlined text-secondary hover:text-primary transition-colors">more_horiz</button>
                    </div>
                </div>
            </header>
            
            @if($post->cover_image)
            <div class="my-12">
                <img class="w-full rounded-lg border border-outline-variant" src="{{ $post->cover_image }}" />
            </div>
            @endif

            <!-- Content -->
            <div class="space-y-8 font-body-lg text-body-lg text-on-surface leading-relaxed">
                {!! nl2br(e($post->content)) !!}
            </div>
        </article>
    </main>
</x-layout>
