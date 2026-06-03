<!DOCTYPE html>

<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Login - Ink &amp; Paper</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Source+Serif+4:wght@400;600;700&amp;family=Inter:wght@400;500;600&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface-container-high": "#e8e8e8",
                        "primary-container": "#7c3aed",
                        "on-primary-fixed-variant": "#5a00c6",
                        "on-secondary-fixed": "#1c1b1b",
                        "on-primary-fixed": "#25005a",
                        "tertiary-fixed": "#ffdcc6",
                        "on-tertiary": "#ffffff",
                        "inverse-on-surface": "#f1f1f1",
                        "surface-tint": "#732ee4",
                        "tertiary-fixed-dim": "#ffb784",
                        "outline": "#7b7487",
                        "surface-container-highest": "#e2e2e2",
                        "secondary-fixed-dim": "#c8c6c5",
                        "on-surface": "#1a1c1c",
                        "surface-dim": "#dadada",
                        "secondary-container": "#e2dfde",
                        "secondary-fixed": "#e5e2e1",
                        "on-tertiary-fixed-variant": "#713700",
                        "surface": "#f9f9f9",
                        "surface-container": "#eeeeee",
                        "on-secondary-container": "#636262",
                        "outline-variant": "#ccc3d8",
                        "surface-container-lowest": "#ffffff",
                        "background": "#f9f9f9",
                        "secondary": "#5f5e5e",
                        "on-primary": "#ffffff",
                        "error": "#ba1a1a",
                        "on-tertiary-fixed": "#301400",
                        "tertiary-container": "#a15100",
                        "primary-fixed": "#eaddff",
                        "on-primary-container": "#ede0ff",
                        "primary": "#630ed4",
                        "on-tertiary-container": "#ffe0cd",
                        "error-container": "#ffdad6",
                        "on-error-container": "#93000a",
                        "on-background": "#1a1c1c",
                        "tertiary": "#7d3d00",
                        "inverse-primary": "#d2bbff",
                        "surface-variant": "#e2e2e2",
                        "surface-container-low": "#f3f3f3",
                        "on-secondary": "#ffffff",
                        "on-surface-variant": "#4a4455",
                        "surface-bright": "#f9f9f9",
                        "on-secondary-fixed-variant": "#474746",
                        "primary-fixed-dim": "#d2bbff",
                        "on-error": "#ffffff",
                        "inverse-surface": "#2f3131"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "container-max": "1200px",
                        "section-gap": "4rem",
                        "margin-mobile": "1rem",
                        "gutter": "1.5rem",
                        "article-max": "720px"
                    },
                    "fontFamily": {
                        "headline-md": ["Source Serif 4"],
                        "ui-label": ["Inter"],
                        "display-lg": ["Source Serif 4"],
                        "ui-button": ["Inter"],
                        "metadata": ["Inter"],
                        "body-md": ["Source Serif 4"],
                        "display-lg-mobile": ["Source Serif 4"],
                        "body-lg": ["Source Serif 4"]
                    },
                    "fontSize": {
                        "headline-md": ["32px", { "lineHeight": "1.3", "fontWeight": "600" }],
                        "ui-label": ["14px", { "lineHeight": "1.4", "letterSpacing": "0.01em", "fontWeight": "500" }],
                        "display-lg": ["48px", { "lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                        "ui-button": ["16px", { "lineHeight": "1", "letterSpacing": "0.02em", "fontWeight": "600" }],
                        "metadata": ["12px", { "lineHeight": "1.4", "fontWeight": "400" }],
                        "body-md": ["18px", { "lineHeight": "1.6", "fontWeight": "400" }],
                        "display-lg-mobile": ["32px", { "lineHeight": "1.2", "fontWeight": "700" }],
                        "body-lg": ["20px", { "lineHeight": "1.6", "fontWeight": "400" }]
                    }
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }

        body {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body class="font-body-md text-on-surface selection:bg-primary-fixed selection:text-on-primary-fixed">
    <!-- Top Navigation (Shell suppressed but branding maintained) -->
    <header class="bg-surface docked full-width top-0 border-b border-outline-variant">
        <div class="flex justify-between items-center w-full px-gutter max-w-container-max mx-auto h-16">
            <span class="font-display-lg-mobile text-display-lg-mobile font-bold text-on-surface">Ink &amp; Paper</span>
            <div class="hidden md:flex gap-6 items-center">
                <a class="font-ui-label text-ui-label text-on-surface-variant hover:text-primary transition-colors duration-200"
                    href="#">Help</a>
            </div>
        </div>
    </header>
    <!-- Main Content Canvas -->
    <main class="min-h-[calc(100vh-128px)] flex items-center justify-center py-section-gap px-gutter">
        <div class="w-full max-w-[440px]">
            <!-- Login Card -->
            <div
                class="bg-surface-container-lowest border border-outline-variant p-8 md:p-10 rounded-lg shadow-[0_20px_30px_-10px_rgba(0,0,0,0.05)] transition-all">
                <div class="mb-8 text-center md:text-left">
                    <h1 class="font-headline-md text-headline-md text-on-surface mb-2">Welcome back</h1>
                    <p class="font-body-md text-secondary">Sign in to your editorial workspace.</p>
                </div>
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif
                @error(config('fortify.username'))
                    <div class="mb-4 font-medium text-sm text-red-950 bg-red-200">
                        {{ $message }}
                    </div>
                @enderror
                <form action="{{ route('login.store') }}" method="post" class="space-y-6">
                    @csrf
                    <!-- Email Field -->
                    <div class="space-y-2">
                        <label class="font-ui-label text-ui-label text-on-surface-variant block" for="email">Email
                            Address</label>
                        <input
                            class="w-full h-12 px-4 bg-surface-bright border border-outline-variant rounded focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all font-ui-label text-on-surface placeholder:text-outline"
                            id="email" name="{{ config('fortify.username') }}"
                            value="{{ old(config('fortify.username')) }}" placeholder="name@domain.com" required=""
                            type="email" />
                    </div>
                    <!-- Password Field -->
                    <div class="space-y-2">
                        <div class="flex justify-between items-center">
                            <label class="font-ui-label text-ui-label text-on-surface-variant"
                                for="password">Password</label>
                            <a class="font-ui-label text-ui-label text-primary hover:underline transition-all"
                                href="{{ route('password.request') }}">Forgot Password?</a>
                        </div>
                        <input
                            class="w-full h-12 px-4 bg-surface-bright border border-outline-variant rounded focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all font-ui-label text-on-surface placeholder:text-outline"
                            id="password" name="password" placeholder="••••••••" required="" type="password" />
                    </div>
                    <!-- Remember Me -->
                    <div class="flex items-center gap-3">
                        <input
                            class="w-4 h-4 rounded border-outline-variant text-primary focus:ring-primary transition-all"
                            id="remember" name="remember" type="checkbox" />
                        <label class="font-ui-label text-ui-label text-on-secondary-fixed-variant select-none"
                            for="remember">Remember me for 30 days</label>
                    </div>
                    <!-- Primary Action -->
                    <button
                        class="w-full h-12 bg-primary-container text-on-primary font-ui-button text-ui-button rounded hover:bg-primary active:scale-95 transition-all flex justify-center items-center gap-2"
                        type="submit">
                        Sign In
                    </button>
                </form>
                <!-- Divider -->
                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-outline-variant"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span
                            class="bg-surface-container-lowest px-4 font-metadata text-metadata text-outline uppercase tracking-widest">or
                            continue with</span>
                    </div>
                </div>
                <!-- Social Logins -->
                <div class="grid grid-cols-2 gap-4">
                    <button
                        class="h-12 border border-on-surface flex items-center justify-center gap-3 font-ui-label text-ui-label text-on-surface hover:bg-surface-container transition-all rounded">
                        <span class="material-symbols-outlined text-[20px]" data-icon="cloud">cloud</span>
                        Google
                    </button>
                    <button
                        class="h-12 border border-on-surface flex items-center justify-center gap-3 font-ui-label text-ui-label text-on-surface hover:bg-surface-container transition-all rounded">
                        <span class="material-symbols-outlined text-[20px]" data-icon="terminal">terminal</span>
                        Github
                    </button>
                </div>
                <!-- Footer Link -->
                <div class="mt-10 text-center">
                    <p class="font-ui-label text-ui-label text-on-surface-variant">
                        New to Ink &amp; Paper?
                        <a class="text-primary font-bold hover:underline transition-all ml-1"
                            href="{{ route('register') }}">Create an
                            Account</a>
                    </p>
                </div>
            </div>
            <!-- Transactional Context Image -->
            <div class="mt-12 opacity-40 grayscale group-hover:grayscale-0 transition-all">
                <img alt="Inspiration"
                    class="w-full h-24 object-cover rounded-lg border border-outline-variant grayscale"
                    data-alt="A macro close-up of a high-quality fountain pen tip resting on textured ivory-colored paper. The scene is shot in a bright, minimalist studio with soft diffused lighting, emphasizing the sharp contrast between the dark ink and the clean white surface. The atmosphere is quiet and professional, reflecting a premium editorial and creative writing environment. Subtle shadows add depth to the minimal monochromatic palette."
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuCaZzKZpXNwoxBOGg9qTCZOzjVtZgaq3v5K8sIDlTkB84CPOVf_AboEgvK7uVkq_-xo579Nl8Lo_BtjUxPflCR4Vgbs6kRK6ky6zyEvGrEfWMFD3oPgLRwRAb-c4f8jO73qjl1LwUEEI32HZaEuxonXTXoetuE3qdUGsu4Ec9HO4UuTL2phazkyVjlixFHaaGQ94g5tBW6pagkXvkhyBeSbasPRz9MmVa4P2sa8aFZocu96y0agSrKIXhQjp8QNtmD-Yzbod-SeXTOE" />
            </div>
        </div>
    </main>
    <!-- Footer Component -->
    <footer class="bg-surface full-width border-t border-outline-variant">
        <div
            class="w-full py-section-gap px-gutter max-w-container-max mx-auto flex flex-col md:flex-row justify-between items-center gap-4">
            <span class="font-headline-md text-headline-md text-on-surface">Ink &amp; Paper</span>
            <div class="flex gap-6">
                <a class="font-body-md text-secondary hover:text-on-surface underline transition-all" href="#">About</a>
                <a class="font-body-md text-secondary hover:text-on-surface underline transition-all"
                    href="#">Privacy</a>
                <a class="font-body-md text-secondary hover:text-on-surface underline transition-all" href="#">Terms</a>
                <a class="font-body-md text-secondary hover:text-on-surface underline transition-all" href="#">API</a>
                <a class="font-body-md text-secondary hover:text-on-surface underline transition-all" href="#">Help</a>
            </div>
            <p class="font-metadata text-metadata text-secondary">© 2024 Ink &amp; Paper Platform. All rights reserved.
            </p>
        </div>
    </footer>
</body>

</html>