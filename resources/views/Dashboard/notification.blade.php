<x-layout title="Notifications">
    <div class="pt-8 pb-section-gap px-gutter max-w-4xl mx-auto">
        <!-- Header -->
        <header class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div class="max-w-2xl">
                <h1 class="font-display-lg-mobile text-[24px] font-bold text-on-surface truncate">Notifications</h1>
                <p class="font-body-md text-sm text-on-surface-variant mt-1">Stay updated with your latest interactions and community activity.</p>
            </div>
            
            @if ($notifications->total() > 0)
                <form action="{{ route('dashboard.notifications.mark-all-read') }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit"
                        class="font-ui-label text-ui-label text-primary hover:underline underline-offset-4 flex items-center gap-1.5 transition-all text-sm font-semibold">
                        <span class="material-symbols-outlined text-[18px]">done_all</span>
                        Mark all as read
                    </button>
                </form>
            @endif
        </header>

        @if (session()->has('status'))
            <div class="mb-6 p-4 bg-green-50 text-green-800 rounded-xl border border-green-200 flex items-center gap-3">
                <span class="material-symbols-outlined text-green-600">check_circle</span>
                <span class="font-ui-label text-ui-label">{{ session('status') }}</span>
            </div>
        @endif

        @php
            $groupedNotifications = $notifications->getCollection()->groupBy(function($notification) {
                $date = $notification->created_at;
                if ($date->isToday()) {
                    return 'Today';
                } elseif ($date->isYesterday()) {
                    return 'Yesterday';
                } else {
                    return $date->format('F d, Y');
                }
            });
        @endphp

        <!-- Notification Groups -->
        <div class="space-y-8">
            @forelse ($groupedNotifications as $groupName => $group)
                <section class="space-y-3">
                    <h2 class="font-ui-label text-xs font-bold text-secondary uppercase tracking-wider px-1">{{ $groupName }}</h2>
                    <div class="space-y-3">
                        @foreach ($group as $notification)
                            @php
                                $isFollow = ($notification->data['title'] ?? '') === 'New follower';
                                $iconName = $isFollow ? 'person_add' : 'notifications';
                                $iconColorClass = $isFollow ? 'bg-primary/10 text-primary' : 'bg-secondary/10 text-secondary';
                                
                                $followerName = str_replace(' started following you.', '', $notification->data['body'] ?? 'Someone');
                                $followerAvatar = !empty($notification->data['meta']['follower_avatar']) 
                                    ? '/storage/' . $notification->data['meta']['follower_avatar'] 
                                    : 'https://ui-avatars.com/api/?name=' . urlencode($followerName) . '&background=eaddff&color=630ed4&bold=true';
                                $link = $notification->data['link'] ?? '#';
                            @endphp
                            <div onclick="location.href='{{ $link }}'"
                                class="group relative flex items-center gap-4 p-4 rounded-xl border transition-all cursor-pointer shadow-sm
                                {{ $notification->unread() ? 'border-primary/25 bg-primary/5 hover:bg-primary/10' : 'border-outline-variant bg-surface-container-low hover:bg-surface-container-lowest' }}">
                                
                                <!-- Left side: Avatar + Icon -->
                                <div class="relative shrink-0">
                                    <div class="w-12 h-12 rounded-full overflow-hidden border border-outline-variant bg-surface-container-high shadow-sm">
                                        <img alt="{{ $followerName }}" class="w-full h-full object-cover animate-fade-in" src="{{ $followerAvatar }}" />
                                    </div>
                                    <div class="absolute -bottom-1 -right-1 w-5.5 h-5.5 bg-surface-container-lowest rounded-full flex items-center justify-center shadow-md border border-outline-variant">
                                        <span class="material-symbols-outlined text-[12px] {{ $iconColorClass }} font-bold">{{ $iconName }}</span>
                                    </div>
                                </div>
                                
                                <!-- Middle side: Body + Date -->
                                <div class="flex-1 min-w-0">
                                    <p class="font-body-md text-sm text-on-surface leading-snug font-medium">
                                        {{ $notification->data['body'] }}
                                    </p>
                                    <span class="font-metadata text-[11px] text-on-surface-variant/80 mt-1 block">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </span>
                                </div>
                                
                                <!-- Right side: Actions -->
                                <div class="shrink-0 flex items-center gap-2">
                                    @if ($notification->unread())
                                        <!-- Unread Dot -->
                                        <div class="w-2 h-2 bg-primary rounded-full shrink-0 mr-1" title="Unread"></div>
                                    @endif

                                    <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                        <!-- Toggle Read/Unread Status -->
                                        @if ($notification->unread())
                                            <form action="{{ route('dashboard.notifications.read', $notification->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" onclick="event.stopPropagation();" 
                                                    class="p-1.5 hover:bg-surface-container-high hover:text-primary rounded-lg text-on-surface-variant transition-colors" 
                                                    title="Mark as read">
                                                    <span class="material-symbols-outlined text-[18px]">drafts</span>
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('dashboard.notifications.unread', $notification->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" onclick="event.stopPropagation();" 
                                                    class="p-1.5 hover:bg-surface-container-high hover:text-primary rounded-lg text-on-surface-variant transition-colors" 
                                                    title="Mark as unread">
                                                    <span class="material-symbols-outlined text-[18px]">mail</span>
                                                </button>
                                            </form>
                                        @endif
                                        
                                        <!-- Delete notification -->
                                        <form action="{{ route('dashboard.notifications.destroy', $notification->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="event.stopPropagation();" 
                                                class="p-1.5 hover:bg-error-container hover:text-error rounded-lg text-on-surface-variant transition-colors" 
                                                title="Delete notification">
                                                <span class="material-symbols-outlined text-[18px]">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @empty
                <div class="text-center py-20 bg-surface-container-lowest rounded-2xl border border-outline-variant border-dashed">
                    <span class="material-symbols-outlined text-secondary text-5xl mb-3" style="font-variation-settings: 'wght' 300;">notifications_off</span>
                    <h3 class="font-headline-md text-lg text-on-surface font-bold">No notifications yet</h3>
                    <p class="font-metadata text-metadata text-secondary mt-1">We will notify you when you receive new followers or interactions.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination Links -->
        @if ($notifications->hasPages())
            <div class="mt-8 border-t border-outline-variant pt-6">
                {{ $notifications->links() }}
            </div>
        @endif
    </div>
</x-layout>