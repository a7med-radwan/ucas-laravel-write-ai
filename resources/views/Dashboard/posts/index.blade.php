<x-layout title="Content Management">
    <div class="pt-8 pb-section-gap px-gutter max-w-container-max mx-auto">
        <header class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
            <div class="max-w-2xl">
                <h1 class="font-display-lg text-display-lg-mobile sm:text-display-lg text-on-surface mb-1.5">Content Management</h1>
                <p class="font-body-md text-on-surface-variant">Manage your posts, track engagement, and control publication status.</p>
            </div>
            <a href="{{ route('dashboard.posts.create') }}"
                class="inline-flex items-center gap-2 bg-primary text-on-primary px-5 py-2.5 rounded-lg font-ui-button text-ui-button shadow-sm hover:opacity-90 transition-all shrink-0">
                <span class="material-symbols-outlined text-[20px]">add</span>
                New Post
            </a>
        </header>

        @if (session()->has('status'))
            <div class="mb-6 p-4 bg-green-50 text-green-800 rounded-xl border border-green-200 flex items-center gap-3">
                <span class="material-symbols-outlined text-green-600">check_circle</span>
                <span class="font-ui-label text-ui-label">{{ session('status') }}</span>
            </div>
        @endif

        <div class="flex gap-1 border-b border-outline-variant mb-6 overflow-x-auto">
            @foreach ($status_options as $option)
                @php $isActive = $status === strtolower($option['name']); @endphp
                <a href="{{ route('dashboard.posts.index', ['status' => strtolower($option['name'])]) }}"
                    class="px-4 py-3 text-ui-label font-ui-label whitespace-nowrap border-b-2 -mb-px transition-colors {{ $isActive ? 'border-primary text-primary font-bold' : 'border-transparent text-on-surface-variant hover:text-on-surface' }}">
                    {{ $option['name'] }}
                    <span class="text-metadata {{ $isActive ? 'text-primary' : 'text-outline' }}">({{ $option['count'] }})</span>
                </a>
            @endforeach
        </div>

        <div class="space-y-3">
            @foreach ($posts as $post)
                @php
                    $statusBadge = match ($post->status->getColor()) {
                        'green' => ['bg-green-50 text-green-700 border-green-200', 'bg-green-500'],
                        'blue' => ['bg-blue-50 text-blue-700 border-blue-200', 'bg-blue-500'],
                        'red' => ['bg-red-50 text-red-700 border-red-200', 'bg-red-500'],
                        default => ['bg-gray-50 text-gray-600 border-gray-200', 'bg-gray-400'],
                    };
                @endphp
                <article class="bg-surface-container-lowest p-4 sm:p-5 rounded-xl border border-outline-variant hover:border-primary/30 transition-colors">
                    <div class="flex flex-col lg:flex-row lg:items-center gap-4">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 mb-1 text-metadata font-metadata">
                                <span class="text-primary">{{ $post->category->name }}</span>
                                <span class="text-outline">•</span>
                                <span class="text-on-surface-variant">{{ $post->read_time }} min read</span>
                            </div>
                            <h3 class="font-headline-md text-lg text-on-surface leading-snug mb-1">{{ $post->title }}</h3>
                            <p class="text-metadata font-metadata text-on-surface-variant">
                                {{ $post->publishTime->format('M j, Y H:i') }}
                            </p>
                        </div>

                        <div class="flex flex-wrap items-center gap-4 lg:gap-6 shrink-0">
                            <div class="flex items-center gap-4 text-ui-label font-ui-label text-on-surface-variant">
                                <span class="inline-flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[18px]">visibility</span>
                                    {{ $post->views }}
                                </span>
                                <span class="inline-flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[18px]">chat_bubble</span>
                                    {{ $post->comments_count }}
                                </span>
                            </div>

                            @if ($post->trashed())
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold border bg-red-50 text-red-700 border-red-200">
                                    <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>
                                    Deleted
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold border {{ $statusBadge[0] }}">
                                    <span class="h-1.5 w-1.5 rounded-full {{ $statusBadge[1] }}"></span>
                                    {{ $post->status->getLabel() }}
                                </span>
                            @endif

                            <div class="flex gap-1">
                                @if ($post->trashed())
                                    <button
                                        onclick="confirm('Are you sure you want to restore this post?') ? document.getElementById('restorepost{{ $post->id }}').submit() : null;"
                                        class="p-2 text-on-surface-variant hover:bg-surface-container hover:text-primary rounded-lg transition-all"
                                        title="Restore">
                                        <span class="material-symbols-outlined text-[20px]">refresh</span>
                                    </button>
                                    <form class="hidden" id="restorepost{{ $post->id }}" action="{{ route('dashboard.posts.restore', $post->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                    </form>
                                @else
                                    <a href="{{ route('dashboard.posts.edit', $post->id) }}"
                                        class="p-2 text-on-surface-variant hover:bg-surface-container hover:text-primary rounded-lg transition-all"
                                        title="Edit">
                                        <span class="material-symbols-outlined text-[20px]">edit</span>
                                    </a>
                                @endif
                                <button
                                    onclick="confirm('Are you sure you want to delete this post?') ? document.getElementById('deletepost{{ $post->id }}').submit() : null;"
                                    class="p-2 text-on-surface-variant hover:bg-error-container hover:text-error rounded-lg transition-all"
                                    title="Delete">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                                <form class="hidden" id="deletepost{{ $post->id }}"
                                    action="{{ route('dashboard.posts.' . ($post->trashed() ? 'force-delete' : 'destroy'), $post->id) }}"
                                    method="post">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $posts->withQueryString()->links('pagination.custom-tailwind') }}
        </div>
    </div>
</x-layout>
