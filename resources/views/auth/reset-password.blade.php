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

        .paper-card {
            background-color: #ffffff;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        }
    </style>
</head>

<body class="flex flex-col min-h-screen text-on-surface">
    <!-- TopNavBar -->
    <nav
        class="bg-surface border-b border-outline-variant flex justify-between items-center w-full px-gutter max-w-container-max mx-auto h-16 fixed top-0 left-0 right-0 z-50">
        <div class="flex items-center gap-2">
            <span class="font-display-lg-mobile text-display-lg-mobile font-bold text-on-surface">Ink &amp; Paper</span>
        </div>
        <div class="hidden md:flex items-center gap-8">
            <a class="text-on-surface-variant font-medium hover:text-primary transition-colors duration-200 font-ui-label text-ui-label"
                href="#">Feed</a>
            <a class="text-on-surface-variant font-medium hover:text-primary transition-colors duration-200 font-ui-label text-ui-label"
                href="#">Authors</a>
            <a class="text-on-surface-variant font-medium hover:text-primary transition-colors duration-200 font-ui-label text-ui-label"
                href="#">Dashboard</a>
        </div>
        <div class="flex items-center gap-4">
            <button
                class="material-symbols-outlined text-on-surface-variant hover:text-primary transition-all p-2 rounded-full"
                data-icon="notifications">notifications</button>
            <button
                class="material-symbols-outlined text-on-surface-variant hover:text-primary transition-all p-2 rounded-full"
                data-icon="bookmark">bookmark</button>
            <button
                class="hidden md:block bg-primary text-on-primary font-ui-button text-ui-button px-6 py-2 rounded-lg transition-all active:scale-95 active:opacity-80">Create
                Post</button>
        </div>
    </nav>
    <!-- Main Content Canvas -->
    <main class="flex-grow flex items-center justify-center pt-24 pb-section-gap px-gutter">
        <div class="w-full max-w-[440px]">
            <!-- Link Verification Success Banner -->
            <div class="mb-8 flex items-center gap-4 p-4 rounded-lg bg-surface-container border border-outline-variant">
                <span class="material-symbols-outlined text-primary" data-icon="verified"
                    style="font-variation-settings: 'FILL' 1;">verified</span>
                <div>
                    <p class="font-ui-label text-ui-label text-on-surface font-bold">Link Verified</p>
                    <p class="font-metadata text-metadata text-secondary">Your reset token is valid. You may now choose
                        a new password.</p>
                </div>
            </div>
            <!-- Form Container -->
            <div class="paper-card border border-outline-variant p-8 md:p-10 rounded-xl">
                <div class="mb-10 text-center">
                    <h1 class="font-headline-md text-headline-md mb-2">Reset Password</h1>
                    <p class="font-body-md text-body-md text-secondary">Ensure your account is secure by using a
                        complex, unique password.</p>
                </div>
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif
                @error(config('fortify.password'))
                    <div class="mb-4 font-medium text-sm text-red-950 bg-red-200">
                        {{ $message }}
                    </div>
                @enderror
                <form action="{{ route('password.update') }}" class="space-y-8" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <input type="hidden" name="{{ config('fortify.email') }}" value="{{ $request->input('email') }}">
                    <!-- New Password -->
                    <div class="space-y-2">
                        <label class="block font-ui-label text-ui-label text-on-surface-variant" for="new_password">New
                            Password</label>
                        <div class="relative">
                            <input
                                class="w-full px-4 py-3 bg-surface border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary-container focus:border-primary outline-none transition-all font-ui-label text-ui-label"
                                id="new_password" name="password" placeholder="••••••••" required=""
                                type="password" />
                            <button
                                class="absolute right-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-outline"
                                data-icon="visibility" type="button">visibility</button>
                        </div>
                        <!-- Password Strength Indicator -->
                        <div class="pt-2">
                            <div class="flex gap-1 h-1 mb-2">
                                <div class="flex-1 bg-primary rounded-full"></div>
                                <div class="flex-1 bg-primary rounded-full"></div>
                                <div class="flex-1 bg-primary rounded-full"></div>
                                <div class="flex-1 bg-surface-container-high rounded-full"></div>
                            </div>
                            <div class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-[14px] text-primary"
                                    data-icon="check_circle">check_circle</span>
                                <span class="font-metadata text-metadata text-secondary">Strong: Mix of symbols and
                                    letters</span>
                            </div>
                        </div>
                    </div>
                    <!-- Confirm New Password -->
                    <div class="space-y-2">
                        <label class="block font-ui-label text-ui-label text-on-surface-variant"
                            for="confirm_password">Confirm New Password</label>
                        <div class="relative">
                            <input
                                class="w-full px-4 py-3 bg-surface border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary-container focus:border-primary outline-none transition-all font-ui-label text-ui-label"
                                id="confirm_password" name="password_confirmation" placeholder="••••••••" required=""
                                type="password" />
                        </div>
                    </div>
                    <!-- Primary Action -->
                    <button
                        class="w-full bg-primary-container text-on-primary font-ui-button text-ui-button py-4 rounded-lg hover:shadow-lg transition-all active:scale-95 active:opacity-90"
                        type="submit">
                        Update Password
                    </button>
                </form>
                <div class="mt-8 text-center">
                    <a class="font-ui-label text-ui-label text-secondary hover:text-on-surface hover:underline transition-all inline-flex items-center gap-1"
                        href="#">
                        <span class="material-symbols-outlined text-[16px]" data-icon="arrow_back">arrow_back</span>
                        Back to sign in
                    </a>
                </div>
            </div>
            <!-- Contextual Editorial Card (Bento-style element) -->
            <div class="mt-12 grid grid-cols-1 gap-4">
                <div class="paper-card border border-outline-variant p-6 rounded-xl flex items-center gap-6">
                    <div class="w-16 h-16 rounded-lg overflow-hidden flex-shrink-0">
                        <img alt="Security" class="w-full h-full object-cover grayscale"
                            data-alt="A macro close-up of a vintage typewriter key hitting white paper, captured in high-contrast black and white photography. The lighting is sharp and cinematic, highlighting the ink texture on the paper. The mood is professional, intellectual, and focused on security and detail. Minimalist editorial aesthetic consistent with high-end publishing."
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDr3ZJ2_N4WBBdyo0CmryL-OZQiPenhzgosOjIQa_17BCJ-GnX-3hrdbmx9L6GJGIllFUmkfZqtI42hkgq90QzFVC0YrWqAUcwJmncntHKZ1qE3BmxH43xB5hVFFecgrk06ZnUEPR8Mfxzy2Ncm6cbCGtWOdVlQIdY5OejoRD2TMwrmQh7-56opJQg5OrbH26E1MfKY09pETWPraP80I-Sn0EiVHUyf5ZTQcYk9OSnyoMSSPG1LJqc2DwlOFioHP7Q_pzT9NN2Qc4s0" />
                    </div>
                    <div>
                        <h4 class="font-ui-label text-ui-label font-bold mb-1">Security Best Practices</h4>
                        <p class="font-metadata text-metadata text-secondary leading-relaxed">We recommend using a
                            password manager and enabling two-factor authentication for maximum account protection.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Footer -->
    <footer class="bg-surface border-t border-outline-variant">
        <div
            class="w-full py-section-gap px-gutter max-w-container-max mx-auto flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex flex-col items-center md:items-start gap-2">
                <span class="font-headline-md text-headline-md text-on-surface">Ink &amp; Paper</span>
                <p class="font-metadata text-metadata text-secondary">© 2024 Ink &amp; Paper Platform. All rights
                    reserved.</p>
            </div>
            <div class="flex flex-wrap justify-center gap-6">
                <a class="font-metadata text-metadata text-secondary hover:text-on-surface underline transition-all"
                    href="#">About</a>
                <a class="font-metadata text-metadata text-secondary hover:text-on-surface underline transition-all"
                    href="#">Privacy</a>
                <a class="font-metadata text-metadata text-secondary hover:text-on-surface underline transition-all"
                    href="#">Terms</a>
                <a class="font-metadata text-metadata text-secondary hover:text-on-surface underline transition-all"
                    href="#">API</a>
                <a class="font-metadata text-metadata text-secondary hover:text-on-surface underline transition-all"
                    href="#">Help</a>
            </div>
        </div>
    </footer>
</body>

</html>
