<x-slot:head-scripts>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.2.1/tinymce.min.js" referrerpolicy="origin"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
</x-slot:head-scripts>

<form action="{{ $action ?? route('dashboard.posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method($method ?? 'POST')

    <div class="pt-8 pb-16 flex flex-col lg:flex-row max-w-container-max mx-auto px-gutter gap-10">

        <!-- Editor Canvas -->
        <div class="flex-1 max-w-article-max mx-auto w-full">
            <div class="editor-container mb-8">
                <!-- Errors Banner -->
                @if ($errors->any())
                    <div
                        class="mb-6 p-4 bg-error-container text-on-error-container border border-error/15 rounded-xl flex items-start gap-3 shadow-sm">
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

                <div class="flex items-center justify-between mb-6 gap-4">
                    <div class="text-sm text-secondary font-bold">Need inspiration? Use AI to generate a draft.
                    </div>
                    <button type="button" id="ai-btn" aria-haspopup="dialog" aria-controls="ai-modal"
                        class="inline-flex items-center gap-2 bg-primary text-on-primary font-semibold py-2 px-3 rounded-md shadow-sm hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-primary/30">
                        <span class="material-symbols-outlined text-[18px]">smart_toy</span>
                        <span class="text-sm">Write with AI</span>
                    </button>
                </div>

                <!-- Title Field -->
                <input type="text" name="title" id="post-title-input" value="{{ old('title', $post->title) }}"
                    class="w-full bg-white border border-outline-variant rounded-lg px-4 py-2.5 font-metadata text-metadata focus:ring-1 focus:ring-primary focus:border-primary transition-all text-on-surface mb-8"
                    placeholder="Enter your title...">
                @error('title')
                    <p class="text-error text-xs mt-1 mb-4">{{ $message }}</p>
                @enderror


                <!-- AI Prompt Modal -->
                <div id="ai-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40">
                    <div class="bg-white border border-outline-variant rounded-xl max-w-2xl w-full p-6 mx-4 shadow-sm">
                        <div class="flex items-start justify-between">
                            <h3 class="font-headline-md text-[18px] text-on-surface font-semibold">Generate Post with AI
                            </h3>
                            <button type="button" id="ai-close" aria-label="Close dialog"
                                class="text-secondary hover:text-on-surface">✕</button>
                        </div>
                        <p class="text-sm text-secondary mt-2">Describe the idea you want the AI to expand into a post.
                            Be concise and specific.</p>
                        <textarea id="ai-input" rows="4"
                            class="mt-3 w-full bg-surface-container/30 border border-outline-variant rounded-lg px-4 py-2.5 text-body-md focus:ring-1 focus:ring-primary focus:border-primary resize-y"
                            placeholder="e.g. A beginner's guide to using Laravel Sanctum for API authentication"></textarea>

                        <div id="ai-progress" class="mt-4 hidden">
                            <div class="p-3 bg-surface-container/40 rounded-md text-sm">Generating content…</div>
                        </div>

                        <div class="mt-4 flex items-center justify-end gap-3">
                            <button type="button" id="ai-cancel"
                                class="px-4 py-2 rounded-md border border-outline-variant text-secondary hover:text-on-surface">Cancel</button>
                            <button type="button" id="ai-generate"
                                class="px-4 py-2 rounded-md bg-primary text-on-primary font-semibold hover:bg-primary-hover">Generate</button>
                        </div>
                    </div>
                </div>

                <!-- AI Streaming Status Bar (visible on page while streaming in background) -->
                <div id="ai-streaming-bar"
                    class="hidden mb-4 p-3 bg-primary/8 border border-primary/20 rounded-lg flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary text-[18px]"
                        style="animation: spin 1s linear infinite;">refresh</span>
                    <span class="text-sm text-secondary font-medium">AI is writing your post…</span>
                    <span id="ai-streaming-chars" class="text-xs text-secondary/60 ml-auto">0 chars</span>
                </div>

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

                <div class="p-4 bg-primary/5 border border-primary/10 rounded-lg flex items-start gap-2.5">
                    <span class="material-symbols-outlined text-primary text-[20px]">info</span>
                    <span class="text-xs text-secondary leading-normal">
                        <strong>AI Auto-Generation:</strong> If you leave the SEO fields (Meta Title, Keywords, Description) blank, the AI will automatically generate and fill them in the background once you save the post.
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex flex-col gap-1.5">
                        <label
                            class="font-ui-label text-ui-label text-secondary font-bold uppercase tracking-wider">Meta
                            Title</label>
                        <input type="text" name="meta[title]" id="meta-title-input"
                            value="{{ old('meta.title', $post->meta['title'] ?? '') }}"
                            class="w-full bg-surface-container/30 border border-outline-variant rounded-lg px-4 py-2.5 font-metadata text-metadata focus:ring-1 focus:ring-primary focus:border-primary transition-all text-on-surface placeholder:text-secondary/50"
                            placeholder="Enter meta title...">
                        @error('meta.title')
                            <p class="text-error text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label
                            class="font-ui-label text-ui-label text-secondary font-bold uppercase tracking-wider">Meta
                            Keywords</label>
                        <input type="text" name="meta[keywords]"
                            value="{{ old('meta.keywords', $post->meta['keywords'] ?? '') }}"
                            class="w-full bg-surface-container/30 border border-outline-variant rounded-lg px-4 py-2.5 font-metadata text-metadata focus:ring-1 focus:ring-primary focus:border-primary transition-all text-on-surface placeholder:text-secondary/50"
                            placeholder="e.g. laravel, coding, artificial intelligence">
                        @error('meta.keywords')
                            <p class="text-error text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-1.5 md:col-span-2">
                        <label
                            class="font-ui-label text-ui-label text-secondary font-bold uppercase tracking-wider">Canonical
                            / Meta URL</label>
                        <input type="text" name="meta[url]" value="{{ old('meta.url', $post->meta['url'] ?? '') }}"
                            class="w-full bg-surface-container/30 border border-outline-variant rounded-lg px-4 py-2.5 font-metadata text-metadata focus:ring-1 focus:ring-primary focus:border-primary transition-all text-on-surface placeholder:text-secondary/50"
                            placeholder="e.g. https://yourdomain.com/posts/slug-url">
                        @error('meta.url')
                            <p class="text-error text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-1.5 md:col-span-2">
                        <label
                            class="font-ui-label text-ui-label text-secondary font-bold uppercase tracking-wider">Meta
                            Description</label>
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
        <aside
            class="w-full lg:w-80 lg:shrink-0 h-fit lg:sticky lg:top-24 sidebar-overlay transition-opacity duration-500">
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
                    <h3 class="font-ui-label text-ui-label text-on-surface mb-3 uppercase tracking-wider font-bold">
                        Cover Image</h3>
                    <label class="block cursor-pointer">
                        <input type="file" name="cover" id="cover-input" accept="image/*" class="hidden"
                            onchange="previewCoverImage(this)" />

                        <div id="cover-preview-container">
                            @if ($post->cover_image)
                                <div class="aspect-video w-full rounded-lg bg-cover bg-center mb-2 border border-outline-variant relative group overflow-hidden"
                                    style="background-image: url('{{ asset('storage/' . $post->cover_image) }}')">
                                    <div
                                        class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2 text-white">
                                        <span class="material-symbols-outlined">edit</span>
                                        <span class="text-sm font-medium">Change Photo</span>
                                    </div>
                                </div>
                            @else
                                <div
                                    class="aspect-video w-full rounded-lg bg-surface-container border-2 border-dashed border-outline-variant flex flex-col items-center justify-center gap-2 hover:bg-surface-container-high transition-colors group p-4 text-center">
                                    <span
                                        class="material-symbols-outlined text-secondary group-hover:text-primary transition-colors text-[32px]">add_a_photo</span>
                                    <span class="font-metadata text-metadata text-secondary">Upload high-res cover
                                        photo</span>
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
                    <h3 class="font-ui-label text-ui-label text-on-surface mb-3 uppercase tracking-wider font-bold">
                        Category</h3>
                    <select name="category_id" id="category_id"
                        class="w-full bg-white border border-outline-variant rounded-lg px-4 py-2.5 font-metadata text-metadata focus:ring-1 focus:ring-primary focus:border-primary transition-all text-on-surface">
                        <option value="">Select category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @if (old('category_id', $post->category_id) == $category->id)
                            selected @endif>
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
                    <h3 class="font-ui-label text-ui-label text-on-surface mb-3 uppercase tracking-wider font-bold">
                        Publish Time</h3>
                    <input name="published_at"
                        value="{{ old('published_at', $post->published_at?->format('Y-m-d\TH:i')) }}"
                        class="w-full bg-white border border-outline-variant rounded-lg px-4 py-2.5 font-metadata text-metadata focus:ring-1 focus:ring-primary focus:border-primary transition-all text-on-surface"
                        type="datetime-local" />
                    @error('published_at')
                        <p class="text-error text-xs mt-1">{{ $message }}</p>
                    @enderror
                </section>

                <!-- Tags -->
                <section>
                    <h3 class="font-ui-label text-ui-label text-on-surface mb-3 uppercase tracking-wider font-bold">
                        Tags
                    </h3>
                    <input name="tags" value="{{ old('tags', $post->tags->pluck('name')->implode(', ')) }}"
                        class="w-full bg-white border border-outline-variant rounded-lg px-4 py-2.5 font-metadata text-metadata focus:ring-1 focus:ring-primary focus:border-primary transition-all text-on-surface"
                        placeholder="Comma separated: tech, coding, laravel" type="text" />
                    @error('tags')
                        <p class="text-error text-xs mt-1">{{ $message }}</p>
                    @enderror
                </section>

                <!-- SEO Live Preview Widget -->
                <section class="pt-4 border-t border-outline-variant/60">
                    <h3 class="font-ui-label text-ui-label text-on-surface mb-3 uppercase tracking-wider font-bold">
                        Google SEO Preview</h3>
                    <div class="p-4 bg-white border border-outline-variant rounded-lg shadow-sm">
                        <div id="seo-preview-title"
                            class="text-[#1a0dab] font-sans text-[16px] leading-tight mb-1 font-medium line-clamp-1">
                            {{ $post->meta['title'] ?? ($post->title ?? 'Untitled Post') }} | Ink & Paper
                        </div>
                        <div id="seo-preview-url"
                            class="text-[#202124] font-sans text-[13px] mb-1 line-clamp-1 opacity-80">
                            inkandpaper.com/posts/{{ $post->slug ?? 'untitled-post' }}
                        </div>
                        <p id="seo-preview-description"
                            class="text-[#4d5156] font-sans text-[13px] line-clamp-2 leading-relaxed">
                            {{ $post->meta['description'] ?? 'Start writing your story to see the SEO description preview...' }}
                        </p>
                    </div>
                </section>

                <!-- Visibility -->
                <section class="pt-4 border-t border-outline-variant/60">
                    <label class="flex items-center justify-between cursor-pointer group">
                        <span
                            class="font-ui-label text-ui-label text-secondary group-hover:text-on-surface transition-colors font-semibold">Public
                            Post</span>
                        <div class="relative inline-flex items-center">
                            <input checked="" class="sr-only peer" type="checkbox" />
                            <div
                                class="w-11 h-6 bg-surface-container-highest peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary">
                            </div>
                        </div>
                    </label>
                </section>
            </div>
        </aside>

    </div>
