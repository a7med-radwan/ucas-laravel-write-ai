<x-layout title="Home" main-class="pt-24 pb-section-gap max-w-container-max mx-auto px-gutter grid grid-cols-1 md:grid-cols-12
gap-8">

    <x-slot:style>
        <style>
            .material-symbols-outlined {
                font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
                vertical-align: middle;
            }

            body {
                background-color: #f9f9f9;
                color: #1a1c1c;
            }
        </style>
    </x-slot:style>

    <!-- Left Sidebar: Navigation & Tags -->
    <aside class="hidden md:block md:col-span-2 space-y-8">
        <div class="space-y-4">
            <h3 class="font-ui-label text-ui-label uppercase tracking-widest text-secondary font-bold">Discover</h3>
            <ul class="space-y-2">
                <li><a class="flex items-center gap-3 text-primary font-bold font-ui-label text-ui-label py-1"
                        href="#"><span class="material-symbols-outlined" data-weight="fill"
                            style="font-variation-settings: 'FILL' 1;">explore</span>Explore</a></li>
                <li><a class="flex items-center gap-3 text-on-surface-variant hover:text-primary transition-colors font-ui-label text-ui-label py-1"
                        href="#"><span class="material-symbols-outlined">trending_up</span>Popular</a></li>
                <li><a class="flex items-center gap-3 text-on-surface-variant hover:text-primary transition-colors font-ui-label text-ui-label py-1"
                        href="#"><span class="material-symbols-outlined">history</span>Recent</a></li>
            </ul>
        </div>
        <div class="space-y-4">
            <h3 class="font-ui-label text-ui-label uppercase tracking-widest text-secondary font-bold">Your Tags
            </h3>
            <div class="flex flex-wrap gap-2">
                @foreach ($categories as $category)
                    <a class="px-3 py-1 bg-surface-container border border-outline-variant rounded-full font-metadata text-metadata hover:bg-outline-variant transition-colors"
                        href="#">#{{ $category->name ?? 'Unknown' }}</a>
                @endforeach
            </div>
        </div>
    </aside>
    <!-- Center Feed -->
    <section class="col-span-1 md:col-span-7 space-y-12">
        <!-- Featured Article (Bento Style) -->
        @if ($featuredPost)
        <article
            class="group border border-outline-variant rounded-xl overflow-hidden bg-white hover:border-primary transition-colors duration-300">
            <div class="aspect-[16/9] overflow-hidden">
                <img alt="{{ $featuredPost->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                    src="{{ $featuredPost->cover_image ?? 'https://images.unsplash.com/photo-1499750310107-5fef28a66643?q=80&w=2070&auto=format&fit=crop' }}" />
            </div>
            <div class="p-8 space-y-4">
                <div class="flex items-center gap-3 font-metadata text-metadata text-secondary">
                    <span
                        class="bg-primary-container text-on-primary px-2 py-0.5 rounded font-bold uppercase tracking-wider">Featured</span>
                    <span>•</span>
                    <span>{{ $featuredPost->created_at->format('M d, Y') }}</span>
                    <span>•</span>
                    <span>{{ \App\Models\Category::find($featuredPost->category_id)?->name ?? 'Uncategorized' }}</span>
                </div>
                <h2
                    class="font-headline-md text-headline-md text-on-surface leading-tight group-hover:text-primary transition-colors">
                    <a href="{{ route('dashboard.posts.show', $featuredPost->id) }}">{{ $featuredPost->title }}</a></h2>
                <p class="text-on-surface-variant font-body-md text-body-md line-clamp-3">{{ $featuredPost->excerpt ?? Str::limit(strip_tags($featuredPost->content), 150) }}</p>
                <div class="flex items-center justify-between pt-4 border-t border-outline-variant">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-full bg-surface-container border border-outline-variant overflow-hidden">
                            <img alt="Author" class="w-full h-full object-cover"
                                src="https://ui-avatars.com/api/?name={{ urlencode(\App\Models\User::find($featuredPost->user_id)?->name ?? 'Unknown') }}&background=random" />
                        </div>
                        <div>
                            <p class="font-ui-label text-ui-label font-bold text-on-surface">{{ \App\Models\User::find($featuredPost->user_id)?->name ?? 'Unknown Author' }}</p>
                            <p class="font-metadata text-metadata text-secondary">Author</p>
                        </div>
                    </div>
                    <button class="text-primary p-2 rounded-full hover:bg-primary-container/10 transition-colors">
                        <span class="material-symbols-outlined" data-icon="bookmark_add">bookmark_add</span>
                    </button>
                </div>
            </div>
        </article>
        @endif
        <!-- Grid of Regular Articles -->
        <div class="grid grid-cols-1 gap-12">
            @foreach ($posts as $post)
            <article class="flex flex-col md:flex-row gap-8 group">
                <div
                    class="w-full md:w-1/3 aspect-video md:aspect-square overflow-hidden rounded-lg border border-outline-variant">
                    <img alt="{{ $post->title }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                        src="{{ $post->cover_image ?? 'https://images.unsplash.com/photo-1501504905252-473c47e087f8?q=80&w=1974&auto=format&fit=crop' }}" />
                </div>
                <div class="w-full md:w-2/3 space-y-3">
                    <div class="flex items-center gap-2 font-metadata text-metadata text-secondary">
                        <span class="text-primary font-bold">{{ \App\Models\Category::find($post->category_id)?->name ?? 'Uncategorized' }}</span>
                        <span>•</span>
                        <span>{{ $post->created_at->format('M d, Y') }}</span>
                    </div>
                    <h3
                        class="font-headline-md text-[24px] leading-snug text-on-surface group-hover:text-primary transition-colors">
                        <a href="{{ route('dashboard.posts.show', $post->id) }}">{{ $post->title }}</a>
                    </h3>
                    <p class="text-on-surface-variant font-body-md text-body-md line-clamp-2">{{ $post->excerpt ?? Str::limit(strip_tags($post->content), 100) }}</p>
                    <div class="flex items-center gap-3 pt-2">
                        <p class="font-ui-label text-ui-label text-on-surface font-medium">{{ \App\Models\User::find($post->user_id)?->name ?? 'Unknown Author' }}</p>
                        <span class="text-secondary text-metadata">•</span>
                        <span class="text-secondary font-metadata text-metadata">{{ $post->views ?? 0 }} views</span>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
        @if($posts->hasPages())
        <div class="pt-8 flex justify-center">
            {{ $posts->links() }}
        </div>
        @endif
    </section>
    <!-- Right Sidebar: Trending & Who to Follow -->
    <aside class="hidden lg:block lg:col-span-3 space-y-12">
        @include('asides.trending')

        <x-recommended-authors title="Top Authors" count="2" />

        <x-widgets.newsletter>
            <p>Enter Your email</p>
            <x-slot:helper>
                <p class="font-metadata text-metadata text-on-primary-container">We care about your privacy. Unsubscribe
                    anytime.</p>
            </x-slot:helper>
        </x-widgets.newsletter>
    </aside>

    @section('nav')
        @parent
        <a class="text-on-surface-variant font-medium font-ui-label text-ui-label hover:text-primary transition-colors duration-200"
            href="#">FAQ</a>
    @endsection

</x-layout>
