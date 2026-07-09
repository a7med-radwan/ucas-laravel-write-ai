<x-layout title="Profile Settings">
    <form action="{{ route('dashboard.profile.update') }}" method="POST" enctype="multipart/form-data"
        class="pt-8 pb-section-gap px-gutter max-w-3xl mx-auto">
        @csrf
        @method('PUT')

        <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 text-on-surface-variant hover:text-primary font-ui-label text-ui-label mb-6 transition-colors">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            Back to Home
        </a>

        <div class="bg-surface-container-lowest rounded-xl border border-outline-variant p-6 sm:p-8 shadow-sm">
            <!-- Header -->
            <div class="mb-8">
                <h2 class="font-display-lg-mobile text-[22px] font-bold text-on-surface truncate">
                    Profile Settings
                </h2>
                <p class="text-secondary font-body-md mt-2">
                    Update your account details, change your password, or customize your profile avatar.
                </p>
            </div>

            @if (session()->has('status'))
                <div class="mb-6 p-4 bg-green-50 text-green-800 rounded-xl border border-green-200 flex items-center gap-3">
                    <span class="material-symbols-outlined text-green-600">check_circle</span>
                    <span class="font-ui-label text-ui-label">{{ session('status') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                    <ul class="list-disc list-inside text-red-700 font-ui-label text-ui-label space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="space-y-8">
                <!-- Avatar Upload with Preview -->
                <div class="flex flex-col sm:flex-row items-center gap-6 pb-6 border-b border-outline-variant/60">
                    <div class="relative group">
                        <div class="w-24 h-24 rounded-full overflow-hidden border-2 border-primary/20 bg-surface-container-low shrink-0 shadow-sm relative">
                            <img id="avatar-preview" src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                        </div>
                        <label for="avatar-input" class="absolute inset-0 flex items-center justify-center bg-black/40 text-white rounded-full opacity-0 group-hover:opacity-100 cursor-pointer transition-opacity duration-200">
                            <span class="material-symbols-outlined text-[24px]">photo_camera</span>
                        </label>
                    </div>
                    <div class="flex-1 text-center sm:text-left">
                        <h4 class="font-ui-label text-ui-label font-bold text-on-surface mb-1">Profile Photo</h4>
                        <p class="text-metadata font-metadata text-on-surface-variant mb-3">PNG, JPG or JPEG. Max size of 2MB.</p>
                        <input id="avatar-input" type="file" name="avatar" class="hidden" accept="image/*" onchange="previewAvatar(event)">
                        <button type="button" onclick="document.getElementById('avatar-input').click()" class="inline-flex items-center gap-1.5 px-4 py-2 border border-outline-variant hover:border-primary hover:bg-surface-container rounded-lg font-ui-button text-ui-button text-xs transition-all">
                            <span class="material-symbols-outlined text-[16px]">upload</span>
                            Choose Image
                        </button>
                    </div>
                </div>

                <!-- Account Fields -->
                <div class="space-y-6">
                    <div>
                        <label class="block mb-2 font-ui-label text-ui-label font-medium text-on-surface">
                            Full Name
                        </label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="Your Name"
                            class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-2.5
                            text-on-surface font-ui-label text-ui-label
                            focus:outline-none focus:ring-2 focus:ring-primary/20
                            focus:border-primary transition-all">
                        @error('name')
                            <p class="mt-1 text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block mb-2 font-ui-label text-ui-label font-medium text-on-surface">
                                Email Address
                            </label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" placeholder="your@email.com"
                                class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-2.5
                                text-on-surface font-ui-label text-ui-label
                                focus:outline-none focus:ring-2 focus:ring-primary/20
                                focus:border-primary transition-all">
                            @error('email')
                                <p class="mt-1 text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-2 font-ui-label text-ui-label font-medium text-on-surface">
                                Username
                            </label>
                            <input type="text" name="username" value="{{ old('username', $user->username) }}" placeholder="username"
                                class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-2.5
                                text-on-surface font-ui-label text-ui-label
                                focus:outline-none focus:ring-2 focus:ring-primary/20
                                focus:border-primary transition-all">
                            @error('username')
                                <p class="mt-1 text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Password Update Fields -->
                <div class="pt-6 border-t border-outline-variant/60 space-y-6">
                    <div>
                        <h4 class="font-ui-label text-ui-label font-bold text-on-surface mb-1">Change Password</h4>
                        <p class="text-metadata font-metadata text-on-surface-variant mb-4">Leave fields blank if you do not want to change your password.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block mb-2 font-ui-label text-ui-label font-medium text-on-surface">
                                New Password
                            </label>
                            <input type="password" name="password" placeholder="••••••••"
                                class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-2.5
                                text-on-surface font-ui-label text-ui-label
                                focus:outline-none focus:ring-2 focus:ring-primary/20
                                focus:border-primary transition-all">
                            @error('password')
                                <p class="mt-1 text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-2 font-ui-label text-ui-label font-medium text-on-surface">
                                Confirm New Password
                            </label>
                            <input type="password" name="password_confirmation" placeholder="••••••••"
                                class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-2.5
                                text-on-surface font-ui-label text-ui-label
                                focus:outline-none focus:ring-2 focus:ring-primary/20
                                focus:border-primary transition-all">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end gap-3 mt-10">
                <a href="{{ route('home') }}"
                    class="px-5 py-2.5 rounded-lg border border-outline-variant
                    text-on-surface-variant font-ui-label text-ui-label hover:bg-surface-container transition-colors">
                    Cancel
                </a>

                <button type="submit"
                    class="bg-primary text-on-primary px-6 py-2.5 rounded-lg
                    font-ui-label text-ui-button hover:opacity-90 transition-all shadow-sm">
                    Save Changes
                </button>
            </div>
        </div>
    </form>

    <script>
        function previewAvatar(event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('avatar-preview').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-layout>
