<!DOCTYPE html>

<html class="light h-full" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>{{ $title }}</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=Source+Serif+4:wght@400;600;700&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />

    <script>
        const USER_ID = "{{ auth()->id() }}"
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-error-container": "#93000a",
                        "on-primary": "#ffffff",
                        "inverse-on-surface": "#f1f1f1",
                        "tertiary-container": "#a15100",
                        "outline": "#7b7487",
                        "tertiary-fixed-dim": "#ffb784",
                        "on-secondary-fixed-variant": "#474746",
                        "on-primary-fixed": "#25005a",
                        "inverse-primary": "#d2bbff",
                        "surface-variant": "#e2e2e2",
                        "on-tertiary-fixed-variant": "#713700",
                        "outline-variant": "#ccc3d8",
                        "secondary-fixed": "#e5e2e1",
                        "on-secondary": "#ffffff",
                        "on-surface-variant": "#4a4455",
                        "primary": "#630ed4",
                        "secondary": "#5f5e5e",
                        "on-secondary-fixed": "#1c1b1b",
                        "on-primary-fixed-variant": "#5a00c6",
                        "surface-container-lowest": "#ffffff",
                        "surface-tint": "#732ee4",
                        "surface-container-low": "#f3f3f3",
                        "on-primary-container": "#ede0ff",
                        "secondary-fixed-dim": "#c8c6c5",
                        "surface": "#f9f9f9",
                        "error": "#ba1a1a",
                        "inverse-surface": "#2f3131",
                        "tertiary": "#7d3d00",
                        "surface-container": "#eeeeee",
                        "surface-bright": "#f9f9f9",
                        "on-tertiary-container": "#ffe0cd",
                        "secondary-container": "#e2dfde",
                        "surface-container-high": "#e8e8e8",
                        "on-background": "#1a1c1c",
                        "on-surface": "#1a1c1c",
                        "primary-fixed-dim": "#d2bbff",
                        "primary-fixed": "#eaddff",
                        "surface-container-highest": "#e2e2e2",
                        "surface-dim": "#dadada",
                        "error-container": "#ffdad6",
                        "on-tertiary": "#ffffff",
                        "on-error": "#ffffff",
                        "tertiary-fixed": "#ffdcc6",
                        "on-secondary-container": "#636262",
                        "background": "#f9f9f9",
                        "primary-container": "#7c3aed",
                        "on-tertiary-fixed": "#301400"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "margin-mobile": "1rem",
                        "container-max": "1200px",
                        "gutter": "1.5rem",
                        "article-max": "720px",
                        "section-gap": "4rem",
                        "sidebar": "260px"
                    },
                    "fontFamily": {
                        "body-lg": ["Source Serif 4"],
                        "ui-button": ["Inter"],
                        "display-lg": ["Source Serif 4"],
                        "headline-md": ["Source Serif 4"],
                        "body-md": ["Source Serif 4"],
                        "display-lg-mobile": ["Source Serif 4"],
                        "metadata": ["Inter"],
                        "ui-label": ["Inter"]
                    },
                    "fontSize": {
                        "body-lg": ["20px", { "lineHeight": "1.6", "fontWeight": "400" }],
                        "ui-button": ["16px", { "lineHeight": "1", "letterSpacing": "0.02em", "fontWeight": "600" }],
                        "display-lg": ["48px", { "lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                        "headline-md": ["32px", { "lineHeight": "1.3", "fontWeight": "600" }],
                        "body-md": ["18px", { "lineHeight": "1.6", "fontWeight": "400" }],
                        "display-lg-mobile": ["32px", { "lineHeight": "1.2", "fontWeight": "700" }],
                        "metadata": ["12px", { "lineHeight": "1.4", "fontWeight": "400" }],
                        "ui-label": ["14px", { "lineHeight": "1.4", "letterSpacing": "0.01em", "fontWeight": "500" }]
                    }
                },
            },
        }
    </script>
    {{ $style ?? '' }}
    {{ $headScripts ?? '' }}
