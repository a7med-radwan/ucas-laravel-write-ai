<x-slot:head-scripts>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.2.1/tinymce.min.js" referrerpolicy="origin"
        crossorigin="anonymous"></script>
</x-slot:head-scripts>

<form action="{{ $action ?? route('dashboard.posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method($method ?? 'POST')

    <main class="pt-24 pb-32 flex flex-col lg:flex-row max-w-container-max mx-auto px-gutter gap-12">

        <!-- Editor Canvas -->
        <div class="flex-1 max-w-article-max mx-auto w-full">
            <div class="editor-container mb-8">
                <!-- Errors Banner -->
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-error-container text-on-error-container border border-error/15 rounded-xl flex items-start gap-3 shadow-sm">
                        <span class="material-symbols-outlined text-error">error</span>
                        <div class="space-y-1">
                            <h4 class="font-bold text-sm">Please correct the errors below:</h4>
                            <ul class="list-disc list-inside text-xs opacity-90 space-y-0.5">
                                @foreach ($errors->all() as $message)
                                    <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <!-- Title Field -->
                <input type="text" name="title" id="post-title-input" value="{{ old('title', $post->title) }}"
                    class="w-full bg-transparent border-none focus:ring-0 font-display-lg text-display-lg resize-none placeholder:text-surface-variant text-on-surface mb-6 overflow-hidden p-0"
                    placeholder="Enter your title...">
                @error('title')
                    <p class="text-error text-xs mt-1 mb-4">{{ $message }}</p>
                @enderror

                <!-- Content Textarea (Rich Editor) -->
                <div class="min-h-[500px] border-b border-outline-variant/60 pb-8 mb-8">
                    <textarea name="content" id="content"
                        class="w-full bg-transparent border-none focus:ring-0 font-body-lg text-body-lg text-on-surface leading-relaxed placeholder:text-surface-variant"
                        placeholder="Type your story...">{{ old('content', $post->content) }}</textarea>
                    @error('content')
                        <p class="text-error text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- SEO & Cover Metadata Card -->
            <div class="bg-white border border-outline-variant rounded-xl p-6 shadow-sm mb-12 space-y-6">
                <div class="flex items-center gap-2 border-b border-outline-variant/60 pb-4 mb-2">
                    <span class="material-symbols-outlined text-primary">seo</span>
                    <h3 class="font-headline-md text-[20px] text-on-surface font-semibold">SEO & Extra Metadata</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex flex-col gap-1.5">
                        <label class="font-ui-label text-ui-label text-secondary font-bold uppercase tracking-wider">Meta Title</label>
                        <input type="text" name="meta[title]" id="meta-title-input" value="{{ old('meta.title', $post->meta['title'] ?? '') }}"
                            class="w-full bg-surface-container/30 border border-outline-variant rounded-lg px-4 py-2.5 font-metadata text-metadata focus:ring-1 focus:ring-primary focus:border-primary transition-all text-on-surface placeholder:text-secondary/50"
                            placeholder="Enter meta title...">
                        @error('meta.title')
                            <p class="text-error text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="flex flex-col gap-1.5">
                        <label class="font-ui-label text-ui-label text-secondary font-bold uppercase tracking-wider">Meta Keywords</label>
                        <input type="text" name="meta[keywords]" value="{{ old('meta.keywords', $post->meta['keywords'] ?? '') }}"
                            class="w-full bg-surface-container/30 border border-outline-variant rounded-lg px-4 py-2.5 font-metadata text-metadata focus:ring-1 focus:ring-primary focus:border-primary transition-all text-on-surface placeholder:text-secondary/50"
                            placeholder="e.g. laravel, coding, artificial intelligence">
                        @error('meta.keywords')
                            <p class="text-error text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-1.5 md:col-span-2">
                        <label class="font-ui-label text-ui-label text-secondary font-bold uppercase tracking-wider">Canonical / Meta URL</label>
                        <input type="text" name="meta[url]" value="{{ old('meta.url', $post->meta['url'] ?? '') }}"
                            class="w-full bg-surface-container/30 border border-outline-variant rounded-lg px-4 py-2.5 font-metadata text-metadata focus:ring-1 focus:ring-primary focus:border-primary transition-all text-on-surface placeholder:text-secondary/50"
                            placeholder="e.g. https://yourdomain.com/posts/slug-url">
                        @error('meta.url')
                            <p class="text-error text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-1.5 md:col-span-2">
                        <label class="font-ui-label text-ui-label text-secondary font-bold uppercase tracking-wider">Meta Description</label>
                        <textarea name="meta[description]" id="meta-description-input" rows="3"
                            class="w-full bg-surface-container/30 border border-outline-variant rounded-lg px-4 py-2.5 font-metadata text-metadata focus:ring-1 focus:ring-primary focus:border-primary transition-all text-on-surface placeholder:text-secondary/50 resize-none"
                            placeholder="Enter short post description for SEO search engines...">{{ old('meta.description', $post->meta['description'] ?? '') }}</textarea>
                        @error('meta.description')
                            <p class="text-error text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Bottom Action Buttons -->
            <div class="flex items-center gap-4 pt-6 border-t border-outline-variant/60">
                <button type="submit"
                    class="bg-primary text-on-primary font-bold py-3.5 px-8 rounded-xl font-ui-label text-ui-label hover:bg-primary-hover shadow-md hover:shadow-lg active:scale-[0.99] transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px]">save</span>
                    {{ isset($post->id) ? 'Save Changes' : 'Publish Post' }}
                </button>
                <a href="{{ route('dashboard.posts.index') }}"
                    class="text-secondary hover:text-on-surface py-3.5 px-6 font-ui-label text-ui-label font-medium transition-colors">
                    Cancel
                </a>
            </div>
        </div>

        <!-- Sidebar: Publishing Settings -->
        <aside class="w-full lg:w-80 lg:shrink-0 h-fit lg:sticky lg:top-24 sidebar-overlay transition-opacity duration-500">
            <div class="space-y-8 lg:border-l lg:border-outline-variant lg:pl-8">
                
                <!-- Main Action (Sticky top sidebar on Desktop) -->
                <section class="pb-6 border-b border-outline-variant/60">
                    <button type="submit"
                        class="w-full bg-primary text-on-primary font-bold py-3.5 px-6 rounded-xl font-ui-label text-ui-label hover:bg-primary-hover shadow-md hover:shadow-lg hover:scale-[1.01] active:scale-[0.99] transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[20px]">publish</span>
                        {{ isset($post->id) ? 'Save Changes' : 'Publish Post' }}
                    </button>
                </section>

                <!-- Cover Image -->
                <section>
                    <h3 class="font-ui-label text-ui-label text-on-surface mb-3 uppercase tracking-wider font-bold">Cover Image</h3>
                    <label class="block cursor-pointer">
                        <input type="file" name="cover" id="cover-input" accept="image/*" class="hidden" onchange="previewCoverImage(this)" />
                        
                        <div id="cover-preview-container">
                            @if ($post->cover_image)
                                <div class="aspect-video w-full rounded-lg bg-cover bg-center mb-2 border border-outline-variant relative group overflow-hidden"
                                    style="background-image: url('{{ asset('storage/' . $post->cover_image) }}')">
                                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2 text-white">
                                        <span class="material-symbols-outlined">edit</span>
                                        <span class="text-sm font-medium">Change Photo</span>
                                    </div>
                                </div>
                            @else
                                <div class="aspect-video w-full rounded-lg bg-surface-container border-2 border-dashed border-outline-variant flex flex-col items-center justify-center gap-2 hover:bg-surface-container-high transition-colors group p-4 text-center">
                                    <span class="material-symbols-outlined text-secondary group-hover:text-primary transition-colors text-[32px]">add_a_photo</span>
                                    <span class="font-metadata text-metadata text-secondary">Upload high-res cover photo</span>
                                </div>
                            @endif
                        </div>
                    </label>
                    @error('cover')
                        <p class="text-error text-xs mt-1">{{ $message }}</p>
                    @enderror
                </section>

                <!-- Categories -->
                <section>
                    <h3 class="font-ui-label text-ui-label text-on-surface mb-3 uppercase tracking-wider font-bold">Category</h3>
                    <select name="category_id" id="category_id"
                        class="w-full bg-white border border-outline-variant rounded-lg px-4 py-2.5 font-metadata text-metadata focus:ring-1 focus:ring-primary focus:border-primary transition-all text-on-surface">
                        <option value="">Select category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @if (old('category_id', $post->category_id) == $category->id) selected @endif>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-error text-xs mt-1">{{ $message }}</p>
                    @enderror
                </section>

                <!-- Publish Time -->
                <section>
                    <h3 class="font-ui-label text-ui-label text-on-surface mb-3 uppercase tracking-wider font-bold">Publish Time</h3>
                    <input name="published_at" value="{{ old('published_at', $post->published_at?->format('Y-m-d\TH:i')) }}"
                        class="w-full bg-white border border-outline-variant rounded-lg px-4 py-2.5 font-metadata text-metadata focus:ring-1 focus:ring-primary focus:border-primary transition-all text-on-surface"
                        type="datetime-local" />
                    @error('published_at')
                        <p class="text-error text-xs mt-1">{{ $message }}</p>
                    @enderror
                </section>

                <!-- Tags -->
                <section>
                    <h3 class="font-ui-label text-ui-label text-on-surface mb-3 uppercase tracking-wider font-bold">Tags</h3>
                    <input name="tags" value="{{ old('tags', $post->tags->pluck('name')->implode(', ')) }}"
                        class="w-full bg-white border border-outline-variant rounded-lg px-4 py-2.5 font-metadata text-metadata focus:ring-1 focus:ring-primary focus:border-primary transition-all text-on-surface"
                        placeholder="Comma separated: tech, coding, laravel" type="text" />
                    @error('tags')
                        <p class="text-error text-xs mt-1">{{ $message }}</p>
                    @enderror
                </section>

                <!-- SEO Live Preview Widget -->
                <section class="pt-4 border-t border-outline-variant/60">
                    <h3 class="font-ui-label text-ui-label text-on-surface mb-3 uppercase tracking-wider font-bold">Google SEO Preview</h3>
                    <div class="p-4 bg-white border border-outline-variant rounded-lg shadow-sm">
                        <div id="seo-preview-title" class="text-[#1a0dab] font-sans text-[16px] leading-tight mb-1 font-medium line-clamp-1">
                            {{ $post->meta['title'] ?? ($post->title ?? 'Untitled Post') }} | Ink & Paper
                        </div>
                        <div id="seo-preview-url" class="text-[#202124] font-sans text-[13px] mb-1 line-clamp-1 opacity-80">
                            inkandpaper.com/posts/{{ $post->slug ?? 'untitled-post' }}
                        </div>
                        <p id="seo-preview-description" class="text-[#4d5156] font-sans text-[13px] line-clamp-2 leading-relaxed">
                            {{ $post->meta['description'] ?? 'Start writing your story to see the SEO description preview...' }}
                        </p>
                    </div>
                </section>

                <!-- Visibility -->
                <section class="pt-4 border-t border-outline-variant/60">
                    <label class="flex items-center justify-between cursor-pointer group">
                        <span class="font-ui-label text-ui-label text-secondary group-hover:text-on-surface transition-colors font-semibold">Public Post</span>
                        <div class="relative inline-flex items-center">
                            <input checked="" class="sr-only peer" type="checkbox" />
                            <div class="w-11 h-6 bg-surface-container-highest peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                        </div>
                    </label>
                </section>
            </div>
        </aside>

    </main>
