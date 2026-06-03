<x-slot:head-scripts>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.2.1/tinymce.min.js"
        referrerpolicy="origin" crossorigin="anonymous"></script>
</x-slot:head-scripts>

<form action="{{ $action ?? route('dashboard.posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method($method ?? 'POST')

    <main class="pt-24 pb-32 flex flex-col md:flex-row max-w-container-max mx-auto px-gutter gap-12">

        <!-- Editor Canvas -->
        <div class="flex-1 max-w-article-max mx-auto w-full distraction-free-focus">
            <div class="editor-container">
                @if ($errors->any())
                    <div class="text-red-800 mb-4 border border-red-900 bg-red-300">
                        @foreach ($errors->all() as $message)
                            <p>{{ $message }}</p>
                        @endforeach
                    </div>
                @endif
                <!-- Title Field -->
                <input type="text" name="title" value="{{ old('title', $post->title) }}"
                    class="w-full bg-transparent border-none focus:ring-0 font-display-lg text-display-lg resize-none placeholder:text-surface-variant text-on-surface mb-8 overflow-hidden"
                    placeholder="Enter your title...">
                @error('title')
                    <p class="text-red-800">{{ $message }}</p>
                @enderror
                <!-- Floating Toolbar (Contextual) -->
                {{--
                <div class="sticky top-20 z-40 flex justify-center mb-12">
                    <div
                        class="bg-inverse-surface text-inverse-on-surface px-2 py-1.5 rounded-xl shadow-xl flex items-center gap-1 border border-outline/20">
                        <button class="p-2 hover:bg-white/10 rounded-lg transition-colors" title="Bold">
                            <span class="material-symbols-outlined">format_bold</span>
                        </button>
                        <button class="p-2 hover:bg-white/10 rounded-lg transition-colors" title="Italic">
                            <span class="material-symbols-outlined">format_italic</span>
                        </button>
                        <div class="w-px h-6 bg-white/10 mx-1"></div>
                        <button class="p-2 hover:bg-white/10 rounded-lg transition-colors" title="Heading 1">
                            <span class="material-symbols-outlined">format_h1</span>
                        </button>
                        <button class="p-2 hover:bg-white/10 rounded-lg transition-colors" title="Heading 2">
                            <span class="material-symbols-outlined">format_h2</span>
                        </button>
                        <div class="w-px h-6 bg-white/10 mx-1"></div>
                        <button class="p-2 hover:bg-white/10 rounded-lg transition-colors" title="Quote">
                            <span class="material-symbols-outlined">format_quote</span>
                        </button>
                        <button class="p-2 hover:bg-white/10 rounded-lg transition-colors" title="Link">
                            <span class="material-symbols-outlined">link</span>
                        </button>
                        <div class="w-px h-6 bg-white/10 mx-1"></div>
                        <button class="p-2 hover:bg-white/10 rounded-lg transition-colors" title="Image">
                            <span class="material-symbols-outlined">image</span>
                        </button>
                    </div>
                </div>
                <!-- Main Content Editor -->
                <div class="w-full min-h-[614px] bg-transparent border-none focus:outline-none font-body-lg text-body-lg text-on-surface leading-relaxed placeholder:text-surface-variant"
                    contenteditable="true" data-placeholder="Type your story...">
                    <p class="mb-6">It began as a simple thought—a flicker of ink on a pristine digital canvas. The
                        rhythm of the keys creates a cadence, a quiet symphony of creation that exists only between the
                        writer and the paper.</p>
                    <p class="mb-6">In this space, distraction falls away. The borders of the interface recede, leaving
                        only the words. We prioritize clarity above all else, ensuring that every sentence has room to
                        breathe and every idea has the weight it deserves.</p>
                </div>
                --}}
                <textarea name="content" id="content"
                    class="w-full bg-transparent border-none focus:ring-0 font-body-lg text-body-lg text-on-surface leading-relaxed placeholder:text-surface-variant"
                    data-placeholder="Type your story..."
                    oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'>{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <p class="text-red-800">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit"
                class="bg-primary text-on-primary px-6 py-3 rounded-lg font-ui-label text-ui-label hover:bg-primary-hover transition-colors">
                Publish
            </button>
        </div>
        <!-- Sidebar: Publishing Settings -->
        <aside
            class="hidden lg:block w-80 shrink-0 h-fit sticky top-24 sidebar-overlay transition-opacity duration-500">
            <div class="space-y-8 border-l border-outline-variant pl-8">
                <!-- Cover Image -->
                <section>
                    <h3 class="font-ui-label text-ui-label text-on-surface mb-4 uppercase tracking-wider">Cover
                        Image
                    </h3>
                    @if ($post->cover_image)
                        <div class="aspect-video w-full rounded-lg bg-cover bg-center mb-4"
                            style="background-image: url('{{ asset('storage/' . $post->cover_image) }}')"></div>
                    @else
                        <div
                            class="aspect-video w-full rounded-lg bg-surface-container border-2 border-dashed border-outline-variant flex flex-col items-center justify-center gap-2 cursor-pointer hover:bg-surface-container-high transition-colors group">
                            <span
                                class="material-symbols-outlined text-secondary group-hover:text-primary transition-colors">add_a_photo</span>
                            <span class="font-metadata text-metadata text-secondary">Upload high-res photo</span>
                        </div>
                    @endif
                    <input type="file" name="cover" accept="image/*" />
                    @error('cover')
                        @foreach ($errors->get('cover') as $error)
                            <p class="text-red-800">{{ $error }}</p>
                        @endforeach
                    @enderror
                </section>

                <!-- Categories -->
                <section>
                    <h3 class="font-ui-label text-ui-label text-on-surface mb-4 uppercase tracking-wider">Categories
                    </h3>
                    <select name="category_id" id=""
                        class="w-full bg-white border border-outline-variant rounded-lg px-4 py-2 font-metadata text-metadata focus:ring-1 focus:ring-primary focus:border-primary transition-all">
                        <option>Select category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @if ($post->category_id == $category->id) selected @endif>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </section>

                <!-- Tags -->
                <section>
                    <h3 class="font-ui-label text-ui-label text-on-surface mb-4 uppercase tracking-wider">Tags</h3>
                    <div class="flex flex-wrap gap-2 mb-3">
                        @foreach ($post->tags as $tag)
                            <span
                                class="bg-primary-fixed text-on-primary-fixed px-3 py-1 rounded-full font-metadata text-metadata flex items-center gap-1">
                                {{ $tag->name }} <span
                                    class="material-symbols-outlined text-[14px] cursor-pointer">close</span>
                            </span>
                        @endforeach
                    </div>
                    <input name="tags" value="{{ old('tags') }}"
                        class="w-full bg-white border border-outline-variant rounded-lg px-4 py-2 font-metadata text-metadata focus:ring-1 focus:ring-primary focus:border-primary transition-all"
                        placeholder="Add tag..." type="text" />
                </section>
                <!-- SEO Preview -->
                <section>
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-ui-label text-ui-label text-on-surface uppercase tracking-wider">SEO Preview
                        </h3>
                        <button class="text-primary font-metadata text-metadata hover:underline">Edit</button>
                    </div>
                    <div class="p-4 bg-white border border-outline-variant rounded-lg shadow-sm">
                        <div class="text-[#1a0dab] font-sans text-[18px] leading-tight mb-1 truncate">The Art of
                            Digital
                            Quiet | Ink &amp; Paper</div>
                        <div class="text-[#006621] font-sans text-[14px] mb-1 truncate">inkandpaper.com/art-of-quiet
                        </div>
                        <p class="text-secondary font-sans text-[13px] line-clamp-2">Discover how a distraction-free
                            writing environment can transform your creative process and help you find your voice in
                            a
                            noisy world...</p>
                    </div>
                </section>
                <!-- Visibility -->
                <section class="pt-4 border-t border-outline-variant">
                    <label class="flex items-center justify-between cursor-pointer group">
                        <span
                            class="font-ui-label text-ui-label text-secondary group-hover:text-on-surface transition-colors">Public
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

    </main>
</form>
<script>
    tinymce.init({
        selector: '#content',
        plugins: [
            'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount', 'image'
        ],
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        branding: false,
        promotion: false
    });
</script>