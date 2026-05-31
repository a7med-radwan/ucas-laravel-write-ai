<!DOCTYPE html>

<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
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
                        "headline-md": ["32px", {
                            "lineHeight": "1.3",
                            "fontWeight": "600"
                        }],
                        "ui-label": ["14px", {
                            "lineHeight": "1.4",
                            "letterSpacing": "0.01em",
                            "fontWeight": "500"
                        }],
                        "display-lg": ["48px", {
                            "lineHeight": "1.2",
                            "letterSpacing": "-0.02em",
                            "fontWeight": "700"
                        }],
                        "ui-button": ["16px", {
                            "lineHeight": "1",
                            "letterSpacing": "0.02em",
                            "fontWeight": "600"
                        }],
                        "metadata": ["12px", {
                            "lineHeight": "1.4",
                            "fontWeight": "400"
                        }],
                        "body-md": ["18px", {
                            "lineHeight": "1.6",
                            "fontWeight": "400"
                        }],
                        "display-lg-mobile": ["32px", {
                            "lineHeight": "1.2",
                            "fontWeight": "700"
                        }],
                        "body-lg": ["20px", {
                            "lineHeight": "1.6",
                            "fontWeight": "400"
                        }]
                    }
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        body {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body class="bg-background text-on-surface selection:bg-primary-fixed selection:text-on-primary-fixed">
    <div class="min-h-screen flex flex-col items-center justify-center p-gutter">
        <!-- Brand Identity -->
        <header class="mb-12 text-center">
            <h1
                class="font-display-lg-mobile text-display-lg-mobile md:font-display-lg md:text-display-lg text-on-surface mb-2 tracking-tight">
                Ink &amp; Paper</h1>
            <p class="font-ui-label text-ui-label text-secondary uppercase tracking-widest">Digital Quiet for Modern
                Thinkers</p>
        </header>
        <!-- Centered Card -->
        <main
            class="w-full max-w-[480px] bg-surface-container-lowest border border-outline-variant rounded-xl p-8 md:p-12 shadow-[0_20px_40px_-15px_rgba(0,0,0,0.05)]">
            <section class="mb-10 text-center">
                <h2 class="font-headline-md text-headline-md text-on-surface mb-3">Create Account</h2>
                <p class="font-body-md text-body-md text-on-surface-variant">Join a community of thoughtful writers and
                    readers.</p>
            </section>
            <!-- Social Sign Up -->
            <div class="grid grid-cols-2 gap-4 mb-8">
                <button
                    class="flex items-center justify-center gap-3 py-3 border border-outline-variant rounded-lg font-ui-button text-ui-button text-on-surface hover:bg-surface-container-low transition-colors duration-200 focus:ring-2 focus:ring-primary focus:outline-none">
                    <svg class="w-5 h-5" viewbox="0 0 24 24">
                        <path
                            d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                            fill="currentColor"></path>
                        <path
                            d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                            fill="currentColor"></path>
                        <path
                            d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.26.81-.58z"
                            fill="currentColor"></path>
                        <path
                            d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                            fill="currentColor"></path>
                    </svg>
                    Google
                </button>
                <button
                    class="flex items-center justify-center gap-3 py-3 border border-outline-variant rounded-lg font-ui-button text-ui-button text-on-surface hover:bg-surface-container-low transition-colors duration-200 focus:ring-2 focus:ring-primary focus:outline-none">
                    <svg class="w-5 h-5" viewbox="0 0 24 24">
                        <path
                            d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.045 4.126H5.078z"
                            fill="currentColor"></path>
                    </svg>
                    Twitter
                </button>
            </div>
            <div class="relative flex items-center justify-center mb-8">
                <hr class="w-full border-outline-variant" />
                <span class="absolute px-4 bg-surface-container-lowest font-metadata text-metadata text-secondary">OR
                    CONTINUE WITH EMAIL</span>
            </div>
            <!-- Registration Form -->
            <form action="{{ route('register') }}" class="space-y-6" method="POST">
                @csrf
                <div>
                    <label class="block font-ui-label text-ui-label text-on-surface mb-2" for="full_name">Full
                        Name</label>
                    <input
                        class="w-full px-4 py-3 rounded-lg border border-outline-variant bg-surface focus:border-primary-container focus:ring-1 focus:ring-primary-container transition-all outline-none font-ui-label"
                        id="full_name" name="name" placeholder="E.g. Julian Barnes" required="" type="text" />
                </div>
                <div>
                    <label class="block font-ui-label text-ui-label text-on-surface mb-2" for="username">User
                        Name</label>
                    <input
                        class="w-full px-4 py-3 rounded-lg border border-outline-variant bg-surface focus:border-primary-container focus:ring-1 focus:ring-primary-container transition-all outline-none font-ui-label"
                        id="username" name="username" placeholder="E.g. julian_barnes" required="" type="text" />
                </div>

                <div>
                    <label class="block font-ui-label text-ui-label text-on-surface mb-2" for="email">Email
                        Address</label>
                    <input
                        class="w-full px-4 py-3 rounded-lg border border-outline-variant bg-surface focus:border-primary-container focus:ring-1 focus:ring-primary-container transition-all outline-none font-ui-label"
                        id="email" name="email" placeholder="julian@inkandpaper.com" required=""
                        type="email" />
                </div>
                <div>
                    <label class="block font-ui-label text-ui-label text-on-surface mb-2"
                        for="password">Password</label>
                    <div class="relative">
                        <input
                            class="w-full px-4 py-3 rounded-lg border border-outline-variant bg-surface focus:border-primary-container focus:ring-1 focus:ring-primary-container transition-all outline-none font-ui-label"
                            id="password" name="password" placeholder="At least 12 characters" required=""
                            type="password" />
                        <button
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-primary transition-colors"
                            type="button">
                            <span class="material-symbols-outlined text-[20px]">visibility</span>
                        </button>
                    </div>
                </div>
                <div>
                    <label class="block font-ui-label text-ui-label text-on-surface mb-2">
                        Confirm Password
                    </label>

                    <input class="w-full px-4 py-3 rounded-lg border border-outline-variant bg-surface"
                        name="password_confirmation" type="password" placeholder="Confirm password" />
                </div>
                <div class="pt-2">
                    <button
                        class="w-full bg-primary-container text-on-primary py-4 rounded-lg font-ui-button text-ui-button hover:opacity-90 active:scale-95 transition-all shadow-lg shadow-primary-container/20"
                        type="submit">
                        Create Account
                    </button>
                </div>
            </form>
            <footer class="mt-8 text-center">
                <p class="font-metadata text-metadata text-on-surface-variant">
                    Already have an account?
                    <a class="font-ui-label text-primary hover:underline ml-1" href="{{ route('login') }}">Log in</a>
                </p>
                <p class="mt-6 font-metadata text-[10px] text-secondary leading-relaxed max-w-[280px] mx-auto">
                    By clicking "Create Account", you agree to our
                    <a class="underline" href="#">Terms of Service</a> and
                    <a class="underline" href="#">Privacy Policy</a>.
                </p>
            </footer>
        </main>
        <!-- Semantic Footer from JSON (Adapted for Context) -->
        <footer
            class="w-full py-12 px-gutter max-w-container-max mx-auto flex flex-col md:flex-row justify-between items-center gap-4 mt-8">
            <span class="font-metadata text-metadata text-secondary">© 2024 Ink &amp; Paper Platform. All rights
                reserved.</span>
            <nav class="flex gap-6">
                <a class="font-metadata text-metadata text-secondary hover:text-on-surface underline transition-all"
                    href="#">About</a>
                <a class="font-metadata text-metadata text-secondary hover:text-on-surface underline transition-all"
                    href="#">Privacy</a>
                <a class="font-metadata text-metadata text-secondary hover:text-on-surface underline transition-all"
                    href="#">Terms</a>
                <a class="font-metadata text-metadata text-secondary hover:text-on-surface underline transition-all"
                    href="#">Help</a>
            </nav>
        </footer>
    </div>
    <!-- Decorative Elements to emphasize "Paper & Ink" -->
    <div class="fixed top-0 left-0 w-full h-1 bg-primary-container opacity-50 pointer-events-none"></div>
    <div class="fixed bottom-0 left-0 w-full h-px bg-outline-variant pointer-events-none"></div>
</body>

</html>
