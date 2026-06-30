<form action="{{ $action ?? route('dashboard.categories.store') }}" method="POST"
    class="pt-8 pb-section-gap px-gutter max-w-3xl mx-auto">
    @csrf
    @method($method ?? 'POST')

    <a href="{{ route('dashboard.categories.index') }}" class="inline-flex items-center gap-1.5 text-on-surface-variant hover:text-primary font-ui-label text-ui-label mb-6 transition-colors">
        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
        Back to Categories
    </a>

    <div class="bg-surface-container-lowest rounded-xl border border-outline-variant p-6 sm:p-8 shadow-sm">

        <!-- Header -->
        <div class="mb-8">
            <h2 class="font-display-lg-mobile text-[22px] font-bold text-on-surface truncate">
            {{ isset($category->id) ? 'Edit Category' : 'Create Category' }}
            </h2>

            <p class="text-secondary font-body-md mt-2">
                Organize your content with clean and meaningful categories.
            </p>
        </div>

        <!-- Fields -->
        <div class="space-y-6">

            <!-- Name -->
            <div>
                <label
                    class="block mb-2 font-ui-label text-ui-label font-medium text-on-surface">
                    Name
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $category->name) }}"
                    placeholder="Technology"
                    class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-2.5
                    text-on-surface font-ui-label text-ui-label
                    focus:outline-none focus:ring-2 focus:ring-primary/20
                    focus:border-primary transition-all">
            </div>

            <!-- Description -->
            <div>
                <label
                    class="block mb-2 font-ui-label text-ui-label font-medium text-on-surface">
                    Description
                </label>

                <textarea
                    name="description"
                    rows="4"
                    placeholder="Short description about this category..."
                    class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-2.5
                    text-on-surface font-ui-label text-ui-label resize-none
                    focus:outline-none focus:ring-2 focus:ring-primary/20
                    focus:border-primary transition-all">{{ old('description', $category->description) }}</textarea>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-end gap-3 mt-10">

            <a href="{{ route('dashboard.categories.index') }}"
                class="px-5 py-2.5 rounded-lg border border-outline-variant
                text-on-surface-variant font-ui-label text-ui-label hover:bg-surface-container transition-colors">
                Cancel
            </a>

            <button
                type="submit"
                class="bg-primary text-on-primary px-6 py-2.5 rounded-lg
                font-ui-label text-ui-label
                hover:opacity-90 transition-all shadow-sm">
                Save Category
            </button>

        </div>
    </div>
</form>