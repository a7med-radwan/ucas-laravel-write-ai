<form action="{{ $action ?? route('admin.users.store') }}" method="POST"
    class="pt-8 pb-section-gap px-gutter max-w-3xl mx-auto">
    @csrf
    @method($method ?? 'POST')

    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-1.5 text-on-surface-variant hover:text-primary font-ui-label text-ui-label mb-6 transition-colors">
        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
        Back to Users
    </a>

    <div class="bg-surface-container-lowest rounded-xl border border-outline-variant p-6 sm:p-8 shadow-sm">

        <!-- Header -->
        <div class="mb-8">
            <h2 class="font-display-lg text-display-lg text-on-surface">
                {{ isset($user->id) ? 'Edit User' : 'Create User' }}
            </h2>
            <p class="text-secondary font-body-md mt-2">
                {{ isset($user->id) ? 'Update user details and role assignments.' : 'Add a new user to the platform with specific roles and permissions.' }}
            </p>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                <ul class="list-disc list-inside text-red-700 font-ui-label text-ui-label space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Fields -->
        <div class="space-y-6">

            <!-- Name -->
            <div>
                <label class="block mb-2 font-ui-label text-ui-label font-medium text-on-surface">
                    Full Name
                </label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="John Doe"
                    class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-2.5
                    text-on-surface font-ui-label text-ui-label
                    focus:outline-none focus:ring-2 focus:ring-primary/20
                    focus:border-primary transition-all">
                @error('name')
                    <p class="mt-1 text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email & Username Row -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block mb-2 font-ui-label text-ui-label font-medium text-on-surface">
                        Email
                    </label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                        placeholder="john@example.com"
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
                    <input type="text" name="username" value="{{ old('username', $user->username) }}"
                        placeholder="johndoe"
                        class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-2.5
                    text-on-surface font-ui-label text-ui-label
                        focus:outline-none focus:ring-2 focus:ring-primary/20
                        focus:border-primary transition-all">
                    @error('username')
                        <p class="mt-1 text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Password Row -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block mb-2 font-ui-label text-ui-label font-medium text-on-surface">
                        Password {{ isset($user->id) ? '(leave blank to keep current)' : '' }}
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
                        Confirm Password
                    </label>
                    <input type="password" name="password_confirmation" placeholder="••••••••"
                        class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-2.5
                    text-on-surface font-ui-label text-ui-label
                        focus:outline-none focus:ring-2 focus:ring-primary/20
                        focus:border-primary transition-all">
                </div>
            </div>

            <!-- Status & Type Row -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block mb-2 font-ui-label text-ui-label font-medium text-on-surface">
                        Status
                    </label>
                    <select name="status"
                        class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-2.5
                    text-on-surface font-ui-label text-ui-label
                        focus:outline-none focus:ring-2 focus:ring-primary/20
                        focus:border-primary transition-all">
                        @foreach (['active', 'inactive'] as $status)
                            <option value="{{ $status }}"
                                {{ old('status', $user->status ?? 'active') === $status ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                    @error('status')
                        <p class="mt-1 text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block mb-2 font-ui-label text-ui-label font-medium text-on-surface">
                        User Type
                    </label>
                    <select name="type"
                        class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-2.5
                    text-on-surface font-ui-label text-ui-label
                        focus:outline-none focus:ring-2 focus:ring-primary/20
                        focus:border-primary transition-all">
                        @foreach (['user', 'admin', 'super-admin'] as $type)
                            <option value="{{ $type }}"
                                {{ old('type', $user->type ?? 'user') === $type ? 'selected' : '' }}>
                                {{ ucfirst($type) }}
                            </option>
                        @endforeach
                    </select>
                    @error('type')
                        <p class="mt-1 text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Roles -->
            <div>
                <label class="block mb-3 font-ui-label text-ui-label font-medium text-on-surface">
                    Assign Roles
                </label>
                <p class="text-metadata font-metadata text-on-surface-variant mb-4">
                    Select the roles this user should have. A user can belong to multiple roles.
                </p>

                @php
                    $userRoleIds = old('roles', isset($user->id) ? $user->roles->pluck('id')->toArray() : []);
                @endphp

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @foreach ($roles as $role)
                        <label
                            class="flex items-center gap-3 p-3 rounded-xl border border-outline-variant hover:border-primary hover:bg-surface-container-low cursor-pointer transition-all group">
                            <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                                {{ in_array($role->id, $userRoleIds) ? 'checked' : '' }}
                                class="w-4 h-4 rounded border-outline text-primary focus:ring-primary">
                            <div>
                                <span
                                    class="font-ui-label text-ui-label text-on-surface group-hover:text-primary transition-colors">{{ $role->name }}</span>
                                <span class="block font-metadata text-metadata text-on-surface-variant">
                                    {{ count($role->abilities ?? []) }} {{ Str::plural('permission', count($role->abilities ?? [])) }}
                                </span>
                            </div>
                        </label>
                    @endforeach
                </div>

                @if ($roles->isEmpty())
                    <p class="text-on-surface-variant font-metadata text-metadata italic">
                        No roles available. <a href="{{ route('admin.roles.create') }}"
                            class="text-primary underline">Create one first</a>.
                    </p>
                @endif

                @error('roles')
                    <p class="mt-1 text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-end gap-3 mt-10">
            <a href="{{ route('admin.users.index') }}"
                class="px-5 py-2.5 rounded-lg border border-outline-variant
                text-on-surface-variant font-ui-label text-ui-label hover:bg-surface-container transition-colors">
                Cancel
            </a>

            <button type="submit"
                class="bg-primary text-on-primary px-6 py-2.5 rounded-lg
                font-ui-label text-ui-label
                hover:opacity-90 transition-all shadow-sm">
                {{ isset($user->id) ? 'Update User' : 'Create User' }}
            </button>
        </div>
    </div>
</form>
