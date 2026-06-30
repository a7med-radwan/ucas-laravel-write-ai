<x-layout title="Category Management">
    <div class="pt-8 pb-section-gap px-gutter max-w-container-max mx-auto">
        <header class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
            <div class="max-w-2xl">
                <h1 class="font-display-lg-mobile text-[22px] font-bold text-on-surface truncate">Category Management</h1>
                <p class="font-body-md text-on-surface-variant">Organize your content structure and manage editorial categories.</p>
            </div>
            <a href="{{ route('dashboard.categories.create') }}"
                class="inline-flex items-center gap-2 bg-primary text-on-primary px-5 py-2.5 rounded-lg font-ui-button text-ui-button shadow-sm hover:opacity-90 transition-all shrink-0">
                <span class="material-symbols-outlined text-[20px]">add</span>
                Create Category
            </a>
        </header>

        @if (session()->has('status'))
            <div class="mb-6 p-4 bg-green-50 text-green-800 rounded-xl border border-green-200 flex items-center gap-3">
                <span class="material-symbols-outlined text-green-600">check_circle</span>
                <span class="font-ui-label text-ui-label">{{ session('status') }}</span>
            </div>
        @endif

        <div class="overflow-x-auto bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm">
            <table class="w-full text-left border-collapse min-w-[700px]">
                <thead>
                    <tr class="bg-surface-container-low border-b border-outline-variant">
                        <th class="px-5 py-3.5 font-ui-label text-ui-label font-bold text-on-surface uppercase tracking-wider">Category</th>
                        <th class="px-5 py-3.5 font-ui-label text-ui-label font-bold text-on-surface uppercase tracking-wider">Description</th>
                        <th class="px-5 py-3.5 font-ui-label text-ui-label font-bold text-on-surface uppercase tracking-wider">Posts</th>
                        <th class="px-5 py-3.5 font-ui-label text-ui-label font-bold text-on-surface uppercase tracking-wider">Views</th>
                        <th class="px-5 py-3.5 font-ui-label text-ui-label font-bold text-on-surface uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant">
                    @foreach ($categories as $category)
                        <tr class="hover:bg-surface/60 transition-colors">
                            <td class="px-5 py-4">
                                <div class="font-ui-label text-ui-label font-bold text-on-surface">{{ $category->name }}</div>
                                <div class="font-metadata text-metadata text-on-surface-variant">{{ $category->slug }}</div>
                            </td>
                            <td class="px-5 py-4 font-ui-label text-ui-label text-on-surface-variant max-w-xs">
                                <span class="line-clamp-2">{{ $category->description ?: '—' }}</span>
                            </td>
                            <td class="px-5 py-4 font-ui-label text-ui-label">{{ \App\Models\Post::where('category_id', $category->id)->count() }}</td>
                            <td class="px-5 py-4 font-ui-label text-ui-label">{{ number_format(\App\Models\Post::where('category_id', $category->id)->sum('views') ?? 0) }}</td>
                            <td class="px-5 py-4">
                                <div class="flex justify-end gap-1">
                                    <a href="{{ route('dashboard.categories.edit', $category->id) }}"
                                        class="p-2 text-on-surface-variant hover:text-primary hover:bg-surface-container rounded-lg transition-all"
                                        title="Edit">
                                        <span class="material-symbols-outlined text-[20px]">edit</span>
                                    </a>
                                    <button
                                        onclick="confirm('Are you sure you want to delete this category?') ? document.getElementById('deletecategory{{ $category->id }}').submit() : null;"
                                        class="p-2 text-on-surface-variant hover:bg-error-container hover:text-error rounded-lg transition-all"
                                        title="Delete">
                                        <span class="material-symbols-outlined text-[20px]">delete</span>
                                    </button>
                                    <form class="hidden" id="deletecategory{{ $category->id }}"
                                        action="{{ route('dashboard.categories.destroy', $category->id) }}" method="post">
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
    </div>
</x-layout>
