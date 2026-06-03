<x-layout title="{{ $post->title }}">
    <x-slot:style>
        <style>
            .material-symbols-outlined {
                font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            }

            .article-column {
                max-width: 720px;
            }

            /* Custom Typography for Post Content (TinyMCE Output) */
            .post-content p {
                font-family: 'Source Serif 4', Georgia, serif;
                font-size: 1.25rem; /* 20px */
                line-height: 1.8;
                color: #1a1c1c;
                margin-bottom: 1.5rem;
            }

            .post-content h2 {
                font-family: 'Source Serif 4', Georgia, serif;
                font-size: 1.875rem; /* 30px */
                font-weight: 700;
                color: #1a1c1c;
                margin-top: 2.5rem;
                margin-bottom: 1rem;
                line-height: 1.3;
            }

            .post-content h3 {
                font-family: 'Inter', sans-serif;
                font-size: 1.5rem; /* 24px */
                font-weight: 600;
                color: #1a1c1c;
                margin-top: 2rem;
                margin-bottom: 0.75rem;
                line-height: 1.4;
            }

            .post-content ul {
                list-style-type: disc;
                padding-left: 1.5rem;
                margin-bottom: 1.5rem;
            }

            .post-content ul li {
                font-family: 'Source Serif 4', Georgia, serif;
                font-size: 1.125rem;
                line-height: 1.7;
                margin-bottom: 0.5rem;
                color: #1a1c1c;
            }

            .post-content ol {
                list-style-type: decimal;
                padding-left: 1.5rem;
                margin-bottom: 1.5rem;
            }

            .post-content ol li {
                font-family: 'Source Serif 4', Georgia, serif;
                font-size: 1.125rem;
                line-height: 1.7;
                margin-bottom: 0.5rem;
                color: #1a1c1c;
            }

            .post-content blockquote {
                border-left: 4px solid #630ed4; /* primary */
                padding-left: 1.5rem;
                font-style: italic;
                margin: 2rem 0;
                color: #4a4455;
            }

            .post-content blockquote p {
                font-size: 1.35rem;
                line-height: 1.6;
            }

            .post-content img {
                max-width: 100%;
                height: auto;
                border-radius: 0.75rem;
                margin: 2.5rem auto;
                display: block;
                border: 1px solid #ccc3d8;
            }

            .post-content strong {
                font-weight: 700;
                color: #000;
            }

            .post-content a {
                color: #630ed4;
                text-decoration: underline;
                font-weight: 500;
            }

            .post-content a:hover {
                color: #5a00c6;
            }
        </style>
    </x-slot:style>

    <main class="pt-24 pb-section-gap">
        <article class="mx-auto article-column px-margin-mobile md:px-0">
            <!-- Headline -->
            <header class="mb-8">
                <!-- Category Tag -->
                <div class="mb-4">
                    <span class="bg-primary-fixed text-on-primary-fixed px-3 py-1.5 rounded-full font-ui-label text-xs font-semibold tracking-wide uppercase">
                        {{ $post->category->name }}
                    </span>
                </div>
                
                <h1 class="font-display-lg text-display-lg mb-6 text-on-surface leading-tight">{{ $post->title }}</h1>
                
                <!-- Author Bio -->
                <div class="flex items-center justify-between py-5 border-y border-outline-variant">
                    <div class="flex items-center gap-4">
                        <img class="w-12 h-12 rounded-full border border-outline-variant object-cover"
                            alt="{{ $post->user->name }}"
                            src="https://ui-avatars.com/api/?name={{ urlencode($post->user->name) }}&background=eaddff&color=630ed4&bold=true" />
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="font-ui-label text-ui-label font-bold text-on-surface">{{ $post->user->name }}</span>
                                <span class="text-secondary-fixed-dim">•</span>
                                <button class="text-primary font-ui-label text-ui-label font-semibold hover:underline">Follow</button>
                            </div>
                            <p class="font-metadata text-metadata text-secondary">
                                {{ $post->created_at->format('M d, Y') }} · {{ max(3, ceil(str_word_count(strip_tags($post->content)) / 200)) }} min read
                            </p>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button class="material-symbols-outlined text-secondary hover:text-primary transition-colors p-2 rounded-full hover:bg-surface-container-high">share</button>
                        <button class="material-symbols-outlined text-secondary hover:text-primary transition-colors p-2 rounded-full hover:bg-surface-container-high">more_horiz</button>
                    </div>
                </div>
            </header>

            <!-- Cover Image Banner -->
            @if ($post->cover_image)
                <div class="mb-10 rounded-xl overflow-hidden aspect-[16/9] w-full border border-outline-variant/30 shadow-sm">
                    <img src="{{ $post->thumbnail_url }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                </div>
            @endif

            <!-- Content -->
            <div class="post-content">
                {!! $post->content !!}
            </div>
        </article>
    </main>

    <!-- Floating Engagement Bar -->
    <div class="fixed bottom-10 left-1/2 -translate-x-1/2 z-40">
        <div class="flex items-center gap-6 px-6 py-3 bg-white/90 backdrop-blur-md rounded-full border border-outline-variant/60 shadow-[0_20px_40px_rgba(0,0,0,0.08)]">
            <div class="flex items-center gap-2 group cursor-pointer">
                <span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary transition-colors">favorite</span>
                <span class="font-ui-label text-ui-label text-secondary group-hover:text-primary">1.2k</span>
            </div>
            <div class="w-px h-6 bg-outline-variant"></div>
            <div class="flex items-center gap-2 group cursor-pointer">
                <span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary transition-colors">chat_bubble</span>
                <span class="font-ui-label text-ui-label text-secondary group-hover:text-primary">84</span>
            </div>
            <div class="w-px h-6 bg-outline-variant"></div>
            <button class="material-symbols-outlined text-on-surface-variant hover:text-primary transition-colors">bookmark</button>
            <button class="material-symbols-outlined text-on-surface-variant hover:text-primary transition-colors">ios_share</button>
        </div>
    </div>
</x-layout>