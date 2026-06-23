<x-layout title="Home">
    <x-slot:style>
        <style>
            .material-symbols-outlined {
                font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
                vertical-align: middle;
            }
        </style>
    </x-slot:style>

    <div class="pt-6 md:pt-8 pb-12 px-gutter">
        <div class="max-w-container-max mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-start">

                <!-- Feed -->
                <section class="lg:col-span-8 space-y-8">
                    @if ($tags->isNotEmpty())
                        <div class="space-y-2">
                            <h2 class="font-ui-label text-ui-label uppercase tracking-widest text-secondary font-bold">Tags</h2>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($tags as $tag)
                                    @php
                                        $isActive = request('tag') === $tag->name || request('tag') === $tag->slug;
                                    @endphp
                                    <a class="px-3 py-1 border rounded-full font-metadata text-metadata transition-colors {{ $isActive ? 'bg-primary text-on-primary border-primary' : 'bg-surface-container-lowest border-outline-variant hover:border-primary/40 hover:text-primary' }}"
                                        href="{{ $isActive ? route('home') : route('home', ['tag' => $tag->name]) }}">
                                        #{{ $tag->name ?? 'Unknown' }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @php
                        $featuredPost = $posts->currentPage() === 1 ? $posts->shift() : null;
                    @endphp

                    @if ($featuredPost)
                        <article class="group border border-outline-variant rounded-xl overflow-hidden bg-surface-container-lowest hover:border-primary/50 transition-colors">
                            <div class="aspect-[16/9] overflow-hidden">
                                <img alt="{{ $featuredPost->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                    src="{{ $featuredPost->cover_image ?? 'https://images.unsplash.com/photo-1499750310107-5fef28a66643?q=80&w=2070&auto=format&fit=crop' }}" />
                            </div>
                            <div class="p-6 sm:p-8 space-y-4">
                                <div class="flex flex-wrap items-center gap-2 font-metadata text-metadata text-secondary">
                                    <span class="bg-primary-fixed text-on-primary-fixed px-2 py-0.5 rounded font-bold uppercase tracking-wider text-[11px]">Featured</span>
                                    <span>•</span>
                                    <span>{{ $featuredPost->publish_time->format('M d, Y') }}</span>
                                    <span>•</span>
                                    <span>{{ $featuredPost->category->name }}</span>
                                    <span>•</span>
                                    <span>{{ $featuredPost->views }} views</span>
                                </div>
                                <h2 class="font-headline-md text-2xl sm:text-headline-md text-on-surface leading-tight group-hover:text-primary transition-colors">
                                    <a href="{{ route('posts.show', $featuredPost->slug) }}">{{ $featuredPost->title }}</a>
                                </h2>
                                <p class="text-on-surface-variant font-body-md text-body-md line-clamp-3">
                                    {{ $featuredPost->excerpt ?? Str::limit(strip_tags($featuredPost->content), 150) }}
                                </p>
                                <div class="flex items-center justify-between pt-4 border-t border-outline-variant">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-surface-container border border-outline-variant overflow-hidden shrink-0">
                                            <img alt="Author" class="w-full h-full object-cover"
                                                src="https://ui-avatars.com/api/?name={{ urlencode($featuredPost->user->name) }}&background=eaddff&color=630ed4" />
                                        </div>
                                        <div>
                                            <p class="font-ui-label text-ui-label font-bold text-on-surface">{{ $featuredPost->user->name }}</p>
                                            <p class="font-metadata text-metadata text-secondary">Author</p>
                                        </div>
                                    </div>
                                    <button class="text-primary p-2 rounded-full hover:bg-primary-fixed/30 transition-colors" type="button">
                                        <span class="material-symbols-outlined">bookmark_add</span>
                                    </button>
                                </div>
                            </div>
                        </article>
                    @endif

                    <div class="space-y-8">
                        @foreach ($posts as $post)
                            <x-contents.post-card :post="$post" />
                        @endforeach
                    </div>

                    <div class="pt-4 border-t border-outline-variant flex justify-center">
                        {{ $posts->withQueryString()->links('pagination.custom-tailwind') }}
                    </div>
                </section>

                <!-- Right sidebar -->
                <aside class="lg:col-span-4 space-y-6">
                    @include('asides.trending')
                    <x-recommended-authors title="Top Authors" count="2" />
                    <x-widgets.newsletter>
                        <p>Enter your email</p>
                        <x-slot:helper>
                            <p class="font-metadata text-metadata text-on-primary-container">We care about your privacy. Unsubscribe anytime.</p>
                        </x-slot:helper>
                    </x-widgets.newsletter>
                </aside>
            </div>
        </div>
    </div>
</x-layout>
