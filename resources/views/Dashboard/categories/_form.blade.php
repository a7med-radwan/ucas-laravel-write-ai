<form action="{{ $action ?? route('dashboard.categories.store') }}" method="POST"
    class="max-w-3xl mx-auto p-8 mt-10">
    @csrf
    @method($method ?? 'POST')

    <div class="bg-surface rounded-2xl border border-outline-variant p-8 shadow-sm">

        <!-- Header -->
        <div class="mb-8">
            <h2 class="font-display-lg text-display-lg text-on-surface ">
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
                    class="block mb-2 font-ui-label text-ui-label uppercase tracking-wide text-secondary">
                    Name
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $category->name) }}"
                    placeholder="Technology"
                    class="w-full bg-white border border-outline-variant rounded-xl px-4 py-3
                    text-on-surface font-body-md
                    focus:outline-none focus:ring-2 focus:ring-primary/20
                    focus:border-primary transition-all">
            </div>

            <!-- Description -->
            <div>
                <label
                    class="block mb-2 font-ui-label text-ui-label uppercase tracking-wide text-secondary">
                    Description
                </label>

                <textarea
                    name="description"
                    rows="4"
                    placeholder="Short description about this category..."
                    class="w-full bg-white border border-outline-variant rounded-xl px-4 py-3
                    text-on-surface font-body-md resize-none
                    focus:outline-none focus:ring-2 focus:ring-primary/20
                    focus:border-primary transition-all">{{ old('description', $category->description) }}</textarea>
            </div>

            <!-- Slug -->
            <div>
                <label
                    class="block mb-2 font-ui-label text-ui-label uppercase tracking-wide text-secondary">
                    Slug
                </label>

                <input
                    type="text"
                    name="slug"
                    value="{{ old('slug', $category->slug) }}"
                    placeholder="technology"
                    class="w-full bg-white border border-outline-variant rounded-xl px-4 py-3
                    text-on-surface font-body-md
                    focus:outline-none focus:ring-2 focus:ring-primary/20
                    focus:border-primary transition-all">
            </div>

        </div>

        <!-- Actions -->
        <div class="flex items-center justify-end gap-3 mt-10">

            <a href="{{ route('dashboard.categories.index') }}"
                class="px-5 py-3 rounded-xl border border-outline-variant
                text-secondary hover:bg-surface-container transition-colors">
                Cancel
            </a>

            <button
                type="submit"
                class="bg-primary text-on-primary px-6 py-3 rounded-xl
                font-ui-label text-ui-label
                hover:bg-primary-hover transition-colors shadow-sm">
                Save Category
            </button>

        </div>
    </div>
</form>