</form>

<script>
    // Initialize Tinymce
    tinymce.init({
        selector: '#content',
        plugins: [
            'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'link', 'lists', 'media',
            'searchreplace', 'table', 'visualblocks', 'wordcount', 'image'
        ],
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        branding: false,
        promotion: false,
        setup: function (editor) {
            editor.on('change keyup', function () {
                editor.save();
                updateSEODescriptionFromEditor(editor.getContent({
                    format: 'text'
                }));
            });
        }
    });

    // Preview uploaded cover image instantly
    function previewCoverImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
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
            const editorText = tinymceEditor ? tinymceEditor.getContent({
                format: 'text'
            }).trim() : '';
            seoDescription.textContent = editorText.substring(0, 160) ||
                'Start writing your story to see the SEO description preview...';
        }
    }

    function updateSEODescriptionFromEditor(text) {
        if (!metaDescriptionInput.value.trim()) {
            seoDescription.textContent = text.substring(0, 160) ||
                'Start writing your story to see the SEO description preview...';
        }
    }

    if (postTitleInput && metaTitleInput && metaDescriptionInput) {
        postTitleInput.addEventListener('input', updateSEO);
        metaTitleInput.addEventListener('input', updateSEO);
        metaDescriptionInput.addEventListener('input', updateSEO);
    }

    // AI button & SSE streaming logic
    (function () {
        const aiBtn = document.getElementById('ai-btn');
        const aiModal = document.getElementById('ai-modal');
        const aiClose = document.getElementById('ai-close');
        const aiCancel = document.getElementById('ai-cancel');
        const aiGenerate = document.getElementById('ai-generate');
        const aiInput = document.getElementById('ai-input');
        const aiProgress = document.getElementById('ai-progress');
        const aiStreamingBar = document.getElementById('ai-streaming-bar');
        const aiStreamingChars = document.getElementById('ai-streaming-chars');

        // Configure marked.js for safe rendering
        if (typeof marked !== 'undefined') {
            marked.setOptions({ breaks: true, gfm: true });
        }

        function flushMarkdownToEditor(markdown) {
            if (!markdown) return;
            const html = typeof marked !== 'undefined'
                ? marked.parse(markdown)
                : markdown.replace(/\n\n/g, '<p></p>').replace(/\n/g, '<br>');

            const editor = tinymce.get('content');
            if (editor) {
                editor.setContent(html);
                editor.save();
            } else {
                document.getElementById('content').value = html;
            }

            // Hide streaming bar
            aiStreamingBar.classList.add('hidden');
        }

        let evtSource = null;
        let keepStreaming = false;

        function openModal() {
            aiModal.classList.remove('hidden');
            aiModal.classList.add('flex');
            aiInput.focus();
        }

        function closeModal() {
            aiModal.classList.remove('flex');
            aiModal.classList.add('hidden');
            aiProgress.classList.add('hidden');
            aiInput.value = '';
            // do not close evtSource here — allow background streaming
        }

        function cancelStreamAndClose() {
            if (evtSource) {
                evtSource.close();
                evtSource = null;
            }
            keepStreaming = false;
            // Hide streaming bar
            aiStreamingBar.classList.add('hidden');
            closeModal();
        }

        aiBtn.addEventListener('click', openModal);
        aiClose.addEventListener('click', cancelStreamAndClose);
        aiCancel.addEventListener('click', cancelStreamAndClose);

        aiGenerate.addEventListener('click', function () {
            const prompt = aiInput.value.trim();
            if (!prompt) {
                aiInput.focus();
                return;
            }

            aiProgress.classList.remove('hidden');

            // Show streaming status bar in the page
            aiStreamingBar.classList.remove('hidden');
            if (aiStreamingChars) aiStreamingChars.textContent = '0 chars';

            // Open SSE to server route that streams generated content
            const url = `{{ route('posts.ai') }}?message=` + encodeURIComponent(prompt);
            evtSource = new EventSource(url);
            keepStreaming = true;

            // Buffer to accumulate the full markdown response
            let markdownBuffer = '';

            evtSource.onmessage = function (e) {
                try {
                    const data = JSON.parse(e.data);
                    const delta = data?.delta || '';
                    markdownBuffer += delta;

                    // Update streaming status bar
                    if (aiStreamingChars) {
                        aiStreamingChars.textContent = markdownBuffer.length + ' chars';
                    }
                } catch (err) {
                    console.error('AI stream parse error', err);
                }
            };

            evtSource.addEventListener('close', function () {
                // Stream finished — convert accumulated Markdown → HTML and set in editor
                flushMarkdownToEditor(markdownBuffer);
                markdownBuffer = '';
                aiProgress.classList.add('hidden');
                if (evtSource) {
                    evtSource.close();
                    evtSource = null;
                }
            });

            evtSource.onerror = function (err) {
                // Also flush whatever we have on error/end
                if (markdownBuffer) {
                    flushMarkdownToEditor(markdownBuffer);
                    markdownBuffer = '';
                }
                aiProgress.classList.add('hidden');
                if (evtSource) {
                    evtSource.close();
                    evtSource = null;
                }
            };

            // Close modal but keep streaming in background (user can continue editing)
            closeModal();
        });
        // Clean up when leaving the page
        window.addEventListener('beforeunload', function () {
            if (evtSource) evtSource.close();
        });
    })();
</script>