</head>

<body
    class="font-body-md text-body-md selection:bg-primary-fixed selection:text-on-primary-fixed bg-surface min-h-dvh {{ $mainClass ?? '' }}">

    <!-- Sidebar (fixed — does not affect page scroll) -->
    <aside
        class="app-sidebar hidden md:flex fixed inset-y-0 left-0 z-40 w-sidebar flex-col bg-surface-container-lowest border-r border-outline-variant">
        <div class="h-16 shrink-0 flex items-center px-5 border-b border-outline-variant">
            <a class="font-display-lg-mobile text-[22px] font-bold text-on-surface truncate" href="{{ route('home') }}">
                {{ config('app.name') }}
            </a>
        </div>

        <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-5">
            <div class="space-y-0.5">
                <span
                    class="px-3 py-1 text-[11px] font-bold uppercase tracking-widest text-outline block">Discover</span>
                <a href="{{ route('home') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->routeIs('home') ? 'bg-primary-fixed text-on-primary-fixed font-bold' : 'text-on-surface-variant font-medium hover:bg-surface-container hover:text-on-surface' }}">
                    <span class="material-symbols-outlined text-[22px]">home</span>
                    Home
                </a>
                <!-- <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-on-surface-variant font-medium hover:bg-surface-container hover:text-on-surface transition-colors">
                    <span class="material-symbols-outlined text-[22px]">dynamic_feed</span>
                    Feed
                </a>
                @can('view-any', App\Models\User::class)
                    <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-on-surface-variant font-medium hover:bg-surface-container hover:text-on-surface transition-colors">
                        <span class="material-symbols-outlined text-[22px]">group</span>
                        Authors
                    </a>
                @endcan -->
            </div>

            @auth
                <div class="space-y-0.5">
                    <span
                        class="px-3 py-1 text-[11px] font-bold uppercase tracking-widest text-outline block">Workspace</span>
                    <a href="{{ route('dashboard.posts.index') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->routeIs('dashboard.posts.*') ? 'bg-primary-fixed text-on-primary-fixed font-bold' : 'text-on-surface-variant font-medium hover:bg-surface-container hover:text-on-surface' }}">
                        <span class="material-symbols-outlined text-[22px]">article</span>
                        Posts

                    </a>
                    @if (in_array(auth()->user()->type, ['admin', 'super-admin']))
                        <a href="{{ route('dashboard.categories.index') }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->routeIs('dashboard.categories.*') ? 'bg-primary-fixed text-on-primary-fixed font-bold' : 'text-on-surface-variant font-medium hover:bg-surface-container hover:text-on-surface' }}">
                            <span class="material-symbols-outlined text-[22px]">category</span>
                            Categories
                        </a>
                    @endif
                    <a href="{{ route('dashboard.notifications.index') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->routeIs('dashboard.notifications.*') ? 'bg-primary-fixed text-on-primary-fixed font-bold' : 'text-on-surface-variant font-medium hover:bg-surface-container hover:text-on-surface' }}">
                        <span class="material-symbols-outlined text-[22px]">notifications</span>
                        Notifications
                        <span id="desktop-notification-badge"
                            class="ml-auto inline-flex items-center justify-center bg-primary text-on-primary text-[10px] font-bold rounded-full min-w-[18px] h-[18px] px-1 {{ auth()->user()->unreadNotifications()->count() ? '' : 'hidden' }}">
                            {{ auth()->user()->unreadNotifications()->count() }}
                        </span>
                    </a>
                    <a href="{{ route('dashboard.profile') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->routeIs('dashboard.profile') ? 'bg-primary-fixed text-on-primary-fixed font-bold' : 'text-on-surface-variant font-medium hover:bg-surface-container hover:text-on-surface' }}">
                        <span class="material-symbols-outlined text-[22px]">person</span>
                        Profile Settings
                    </a>
                </div>

                @can('users.view')
                    <div class="space-y-0.5 pt-3 border-t border-outline-variant/60">

                        <span
                            class="px-3 py-1 text-[11px] font-bold uppercase tracking-widest text-outline block">Administration</span>
                        <a href="{{ route('admin.users.index') }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-primary-fixed text-on-primary-fixed font-bold' : 'text-on-surface-variant font-medium hover:bg-surface-container hover:text-on-surface' }}">
                            <span class="material-symbols-outlined text-[22px]">manage_accounts</span>
                            Users
                        </a>
                @endcan
                    @if (auth()->user()->type == 'super-admin')
                        <a href="{{ route('admin.roles.index') }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.roles.*') ? 'bg-primary-fixed text-on-primary-fixed font-bold' : 'text-on-surface-variant font-medium hover:bg-surface-container hover:text-on-surface' }}">
                            <span class="material-symbols-outlined text-[22px]">admin_panel_settings</span>
                            Roles
                        </a>
                    @endif
                </div>
                <a href="{{ route('dashboard.posts.create') }}"
                    class="flex items-center justify-center gap-2 mx-1 mt-2 px-4 py-2.5 rounded-lg bg-primary text-on-primary font-ui-button text-ui-button shadow-sm hover:opacity-90 transition-all">
                    <span class="material-symbols-outlined text-[20px]">add</span>
                    Create Post
                </a>
            @endauth
        </nav>

        <div class="shrink-0 p-3 border-t border-outline-variant space-y-2">
            <x-user-menu variant="sidebar" />
        </div>
    </aside>

    <!-- Page content (natural browser scroll) -->
    <div class="app-content md:pl-sidebar min-h-dvh flex flex-col">
        <header
            class="md:hidden sticky top-0 z-30 h-14 flex items-center justify-between px-4 border-b border-outline-variant bg-surface-container-lowest/95 backdrop-blur-sm">
            <a class="font-display-lg-mobile text-[20px] font-bold text-on-surface truncate" href="{{ route('home') }}">
                {{ config('app.name') }}
            </a>
            <div class="flex items-center gap-0.5">
                @auth
                    <a href="{{ route('dashboard.notifications.index') }}"
                        class="relative p-2 text-on-surface-variant rounded-lg">
                        <span class="material-symbols-outlined text-[22px]">notifications</span>
                        <span id="mobile-notification-badge"
                            class="absolute top-1.5 right-1.5 w-2 h-2 bg-primary rounded-full {{ auth()->user()->unreadNotifications()->count() ? '' : 'hidden' }}"></span>
                    </a>
                @endauth
                <x-user-menu variant="compact" />
            </div>
        </header>

        <main class="flex-1 w-full max-w-full">
            {{ $slot }}

            @unless (request()->routeIs('dashboard.*', 'admin.*'))
                <footer class="bg-surface border-t border-outline-variant mt-16">
                    <div
                        class="w-full py-10 px-gutter max-w-container-max mx-auto flex flex-col md:flex-row justify-between items-center gap-4">
                        <div class="flex flex-col gap-1 items-center md:items-start">
                            <span class="font-headline-md text-headline-md text-on-surface">{{ config('app.name') }}</span>
                            <p class="font-metadata text-metadata text-secondary">© {{ date('Y') }}
                                {{ config('app.name') }}. All rights reserved.
                            </p>
                        </div>
                        <nav class="flex flex-wrap justify-center gap-6">
                            <a class="text-secondary font-metadata text-metadata hover:text-on-surface transition-colors"
                                href="#">About</a>
                            <a class="text-secondary font-metadata text-metadata hover:text-on-surface transition-colors"
                                href="#">Privacy</a>
                            <a class="text-secondary font-metadata text-metadata hover:text-on-surface transition-colors"
                                href="#">Terms</a>
                            <a class="text-secondary font-metadata text-metadata hover:text-on-surface transition-colors"
                                href="#">Help</a>
                        </nav>
                    </div>
                </footer>
            @endunless
        </main>
    </div>
</body>

</html>