<x-layout title="Notifications">
    <div class="pt-8 pb-section-gap px-gutter max-w-container-max mx-auto">
        <header class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
            <div class="max-w-2xl">
                <h1 class="font-display-lg text-display-lg-mobile sm:text-display-lg text-on-surface mb-1.5">Notifications</h1>
                <p class="font-body-md text-on-surface-variant">Stay updated with your latest interactions and community activity.</p>
            </div>
            <form action="{{ route('dashboard.notifications.mark-all-read') }}" method="post">
                @csrf
                @method('patch')
                <button type="submit"
                    class="font-ui-label text-ui-label text-primary hover:underline underline-offset-4 flex items-center gap-2">
                    Mark all as read
                </button>
            </form>
        </header>
        <!-- Filter Tabs -->
        <div class="flex items-center gap-6 border-b border-outline-variant mb-10 overflow-x-auto no-scrollbar">
            <button
                class="font-ui-label text-ui-label pb-4 border-b-2 border-primary text-primary font-bold whitespace-nowrap">
                All
            </button>
            <button
                class="font-ui-label text-ui-label pb-4 text-secondary hover:text-on-surface transition-colors whitespace-nowrap">
                Responses
            </button>
            <button
                class="font-ui-label text-ui-label pb-4 text-secondary hover:text-on-surface transition-colors whitespace-nowrap">
                Mentions
            </button>
            <button
                class="font-ui-label text-ui-label pb-4 text-secondary hover:text-on-surface transition-colors whitespace-nowrap">
                Stats
            </button>
        </div>
        <!-- Notification Groups -->
        <div class="space-y-12">
            <!-- Today -->
            <section>
                <h2 class="font-ui-label text-ui-label text-secondary uppercase tracking-widest mb-6">Today</h2>
                <div class="space-y-0.5">
                    @foreach ($notifications as $notification)
                        <div
                            class="group relative flex items-start gap-4 p-4 -mx-4 rounded-lg hover:bg-surface-container-lowest transition-all cursor-pointer">
                            <div class="relative">
                                <img alt="User avatar" class="w-10 h-10 rounded-full object-cover"
                                    data-alt="A sharp, detailed portrait of a female content creator with an expressive and friendly gaze. She is in a bright, airy office space with soft daylight illuminating her face. The style is modern, editorial, and sophisticated, using a clean color palette of whites and soft grays to match a minimalist UI."
                                    src="{{ $notification->data['meta']['follower_avatar'] ?? '' }}" />
                                <div
                                    class="absolute -bottom-1 -right-1 w-5 h-5 bg-white rounded-full flex items-center justify-center shadow-sm">
                                    <span class="material-symbols-outlined text-[14px] text-primary"
                                        data-icon="favorite" style="font-variation-settings: 'FILL' 1;">favorite</span>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-body-md text-on-surface leading-tight">
                                    {{ $notification->data['body'] }}
                                </p>
                                <span
                                    class="font-metadata text-metadata text-secondary mt-1 block">{{ $notification->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="pt-2">
                                @if ($notification->unread())
                                    <div class="active-dot"></div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
        <!-- Loading Indicator / End of feed -->
        <div class="mt-16 flex flex-col items-center justify-center py-8 border-t border-outline-variant border-dashed">
            <span class="material-symbols-outlined text-secondary mb-2" data-icon="history_edu">history_edu</span>
            <p class="font-metadata text-metadata text-secondary">You're all caught up for the week.</p>
        </div>
    </div>
</x-layout>
