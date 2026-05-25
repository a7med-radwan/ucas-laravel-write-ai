<x-layout>
    <main class="pt-24 pb-section-gap px-gutter max-w-container-max mx-auto">
        <!-- Header Section -->
        <header class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
            <div class="max-w-2xl">
                <h1 class="font-display-lg text-display-lg text-on-surface mb-2">Category Management</h1>
                <p class="font-body-md text-on-surface-variant">Organize your content structure, monitor performance
                    metrics, and refine your editorial taxonomy for maximum audience engagement.</p>
            </div>
            <a href="{{ route('dashboard.categories.create') }}"
                class="bg-primary text-on-primary px-6 py-3 rounded-lg font-ui-button text-ui-button shadow-sm hover:opacity-90 active:scale-95 transition-all flex items-center gap-2 whitespace-nowrap">
                <span class="material-symbols-outlined">add</span>
                Create Category
            </a>
        </header>
        <!-- Search and Layout Toggle -->
        <div class="flex flex-col md:flex-row gap-4 items-center justify-between mb-8">
            <div class="relative w-full md:w-96">
                <span
                    class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
                <input
                    class="w-full bg-surface-container-lowest border border-outline-variant rounded-xl pl-12 pr-4 py-3 font-ui-label text-ui-label focus:border-primary outline-none transition-all"
                    placeholder="Filter categories by name..." type="text" />
            </div>
            <div class="flex items-center gap-2 bg-surface-container-low p-1 rounded-lg">
                <button class="p-2 bg-surface-container-lowest text-primary rounded shadow-sm">
                    <span class="material-symbols-outlined">grid_view</span>
                </button>
                <button class="p-2 text-on-surface-variant">
                    <span class="material-symbols-outlined">list</span>
                </button>
            </div>
        </div>
        <!-- Category Grid (Asymmetric Bento-inspired layout) -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
            @php 
                $topCategory = clone $categories->first(); 
                $otherCategories = clone $categories->slice(1, 3);
            @endphp

            @if($topCategory)
            <!-- Category Card 1: Top Performing (Large Feature) -->
            <div class="md:col-span-8 bg-surface-container-lowest border border-outline-variant rounded-xl p-8 hover:border-primary transition-colors group relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-bl-full -mr-8 -mt-8 transition-transform group-hover:scale-110"></div>
                <div class="relative z-10">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <span class="text-primary font-bold text-sm tracking-widest uppercase mb-2 block">Top Category</span>
                            <h2 class="font-headline-md text-headline-md text-on-surface">{{ $topCategory->name }}</h2>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('dashboard.categories.edit', $topCategory->id) }}" class="p-2 hover:bg-surface-variant rounded transition-colors text-on-surface-variant" title="Edit">
                                <span class="material-symbols-outlined">edit</span>
                            </a>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-8">
                        <div>
                            <p class="font-metadata text-metadata text-on-surface-variant uppercase mb-1">Posts</p>
                            <p class="font-headline-md text-2xl font-bold">{{ \App\Models\Post::where('category_id', $topCategory->id)->count() }}</p>
                        </div>
                        <div>
                            <p class="font-metadata text-metadata text-on-surface-variant uppercase mb-1">Views</p>
                            <p class="font-headline-md text-2xl font-bold">{{ number_format(\App\Models\Post::where('category_id', $topCategory->id)->sum('views')) }}</p>
                        </div>
                        <div>
                            <p class="font-metadata text-metadata text-on-surface-variant uppercase mb-1">Description</p>
                            <p class="font-metadata text-metadata text-on-surface-variant line-clamp-2">{{ $topCategory->description }}</p>
                        </div>
                        <div>
                            <p class="font-metadata text-metadata text-on-surface-variant uppercase mb-1">Status</p>
                            <p class="font-headline-md text-2xl font-bold text-green-600">Active</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 pt-6 border-t border-outline-variant">
                        <span class="font-ui-label text-ui-label text-on-surface-variant">Created {{ $topCategory->created_at->format('M Y') }}</span>
                    </div>
                </div>
            </div>
            @endif

            @foreach($otherCategories as $otherCat)
            <!-- Small Category Card -->
            <div class="md:col-span-4 bg-surface-container-lowest border border-outline-variant rounded-xl p-8 hover:border-primary transition-colors flex flex-col justify-between group">
                <div>
                    <div class="flex justify-between items-start mb-4">
                        <h2 class="font-headline-md text-2xl font-bold text-on-surface">{{ $otherCat->name }}</h2>
                        <button class="p-2 hover:bg-surface-variant rounded transition-colors text-on-surface-variant">
                            <span class="material-symbols-outlined">more_vert</span>
                        </button>
                    </div>
                    <p class="font-body-md text-on-surface-variant text-base mb-6 line-clamp-2">{{ $otherCat->description ?? 'No description provided.' }}</p>
                </div>
                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-on-surface-variant text-sm">article</span>
                        <span class="font-ui-label text-ui-label">{{ \App\Models\Post::where('category_id', $otherCat->id)->count() }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-on-surface-variant text-sm">visibility</span>
                        <span class="font-ui-label text-ui-label">{{ number_format(\App\Models\Post::where('category_id', $otherCat->id)->sum('views')) }}</span>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Add Idea Card -->
            <a href="{{ route('dashboard.categories.create') }}" class="md:col-span-4 bg-surface-container-lowest border border-outline-variant rounded-xl p-8 border-dashed flex flex-col items-center justify-center text-center opacity-60 hover:opacity-100 hover:bg-surface transition-all cursor-pointer">
                <div class="w-12 h-12 rounded-full border border-outline-variant flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined text-on-surface-variant">add</span>
                </div>
                <p class="font-ui-label text-ui-label">Add Category</p>
                <p class="font-metadata text-metadata text-on-surface-variant mt-1">Create a new category</p>
            </a>
        </div>
        <!-- Table View For Bulk Actions (Secondary Section) -->
        <section class="mt-20">
            <h3 class="font-headline-md text-headline-md text-on-surface mb-8">All Categories</h3>
            <div class="overflow-x-auto bg-surface-container-lowest border border-outline-variant rounded-xl">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-surface-container-low border-b border-outline-variant">
                            <th
                                class="px-6 py-4 font-ui-label text-ui-label font-bold text-on-surface uppercase tracking-wider">
                                Category Name</th>
                            <th
                                class="px-6 py-4 font-ui-label text-ui-label font-bold text-on-surface uppercase tracking-wider">
                                Discrption</th>
                            <th
                                class="px-6 py-4 font-ui-label text-ui-label font-bold text-on-surface uppercase tracking-wider">
                                Status</th>
                            <th
                                class="px-6 py-4 font-ui-label text-ui-label font-bold text-on-surface uppercase tracking-wider">
                                Post Count</th>
                            <th
                                class="px-6 py-4 font-ui-label text-ui-label font-bold text-on-surface uppercase tracking-wider">
                                Total Views</th>
                            <th
                                class="px-6 py-4 font-ui-label text-ui-label font-bold text-on-surface uppercase tracking-wider text-right">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant">
                        @foreach ($categories as $category)
                            <tr class="hover:bg-surface transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-headline-md text-xl font-bold">{{ $category->name }}</div>
                                    <div class="font-metadata text-metadata text-on-surface-variant">
                                        {{ $category->slug }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-headline-md text-xl font-bold">{{ $category->description }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs font-bold">Active</span>
                                </td>
                                <td class="px-6 py-4 font-ui-label text-ui-label">{{ \App\Models\Post::where('category_id', $category->id)->count() }}</td>
                                <td class="px-6 py-4 font-ui-label text-ui-label">{{ number_format(\App\Models\Post::where('category_id', $category->id)->sum('views') ?? 0) }}</td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('dashboard.categories.edit', $category->id) }}"
                                            class="text-on-surface-variant hover:text-primary"><span
                                                class="material-symbols-outlined">edit</span></a>
                                        <button
                                            onclick="confirm('Are you sure you want to delete this category?')? document.getElementById('deletecategory{{ $category->id }}').submit() : null;"
                                            class="p-2 text-on-surface-variant hover:bg-surface-container rounded-lg transition-all"
                                            title="More">
                                            <span class="material-symbols-outlined" data-icon="delete">delete</span>
                                        </button>

                                            <form style="display: none;" id="deletecategory{{ $category->id }}"
                                                action="{{ route('dashboard.categories.destroy', $category->id) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</x-layout>