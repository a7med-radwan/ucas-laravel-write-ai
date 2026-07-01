@props([
    'post',
    'activeIcon' => 'bookmark',
    'inactiveIcon' => 'bookmark_add',
    'class' => 'text-primary p-2 rounded-full hover:bg-primary-fixed/30 transition-colors'
])

@php
    $isBookmarked = auth()->check() && $post->isBookmarkedBy(auth()->user());
    $icon = $isBookmarked ? $activeIcon : $inactiveIcon;
    $isOutlined = str_contains($class, 'material-symbols-outlined');
@endphp

@auth
    <form action="{{ $isBookmarked ? route('posts.unbookmark', $post) : route('posts.bookmark', $post) }}" method="POST" class="inline-flex items-center">
        @csrf
        @if($isBookmarked)
            @method('DELETE')
        @endif
        <button type="submit" class="{{ $class }} flex items-center justify-center cursor-pointer" 
                @if($isBookmarked) style="font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;" @endif 
                title="{{ $isBookmarked ? 'Remove bookmark' : 'Bookmark this article' }}">
            @if($isOutlined)
                {{ $icon }}
            @else
                <span class="material-symbols-outlined" @if($isBookmarked) style="font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;" @endif>{{ $icon }}</span>
            @endif
        </button>
    </form>
@else
    <a href="{{ route('login') }}" class="{{ $class }} inline-flex items-center justify-center cursor-pointer" title="Login to bookmark this article">
        @if($isOutlined)
            {{ $icon }}
        @else
            <span class="material-symbols-outlined">{{ $icon }}</span>
        @endif
    </a>
@endauth
