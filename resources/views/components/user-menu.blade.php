@props(['variant' => 'sidebar'])

@auth('web')
    @if ($variant === 'compact')
        <div class="flex items-center gap-1">
            <div class="w-8 h-8 rounded-full overflow-hidden border border-outline-variant shrink-0 bg-primary-fixed">
                <img alt="{{ $user->name }}" class="w-full h-full object-cover"
                    src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=eaddff&color=630ed4&bold=true" />
            </div>
            <a href="{{ route('logout') }}"
                class="p-2 text-on-surface-variant hover:text-error rounded-lg transition-all"
                title="Sign out"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <span class="material-symbols-outlined text-[20px]">logout</span>
            </a>
        </div>
    @else
        <div class="flex items-center gap-2.5 min-w-0 p-1.5 rounded-lg hover:bg-surface-container transition-colors">
            <div class="w-8 h-8 rounded-full overflow-hidden border border-outline-variant shrink-0 bg-primary-fixed">
                <img alt="{{ $user->name }}" class="w-full h-full object-cover"
                    src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=eaddff&color=630ed4&bold=true" />
            </div>
            <div class="min-w-0 flex-1">
                <p class="font-ui-label text-ui-label font-bold text-on-surface truncate text-sm leading-tight">{{ $user->name }}</p>
                <p class="font-metadata text-metadata text-on-surface-variant truncate text-[11px]">{{ $user->email }}</p>
            </div>
            <a href="{{ route('logout') }}"
                class="shrink-0 p-1.5 text-on-surface-variant hover:text-error hover:bg-error-container rounded-lg transition-all"
                title="Sign out"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <span class="material-symbols-outlined text-[18px]">logout</span>
            </a>
        </div>
    @endif
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>
@else
    <a href="{{ route('login') }}"
        class="inline-flex items-center justify-center gap-2 w-full bg-primary text-on-primary px-4 py-2 rounded-lg font-ui-button text-ui-button text-sm hover:opacity-90 transition-all">
        <span class="material-symbols-outlined text-[18px]">login</span>
        Sign In
    </a>
@endauth
