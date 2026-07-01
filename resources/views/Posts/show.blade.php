<x-layout title="{{ $post->title }}">
    <x-slot:style>
        <style>
            .material-symbols-outlined {
                font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            }

            .article-column {
                max-width: 720px;
            }

            /* Custom Typography for Post Content (TinyMCE Output) */
            .post-content p {
                font-family: 'Source Serif 4', Georgia, serif;
                font-size: 1.25rem;
                /* 20px */
                line-height: 1.8;
                color: #1a1c1c;
                margin-bottom: 1.5rem;
            }

            .post-content h2 {
                font-family: 'Source Serif 4', Georgia, serif;
                font-size: 1.875rem;
                /* 30px */
                font-weight: 700;
                color: #1a1c1c;
                margin-top: 2.5rem;
                margin-bottom: 1rem;
                line-height: 1.3;
            }

            .post-content h3 {
                font-family: 'Inter', sans-serif;
                font-size: 1.5rem;
                /* 24px */
                font-weight: 600;
                color: #1a1c1c;
                margin-top: 2rem;
                margin-bottom: 0.75rem;
                line-height: 1.4;
            }

            .post-content ul {
                list-style-type: disc;
                padding-left: 1.5rem;
                margin-bottom: 1.5rem;
            }

            .post-content ul li {
                font-family: 'Source Serif 4', Georgia, serif;
                font-size: 1.125rem;
                line-height: 1.7;
                margin-bottom: 0.5rem;
                color: #1a1c1c;
            }

            .post-content ol {
                list-style-type: decimal;
                padding-left: 1.5rem;
                margin-bottom: 1.5rem;
            }

            .post-content ol li {
                font-family: 'Source Serif 4', Georgia, serif;
                font-size: 1.125rem;
                line-height: 1.7;
                margin-bottom: 0.5rem;
                color: #1a1c1c;
            }

            .post-content blockquote {
                border-left: 4px solid #630ed4;
                /* primary */
                padding-left: 1.5rem;
                font-style: italic;
                margin: 2rem 0;
                color: #4a4455;
            }

            .post-content blockquote p {
                font-size: 1.35rem;
                line-height: 1.6;
            }

            .post-content img {
                max-width: 100%;
                height: auto;
                border-radius: 0.75rem;
                margin: 2.5rem auto;
                display: block;
                border: 1px solid #ccc3d8;
            }

            .post-content strong {
                font-weight: 700;
                color: #000;
            }

            .post-content a {
                color: #630ed4;
                text-decoration: underline;
                font-weight: 500;
            }

            .post-content a:hover {
                color: #5a00c6;
            }
        </style>
    </x-slot:style>

    <div class="pt-6 md:pt-8 pb-section-gap px-gutter">
        <article class="mx-auto max-w-article-max">
            <!-- Headline -->
            <header class="mb-8">
                <!-- Category Tag -->
                <div class="mb-4">
                    <span
                        class="bg-primary-fixed text-on-primary-fixed px-3 py-1.5 rounded-full font-ui-label text-xs font-semibold tracking-wide uppercase">
                        {{ $post->category->name }}
                    </span>
                </div>

                <h1 class="font-display-lg text-display-lg mb-6 text-on-surface leading-tight">{{ $post->title }}</h1>

                <!-- Author Bio -->
                <div class="flex items-center justify-between py-5 border-y border-outline-variant">
                    <div class="flex items-center gap-4">
                        <img class="w-12 h-12 rounded-full border border-outline-variant object-cover"
                            alt="{{ $post->user->name }}"
                            src="https://ui-avatars.com/api/?name={{ urlencode($post->user->name) }}&background=eaddff&color=630ed4&bold=true" />
                        <div>
                            <div class="flex items-center gap-2">
                                <span
                                    class="font-ui-label text-ui-label font-bold text-on-surface">{{ $post->user->name }}</span>
                                <span class="text-secondary-fixed-dim">•</span>
                                <button
                                    class="text-primary font-ui-label text-ui-label font-semibold hover:underline">Follow</button>
                            </div>
                            <p class="font-metadata text-metadata text-secondary">
                                {{ $post->publish_time->format('M d, Y') }} · {{ $post->read_time }} min read ·
                                {{ $post->views }} {{ $post->views === 1 ? 'view' : 'views' }}
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex gap-2">
                        <x-contents.bookmark-button :post="$post" active-icon="bookmark" inactive-icon="bookmark"
                            class="material-symbols-outlined text-on-surface-variant hover:text-primary transition-colors" />

                        <!-- <button
                            class="material-symbols-outlined text-secondary hover:text-primary transition-colors p-2 rounded-full hover:bg-surface-container-high">share</button>
                        <button
                            class="material-symbols-outlined text-secondary hover:text-primary transition-colors p-2 rounded-full hover:bg-surface-container-high">more_horiz</button> -->
                    </div>
                </div>
            </header>

            <!-- Cover Image Banner -->
            @if ($post->cover_image)
                <div
                    class="mb-10 rounded-xl overflow-hidden aspect-[16/9] w-full border border-outline-variant/30 shadow-sm">
                    <img src="{{ $post->cover_image }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                </div>
            @endif

            <!-- Content -->
            <div class="post-content mb-12">
                {!! $post->content !!}
            </div>

            <!-- Comments Section -->
            <section class="mt-16 border-t border-outline-variant pt-10" id="comments-section">
                <h3 class="font-headline-md text-headline-md text-on-surface mb-6">
                    Comments (<span id="comments-count">{{ $post->comments()->count() }}</span>)
                </h3>

                <!-- Comment Form -->
                @auth
                    <form action="{{ route('posts.comments.store', $post) }}" method="POST" class="mb-8" id="comment-form">
                        @csrf
                        <div class="mb-4">
                            <label for="comment-content" class="sr-only">Add a comment</label>
                            <textarea id="comment-content" name="content" rows="4" required
                                class="w-full px-4 py-3 rounded-xl border border-outline-variant focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent bg-surface-container-lowest text-on-surface text-body-md resize-none transition-all placeholder:text-secondary"
                                placeholder="Share your thoughts..."></textarea>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit"
                                class="px-6 py-2.5 bg-primary text-on-primary font-ui-button text-ui-button rounded-xl hover:bg-primary-fixed-variant transition-colors shadow-sm cursor-pointer">
                                Post Comment
                            </button>
                        </div>
                    </form>
                @else
                    <div class="mb-8 p-6 bg-surface-container rounded-xl border border-outline-variant/60 text-center">
                        <p class="text-on-surface-variant font-medium mb-3">You must be logged in to leave a comment.</p>
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-5 py-2 bg-primary text-on-primary font-ui-button text-ui-button rounded-lg hover:opacity-90 transition-all">
                            Log In
                        </a>
                    </div>
                @endauth

                <!-- Comments List -->
                <div class="space-y-6" id="comments-list">
                    @forelse($post->comments()->with('user')->latest()->get() as $comment)
                        <div class="flex gap-4 p-4 bg-surface-container-low rounded-xl border border-outline-variant/30 comment-item" data-comment-id="{{ $comment->id }}">
                            <img class="w-10 h-10 rounded-full border border-outline-variant object-cover shrink-0"
                                alt="{{ $comment->user_name }}"
                                src="{{ $comment->user ? 'https://ui-avatars.com/api/?name=' . urlencode($comment->user->name) . '&background=eaddff&color=630ed4&bold=true' : 'https://ui-avatars.com/api/?name=' . urlencode($comment->user_name) . '&background=e2dfde&color=5f5e5e&bold=true' }}" />
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-1">
                                    <span class="font-ui-label text-ui-label font-bold text-on-surface">{{ $comment->user_name }}</span>
                                    <span class="font-metadata text-metadata text-secondary">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-on-surface-variant text-body-md font-body-md whitespace-pre-line">{{ $comment->content }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-secondary font-medium py-8 text-center" id="no-comments-message">No comments yet. Be the first to share your thoughts!</p>
                    @endforelse
                </div>
            </section>
        </article>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const postId = "{{ $post->id }}";
            const commentsList = document.getElementById('comments-list');
            const commentsCount = document.getElementById('comments-count');
            const noCommentsMessage = document.getElementById('no-comments-message');

            if (window.Echo) {
                window.Echo.channel(`posts.${postId}.comments`)
                    .listen('.comment.created', (e) => {
                        // Check if comment already exists to avoid duplication
                        if (document.querySelector(`[data-comment-id="${e.id}"]`)) {
                            return;
                        }

                        // Remove "no comments" message if it exists
                        if (noCommentsMessage) {
                            noCommentsMessage.remove();
                        }

                        // Create the comment HTML
                        const commentElement = document.createElement('div');
                        commentElement.className = 'flex gap-4 p-4 bg-surface-container-low rounded-xl border border-outline-variant/30 comment-item opacity-0 transform -translate-y-4 transition-all duration-500 ease-out';
                        commentElement.setAttribute('data-comment-id', e.id);

                        const avatarUrl = e.user 
                            ? `https://ui-avatars.com/api/?name=${encodeURIComponent(e.user.name)}&background=eaddff&color=630ed4&bold=true`
                            : `https://ui-avatars.com/api/?name=${encodeURIComponent(e.user_name)}&background=e2dfde&color=5f5e5e&bold=true`;

                        commentElement.innerHTML = `
                            <img class="w-10 h-10 rounded-full border border-outline-variant object-cover shrink-0"
                                alt="${e.user_name}"
                                src="${avatarUrl}" />
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-1">
                                    <span class="font-ui-label text-ui-label font-bold text-on-surface">${e.user_name}</span>
                                    <span class="font-metadata text-metadata text-secondary">${e.created_at}</span>
                                </div>
                                <p class="text-on-surface-variant text-body-md font-body-md whitespace-pre-line">${e.content}</p>
                            </div>
                        `;

                        // Prepend the new comment
                        commentsList.insertBefore(commentElement, commentsList.firstChild);

                        // Trigger animation
                        setTimeout(() => {
                            commentElement.classList.remove('opacity-0', '-translate-y-4');
                        }, 50);

                        // Update comments count
                        if (commentsCount) {
                            const count = parseInt(commentsCount.textContent) || 0;
                            commentsCount.textContent = count + 1;
                        }
                    });
            }
        });
    </script>

    <!-- Floating Engagement Bar
    <div class="fixed bottom-10 left-1/2 -translate-x-1/2 z-40">
        <div
            class="flex items-center gap-6 px-6 py-3 bg-white/90 backdrop-blur-md rounded-full border border-outline-variant/60 shadow-[0_20px_40px_rgba(0,0,0,0.08)]">
            <div class="flex items-center gap-2 group cursor-pointer">
                <span
                    class="material-symbols-outlined text-on-surface-variant group-hover:text-primary transition-colors">favorite</span>
                <span class="font-ui-label text-ui-label text-secondary group-hover:text-primary">1.2k</span>
            </div>
            <div class="w-px h-6 bg-outline-variant"></div>
            <div class="flex items-center gap-2 group cursor-pointer">
                <span
                    class="material-symbols-outlined text-on-surface-variant group-hover:text-primary transition-colors">chat_bubble</span>
                <span class="font-ui-label text-ui-label text-secondary group-hover:text-primary">84</span>
            </div>
            <div class="w-px h-6 bg-outline-variant"></div>
           <button
                class="material-symbols-outlined text-on-surface-variant hover:text-primary transition-colors">ios_share</button>
        </div>
    </div> -->
</x-layout>