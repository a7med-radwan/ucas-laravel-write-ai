<x-layout title="{{ $search ? 'Search: ' . $search : 'Search Posts' }}">
    <x-slot:style>
        <style>
            .material-symbols-outlined {
                font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
                vertical-align: middle;
            }
        </style>
    </x-slot:style>

    <div class="pt-6 md:pt-8 pb-16 px-gutter">
        <div class="max-w-container-max mx-auto">

            {{-- Search Header --}}
            <div class="mb-8 space-y-3">
                <p class="font-metadata text-metadata text-secondary uppercase tracking-widest">Search results</p>

                @if ($search)
                    <h1 class="text-2xl font-bold text-on-surface font-headline-md">
                        <span class="text-on-surface-variant font-normal text-xl">Showing </span>
                        <span class="text-primary">{{ $posts->total() }} {{ Str::plural('result', $posts->total()) }}</span>
                        <span class="text-on-surface-variant font-normal text-xl"> for </span>
                        <span class="italic">"{{ $search }}"</span>
                    </h1>
                @else
                    <h1 class="text-2xl font-bold text-on-surface">Find Articles</h1>
                @endif

                {{-- Search Form --}}
                <form action="{{ route('search') }}" method="GET" class="flex items-center gap-2 max-w-xl pt-1">
                    <div class="relative flex-1">
                        <input id="search-input" type="text" name="search" value="{{ $search }}"
                            placeholder=" Search by title or content..." autocomplete="off"
                            class="w-full bg-surface-container-lowest border border-outline-variant rounded-xl py-2.5 pl-11 pr-4 text-sm text-on-surface focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
                    </div>
                    <button type="submit"
                        class="shrink-0 bg-primary text-on-primary px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-primary/90 active:scale-95 transition-all flex items-center gap-1.5">
                        <span class="material-symbols-outlined" style="font-size:18px;">search</span>
                        <span>Search</span>
                    </button>
                </form>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-start">

                {{-- Results --}}
                <section class="lg:col-span-8 space-y-0">

                    @if ($search && $posts->isEmpty())
                        <div class="text-center py-16 border border-outline-variant rounded-xl bg-surface-container-lowest">
                            <span class="material-symbols-outlined block mb-3 text-on-surface-variant/40"
                                style="font-size:48px;">search_off</span>
                            <h2 class="text-lg font-bold text-on-surface mb-1">No results found</h2>
                            <p class="text-sm text-on-surface-variant">
                                No posts match <span class="font-semibold">"{{ $search }}"</span>. Try different keywords.
                            </p>
                        </div>

                    @elseif (!$search)
                        <div class="text-center py-16 border border-outline-variant rounded-xl bg-surface-container-lowest">
                            <span class="material-symbols-outlined block mb-3 text-on-surface-variant/40"
                                style="font-size:48px;">manage_search</span>
                            <h2 class="text-lg font-bold text-on-surface mb-1">Start searching</h2>
                            <p class="text-sm text-on-surface-variant">Type something above to find articles by title or
                                content.</p>
                        </div>

                    @else
                        <div class="divide-y divide-outline-variant">
                            @php
                                $featuredPost = $posts->currentPage() === 1 ? $posts->shift() : null;
                            @endphp

                            @if ($featuredPost)
                                <article
                                    class="group border border-outline-variant rounded-xl overflow-hidden bg-surface-container-lowest hover:border-primary/50 transition-colors mb-8">
                                    <div class="aspect-[16/9] overflow-hidden">
                                        <img alt="{{ $featuredPost->title }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                            src="{{ $featuredPost->cover_image ?? 'https://images.unsplash.com/photo-1499750310107-5fef28a66643?q=80&w=2070&auto=format&fit=crop' }}" />
                                    </div>
                                    <div class="p-6 sm:p-8 space-y-4">
                                        <div
                                            class="flex flex-wrap items-center gap-2 font-metadata text-metadata text-secondary">
                                            <span
                                                class="bg-primary-fixed text-on-primary-fixed px-2 py-0.5 rounded font-bold uppercase tracking-wider text-[11px]">Featured</span>
                                            <span>•</span>
                                            <span>{{ $featuredPost->publish_time->format('M d, Y') }}</span>
                                            <span>•</span>
                                            <span>{{ $featuredPost->category->name }}</span>
                                            <span>•</span>
                                            <span>{{ $featuredPost->views }} views</span>
                                        </div>
                                        <h2
                                            class="font-headline-md text-2xl sm:text-headline-md text-on-surface leading-tight group-hover:text-primary transition-colors">
                                            <a
                                                href="{{ route('posts.show', $featuredPost->slug) }}">{{ $featuredPost->title }}</a>
                                        </h2>
                                        <p class="text-on-surface-variant font-body-md text-body-md line-clamp-3">
                                            {{ $featuredPost->excerpt ?? Str::limit(strip_tags($featuredPost->content), 150) }}
                                        </p>
                                        <div class="flex items-center justify-between pt-4 border-t border-outline-variant">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-10 h-10 rounded-full bg-surface-container border border-outline-variant overflow-hidden shrink-0">
                                                    <img alt="Author" class="w-full h-full object-cover"
                                                        src="https://ui-avatars.com/api/?name={{ urlencode($featuredPost->user->name) }}&background=eaddff&color=630ed4" />
                                                </div>
                                                <div>
                                                    <p class="font-ui-label text-ui-label font-bold text-on-surface">
                                                        {{ $featuredPost->user->name }}</p>
                                                    <p class="font-metadata text-metadata text-secondary">Author</p>
                                                </div>
                                            </div>
                                            <button
                                                class="text-primary p-2 rounded-full hover:bg-primary-fixed/30 transition-colors"
                                                type="button">
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

                        </div>

                        @if ($posts->hasPages())
                            <div class="pt-6 border-t border-outline-variant flex justify-center">
                                {{ $posts->withQueryString()->links('pagination.custom-tailwind') }}
                            </div>
                        @endif
                    @endif
                </section>
            </div>
        </div>
    </div>
</x-layout>