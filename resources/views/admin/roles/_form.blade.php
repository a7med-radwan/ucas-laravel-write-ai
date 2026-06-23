<form action="{{ $action ?? route('admin.roles.store') }}" method="POST"
    class="pt-8 pb-section-gap px-gutter max-w-3xl mx-auto">
    @csrf
    @method($method ?? 'POST')

    <a href="{{ route('admin.roles.index') }}" class="inline-flex items-center gap-1.5 text-on-surface-variant hover:text-primary font-ui-label text-ui-label mb-6 transition-colors">
        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
        Back to Roles
    </a>

    <div class="bg-surface-container-lowest rounded-xl border border-outline-variant p-6 sm:p-8 shadow-sm">

        <!-- Header -->
        <div class="mb-8">
            <h2 class="font-display-lg text-display-lg text-on-surface">
                {{ isset($role->id) ? 'Edit Role' : 'Create Role' }}
            </h2>
            <p class="text-secondary font-body-md mt-2">
                Define a role with specific permissions to control user access across the platform.
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
        <div class="space-y-8">

            <!-- Name -->
            <div>
                <label class="block mb-2 font-ui-label text-ui-label font-medium text-on-surface">
                    Role Name
                </label>
                <input type="text" name="name" value="{{ old('name', $role->name) }}"
                    placeholder="e.g. Editor, Moderator, Content Manager"
                    class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-2.5
                    text-on-surface font-ui-label text-ui-label
                    focus:outline-none focus:ring-2 focus:ring-primary/20
                    focus:border-primary transition-all">
                @error('name')
                    <p class="mt-1 text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Abilities / Permissions -->
            <div>
                <label class="block mb-3 font-ui-label text-ui-label font-medium text-on-surface">
                    Permissions
                </label>
                <p class="text-metadata font-metadata text-on-surface-variant mb-4">
                    Select the abilities this role should have. Users assigned to this role will inherit all checked
                    permissions.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @foreach ($abilities as $key => $label)
                        <label
                            class="flex items-center gap-3 p-3 rounded-xl border border-outline-variant hover:border-primary hover:bg-surface-container-low cursor-pointer transition-all group">
                            <input type="checkbox" name="abilities[]" value="{{ $key }}"
                                {{ in_array($key, old('abilities', $role->abilities ?? [])) ? 'checked' : '' }}
                                class="w-4 h-4 rounded border-outline text-primary focus:ring-primary">
                            <div>
                                <span
                                    class="font-ui-label text-ui-label text-on-surface group-hover:text-primary transition-colors">{{ $label }}</span>
                                <span
                                    class="block font-metadata text-metadata text-on-surface-variant">{{ $key }}</span>
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-end gap-3 mt-10">
            <a href="{{ route('admin.roles.index') }}"
                class="px-5 py-2.5 rounded-lg border border-outline-variant
                text-on-surface-variant font-ui-label text-ui-label hover:bg-surface-container transition-colors">
                Cancel
            </a>

            <button type="submit"
                class="bg-primary text-on-primary px-6 py-2.5 rounded-lg
                font-ui-label text-ui-label
                hover:opacity-90 transition-all shadow-sm">
                {{ isset($role->id) ? 'Update Role' : 'Create Role' }}
            </button>
        </div>
    </div>
</form>