</form>

<script>
    // Initialize Tinymce
    tinymce.init({
        selector: '#content',
        plugins: [
            'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount', 'image'
        ],
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        branding: false,
        promotion: false,
        setup: function (editor) {
            editor.on('change keyup', function () {
                editor.save();
                updateSEODescriptionFromEditor(editor.getContent({ format: 'text' }));
            });
        }
    });

    // Preview uploaded cover image instantly
    function previewCoverImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var container = document.getElementById('cover-preview-container');
                container.innerHTML = `
                    <div class="aspect-video w-full rounded-lg bg-cover bg-center mb-2 border border-outline-variant relative group overflow-hidden"
                        style="background-image: url('${e.target.result}')">
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2 text-white">
                            <span class="material-symbols-outlined">edit</span>
                            <span class="text-sm font-medium">Change Photo</span>
                        </div>
                    </div>
                `;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Interactive SEO live preview matching Google's search result snippet style
    const postTitleInput = document.getElementById('post-title-input');
    const metaTitleInput = document.getElementById('meta-title-input');
    const metaDescriptionInput = document.getElementById('meta-description-input');

    const seoTitle = document.getElementById('seo-preview-title');
    const seoDescription = document.getElementById('seo-preview-description');
    const seoUrl = document.getElementById('seo-preview-url');

    function updateSEO() {
        // Handle Title Preview
        const rawTitle = metaTitleInput.value.trim() || postTitleInput.value.trim() || 'Untitled Post';
        seoTitle.textContent = rawTitle + ' | Ink & Paper';
        
        // Handle URL Preview
        const cleanSlug = (postTitleInput.value.trim() || 'untitled-post')
            .toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/(^-|-$)+/g, '');
        seoUrl.textContent = 'inkandpaper.com/posts/' + cleanSlug;

        // Handle Description Preview
        const rawDesc = metaDescriptionInput.value.trim();
        if (rawDesc) {
            seoDescription.textContent = rawDesc;
        } else {
            // Fallback to tinymce text if available, otherwise default instruction
            const tinymceEditor = tinymce.get('content');
            const editorText = tinymceEditor ? tinymceEditor.getContent({ format: 'text' }).trim() : '';
            seoDescription.textContent = editorText.substring(0, 160) || 'Start writing your story to see the SEO description preview...';
        }
    }

    function updateSEODescriptionFromEditor(text) {
        if (!metaDescriptionInput.value.trim()) {
            seoDescription.textContent = text.substring(0, 160) || 'Start writing your story to see the SEO description preview...';
        }
    }

    if (postTitleInput && metaTitleInput && metaDescriptionInput) {
        postTitleInput.addEventListener('input', updateSEO);
        metaTitleInput.addEventListener('input', updateSEO);
        metaDescriptionInput.addEventListener('input', updateSEO);
    }
</script>