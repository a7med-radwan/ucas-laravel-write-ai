<x-layout>

    <main class="flex-grow pt-24 w-full max-w-container-max mx-auto px-gutter py-12">
        <!-- Header Section -->
        @if (session()->has('status'))
        <div class="p-2 bg-green-300 text-green-800">
            {{ session()->get('status') }}
        </div>
        @endif
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
            <div>
                <h1 class="font-display-lg text-display-lg text-on-background mb-2">Content Management</h1>
                <p class="text-on-surface-variant max-w-lg font-ui-label text-ui-label">Manage your intellectual
                    output, track performance, and schedule your upcoming editorial pieces.</p>
            </div>
            <button
                class="bg-primary-container text-on-primary px-6 py-3 rounded-lg font-ui-button text-ui-button flex items-center gap-2 hover:opacity-90 active:scale-95 transition-all shadow-sm">
                <span class="material-symbols-outlined text-[20px]" data-icon="edit_square">edit_square</span>
                Create Post
            </button>
        </div>
        <!-- Dashboard Layout Grid -->
        <div class="grid grid-cols-12 gap-8">
            <!-- Sidebar / Stats (Bento Style) -->
            <aside class="col-span-12 lg:col-span-3 space-y-6">
                <div class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant">
                    <span class="text-metadata font-metadata uppercase tracking-wider text-outline block mb-4">Total
                        Reach</span>
                    <div class="flex items-baseline gap-2">
                        <span class="text-headline-md font-headline-md">124.8k</span>
                        <span class="text-primary text-metadata font-bold">+12%</span>
                    </div>
                    <div class="mt-4 h-1 bg-surface-container rounded-full overflow-hidden">
                        <div class="h-full bg-primary w-3/4"></div>
                    </div>
                </div>
                <div class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant">
                    <span class="text-metadata font-metadata uppercase tracking-wider text-outline block mb-4">Active
                        Readers</span>
                    <div class="flex items-baseline gap-2">
                        <span class="text-headline-md font-headline-md">3,402</span>
                        <span class="text-primary text-metadata font-bold">Live</span>
                    </div>
                    <div class="mt-4 flex -space-x-2">
                        <img alt="Reader" class="h-8 w-8 rounded-full border-2 border-surface"
                            data-alt="A close-up portrait of a diverse person with a friendly smile, captured in soft, warm indoor lighting. The style is professional and minimalist, with a shallow depth of field."
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuC0VML3zUOfHvHKKGgB2fxPpyQcSC9dDq9j0F3O-7KH_-bJKLZNCU3pwl4DqzYrk4a9mDsbUjTTeGQn1-l7FjNNMq1fsTUXkKscVzA1EsyIyOQp4-zEo_R0qq4xuYna2CersNSNoMxRIG0w7MRpebhs_KgIWf9q32VIZN7GLS1K0m1tFxvwatR_gvRlf1TMFdZcSAZWPL2xMDJxu8K84-ayBmsIDrZ6b8fEqSHFoCKU4oAv8lcw89UGku8au7BjnTypsdLs5Y3VCeg-" />
                        <img alt="Reader" class="h-8 w-8 rounded-full border-2 border-surface"
                            data-alt="A high-quality portrait of a smiling individual with natural lighting. The background is a blurred office setting, reinforcing a professional yet accessible atmosphere."
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuBc3-HbWxqddsKbBQvRl9SvJVRGmlwiqFh1d-rJkyNdjwPkwMIDOjvHteSALjCg2r0gzl_5Z2Ly69CcdlgoOBkeOcRjQC7HCYkYc5WliviBJPQ8gMquCvlPGhm5UN8YPEinqbPSAiemK7PoUOscV22Lkq_dqVVUOwVCWxKSgLqY9xHOXWU2McIZ7HDKGMMBa7W4vxUqx1ghu5VHGHBH3KQdx9hyR8TAtGr30ZqCrwoioyW3M_gsVMu6Rf0gCPJHZVdwvRk-ydzKesNu" />
                        <div
                            class="h-8 w-8 rounded-full border-2 border-surface bg-primary-fixed flex items-center justify-center text-[10px] font-bold text-on-primary-fixed">
                            +42</div>
                    </div>
                </div>
                <div class="bg-on-background text-inverse-on-surface p-6 rounded-xl border border-outline">
                    <h3 class="font-headline-md text-[20px] mb-2">Pro Tip</h3>
                    <p class="text-metadata font-metadata opacity-80 leading-relaxed">Articles published on Tuesdays
                        at 9:00 AM receive 40% more engagement in the 'Paper &amp; Ink' ecosystem.</p>
                </div>
            </aside>
            <!-- Main Content Area -->
            <div class="col-span-12 lg:col-span-9 space-y-6">
                <!-- Tabs & Search Filter -->
                <div
                    class="flex flex-col md:flex-row md:items-center justify-between border-b border-outline-variant gap-4">
                    <div class="flex gap-8 overflow-x-auto no-scrollbar">
                        @foreach ($status_options as $option)
                        <a href="{{ route('dashboard.posts.index', ['status' => strtolower($option['name'])]) }}"
                            class="{{ $status == strtolower($option['name'])? 'border-b-2 border-primary text-primary' : '' }} pb-4 text-ui-label font-bold whitespace-nowrap">
                            {{ $option['name'] }}
                            ({{ $option['count'] }})
                        </a>
                        @endforeach

                    </div>
                    <div class="flex items-center gap-2 pb-2">
                        <button
                            class="p-2 text-on-surface-variant hover:bg-surface-container rounded-lg transition-all">
                            <span class="material-symbols-outlined" data-icon="filter_list">filter_list</span>
                        </button>
                        <button
                            class="p-2 text-on-surface-variant hover:bg-surface-container rounded-lg transition-all">
                            <span class="material-symbols-outlined" data-icon="sort">sort</span>
                        </button>
                    </div>
                </div>
                <!-- Bulk Actions Bar (Sticky-ish) -->
                <div
                    class="bg-surface-container-low px-4 py-3 rounded-lg flex items-center justify-between border border-outline-variant">
                    <div class="flex items-center gap-4">
                        <input class="w-4 h-4 rounded border-outline text-primary focus:ring-primary" type="checkbox" />
                        <span class="text-metadata font-ui-label font-medium text-on-surface-variant">2 posts
                            selected</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <button
                            class="text-metadata font-ui-label font-semibold text-secondary hover:text-on-surface transition-all">Unpublish</button>
                        <span class="w-px h-4 bg-outline-variant"></span>
                        <button
                            class="text-metadata font-ui-label font-semibold text-error hover:text-on-error-container transition-all">Delete</button>
                    </div>
                </div>
                <!-- Post Table/List -->
                <div class="space-y-4">
                    @foreach ($posts as $post)
                    <div
                        class="bg-surface-container-lowest p-5 rounded-xl border border-outline-variant hover:border-primary transition-all group">
                        <div class="flex items-start gap-4">
                            <input class="mt-2 w-4 h-4 rounded border-outline text-primary focus:ring-primary"
                                type="checkbox" />
                            <div class="flex-grow grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                                <div class="md:col-span-6">
                                    <span class="text-metadata font-metadata text-primary mb-1 block">Editorial • 8
                                        min read</span>
                                    <h3
                                        class="font-headline-md text-[20px] leading-snug group-hover:text-primary transition-colors">
                                        {{ $post->title }}</h3>
                                    <p class="text-metadata font-metadata text-on-surface-variant mt-1">Published on
                                        {{ $post->created_at->format('M j, Y H:i') }}</p>
                                </div>
                                <div class="md:col-span-2 flex flex-col">
                                    <span class="text-metadata font-metadata text-outline">Engagement</span>
                                    <div class="flex items-center gap-4 mt-1">
                                        <div class="flex items-center gap-1 text-ui-label font-medium">
                                            <span class="material-symbols-outlined text-[18px]"
                                                data-icon="visibility">visibility</span>
                                            {{ Illuminate\Support\Number::abbreviate($post->views) }}
                                        </div>
                                        <div class="flex items-center gap-1 text-ui-label font-medium">
                                            <span class="material-symbols-outlined text-[18px]"
                                                data-icon="chat_bubble">chat_bubble</span> 84
                                        </div>
                                    </div>
                                </div>
                                <div class="md:col-span-2">
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-green-50 text-green-700 text-[12px] font-bold border border-green-200">
                                        <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
                                        {{ ucfirst($post->status) }}
                                    </span>
                                </div>
                                <div
                                    class="md:col-span-2 flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <a href="{{ route('dashboard.posts.edit', $post->id) }}"
                                        class="p-2 text-on-surface-variant hover:bg-surface-container hover:text-primary rounded-lg transition-all"
                                        title="Edit">
                                        <span class="material-symbols-outlined" data-icon="edit">edit</span>
                                    </a>
                                    <button
                                        class="p-2 text-on-surface-variant hover:bg-surface-container hover:text-primary rounded-lg transition-all"
                                        title="Analytics">
                                        <span class="material-symbols-outlined" data-icon="bar_chart">bar_chart</span>
                                    </button>
                                    <button
                                        onclick="confirm('Are you sure you want to delete this post?')? document.getElementById('deletepost{{ $post->id }}').submit() : null;"
                                        class="p-2 text-on-surface-variant hover:bg-surface-container rounded-lg transition-all"
                                        title="More">
                                        <span class="material-symbols-outlined" data-icon="delete">delete</span>
                                    </button>
                                    <form style="display: none;" id="deletepost{{ $post->id }}"
                                        action="{{ route('dashboard.posts.destroy', $post->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- Pagination -->
                <div class="flex items-center justify-between pt-8">
                    <span class="text-metadata font-metadata text-on-surface-variant">Showing 1 to 10 of 42
                        posts</span>
                    <div class="flex gap-2">
                        <button
                            class="p-2 border border-outline-variant rounded-lg hover:bg-surface-container-low disabled:opacity-30"
                            disabled="">
                            <span class="material-symbols-outlined" data-icon="chevron_left">chevron_left</span>
                        </button>
                        <button
                            class="h-10 w-10 border border-primary bg-primary text-on-primary rounded-lg font-ui-label">1</button>
                        <button
                            class="h-10 w-10 border border-outline-variant hover:bg-surface-container-low rounded-lg font-ui-label">2</button>
                        <button
                            class="h-10 w-10 border border-outline-variant hover:bg-surface-container-low rounded-lg font-ui-label">3</button>
                        <button class="p-2 border border-outline-variant rounded-lg hover:bg-surface-container-low">
                            <span class="material-symbols-outlined" data-icon="chevron_right">chevron_right</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

</x-layout>
