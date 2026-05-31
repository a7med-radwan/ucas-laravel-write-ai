<!DOCTYPE html>

<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Forgot Password - Ink &amp; Paper</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=Source+Serif+4:wght@400;600;700&amp;display=swap"
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
            display: inline-block;
            vertical-align: middle;
        }

        body {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body class="bg-surface text-on-surface font-body-md selection:bg-primary-fixed selection:text-primary">
    <!-- Top Navigation Bar (Suppressed items for Transactional Screen) -->
    <header class="bg-surface border-b border-outline-variant w-full h-16 fixed top-0 z-50">
        <div class="flex justify-between items-center w-full px-gutter max-w-container-max mx-auto h-full">
            <div class="font-display-lg-mobile text-display-lg-mobile font-bold text-on-surface">Ink &amp; Paper</div>
            <a class="font-ui-label text-ui-label text-on-surface-variant hover:text-primary transition-colors duration-200 flex items-center gap-2"
                href="/login">
                <span class="material-symbols-outlined" data-icon="arrow_back">arrow_back</span>
                Back to Login
            </a>
        </div>
    </header>
    <main class="min-h-screen flex items-center justify-center pt-16 px-margin-mobile">
        <div class="w-full max-w-[440px] flex flex-col gap-8">
            <!-- Branding/Icon Section -->
            <div class="flex flex-col items-center text-center gap-4">
                <div
                    class="w-16 h-16 rounded-full bg-surface-container-lowest flex items-center justify-center border border-outline-variant shadow-sm">
                    <span class="material-symbols-outlined text-primary text-[32px]"
                        data-icon="lock_reset">lock_reset</span>
                </div>
                <div class="space-y-2">
                    <h1 class="font-headline-md text-headline-md text-on-surface">Reset your password</h1>
                    <p class="font-body-md text-on-surface-variant max-w-[360px] mx-auto">
                        Enter the email address associated with your account and we'll send you a link to reset your
                        password.
                    </p>
                </div>
            </div>
            <!-- Form Section -->
            <div class="bg-surface-container-lowest p-8 border border-outline-variant rounded-xl">
                @error(config('fortify.username'))
                <div class="mb-4 font-medium text-sm text-red-950 bg-red-200">
                    {{ $message }}
                </div>
                @enderror
                <form action="{{ route('password.request') }}" method="post" class="flex flex-col gap-6">
                    @csrf
                    <div class="flex flex-col gap-2">
                        <label class="font-ui-label text-ui-label text-on-surface-variant" for="email">Email
                            Address</label>
                        <input
                            class="w-full h-12 px-4 bg-surface border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary-container focus:border-primary outline-none transition-all font-ui-label text-on-surface placeholder:text-secondary-fixed-dim"
                            id="email" name="{{ config('fortify.email') }}" placeholder="name@company.com" required=""
                            type="email" />
                    </div>
                    <button
                        class="w-full h-12 bg-primary-container hover:bg-primary text-on-primary font-ui-button text-ui-button rounded-lg transition-all active:scale-[0.98] active:opacity-90 shadow-sm"
                        type="submit">
                        Send Reset Link
                    </button>
                </form>
            </div>
            <!-- Supporting Illustration (Subtle) -->
            <div
                class="relative w-full h-48 rounded-xl overflow-hidden grayscale opacity-40 hover:opacity-80 transition-opacity duration-700">
                <img alt="Minimalist study space" class="w-full h-full object-cover"
                    data-alt="A clean, minimalist workspace featuring a stack of high-quality cream-colored paper and a sleek black ink pen resting on top. The scene is shot from a high angle with soft, bright natural lighting coming from a side window, creating delicate shadows. The aesthetic is monochromatic and quiet, emphasizing the Paper and Ink theme of the platform. The overall mood is focused, serene, and professional."
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBa4NDSej0z5gbXHGBYJI-znfvY5P2CQXiE3l4Y8BBTagXhBklDJANDqUqvZ6RV0ij63Z3KiOVcNReu0hHTvQVJZbdqeQbMmRQuJgZhJD_sbqA5t91oxufjBC-e6YitreIJIHMcqYlUdMuZV9LqaW6GQ2SXV5gRVjjEJPVN_Cb621vR71s-08ugKIUQPG81_N3BpyM_HTAmaYLGVvtw2VJd1GOe2Mum79WovoT-PHVyq9goKJEbb1MmOcZB28PmCU6E10nNQ05oc8KF" />
            </div>
            <!-- Footer Link -->
            <div class="text-center">
                <a class="font-ui-label text-ui-label text-secondary hover:text-on-surface underline transition-all"
                    href="/login">
                    I remember my password
                </a>
            </div>
        </div>
    </main>
    <!-- Footer (Using Shared Components Logic) -->
    <footer
        class="w-full py-12 px-gutter max-w-container-max mx-auto flex flex-col md:flex-row justify-between items-center gap-4 border-t border-outline-variant mt-24">
        <div class="font-headline-md text-headline-md text-on-surface">Ink &amp; Paper</div>
        <div class="flex gap-6">
            <a class="font-metadata text-metadata text-secondary hover:text-on-surface underline transition-all"
                href="#">About</a>
            <a class="font-metadata text-metadata text-secondary hover:text-on-surface underline transition-all"
                href="#">Privacy</a>
            <a class="font-metadata text-metadata text-secondary hover:text-on-surface underline transition-all"
                href="#">Terms</a>
            <a class="font-metadata text-metadata text-secondary hover:text-on-surface underline transition-all"
                href="#">Help</a>
        </div>
        <div class="font-metadata text-metadata text-secondary">
            © 2024 Ink &amp; Paper Platform. All rights reserved.
        </div>
    </footer>
</body>

</html>
