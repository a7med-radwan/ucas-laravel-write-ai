<x-layout title="Manage Roles">
    <div class="pt-8 pb-section-gap px-gutter max-w-container-max mx-auto">
        <header class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
            <div class="max-w-2xl">
                <h1 class="font-display-lg-mobile text-[22px] font-bold text-on-surface truncate">Role Management</h1>
                <p class="font-body-md text-on-surface-variant">Define roles and assign permissions to control access across the platform.</p>
            </div>
            <a href="{{ route('admin.roles.create') }}"
                class="inline-flex items-center gap-2 bg-primary text-on-primary px-5 py-2.5 rounded-lg font-ui-button text-ui-button shadow-sm hover:opacity-90 transition-all shrink-0">
                <span class="material-symbols-outlined text-[20px]">add</span>
                Create Role
            </a>
        </header>

        @if (session()->has('status'))
            <div class="mb-6 p-4 bg-green-50 text-green-800 rounded-xl border border-green-200 flex items-center gap-3">
                <span class="material-symbols-outlined text-green-600">check_circle</span>
                <span class="font-ui-label text-ui-label">{{ session('status') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($roles as $role)
                <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-5 hover:border-primary/40 transition-colors flex flex-col">
                    <div class="flex justify-between items-start gap-3 mb-3">
                        <div class="min-w-0">
                            <h3 class="font-headline-md text-lg font-bold text-on-surface truncate">{{ $role->name }}</h3>
                            <p class="font-metadata text-metadata text-on-surface-variant">
                                                            <!-- بتحول الكلمة للجمع ع حسب العدد -->
                                {{ $role->users_count }} {{ Str::plural('user', $role->users_count) }}
                                · {{ $role->created_at->format('M j, Y') }}
                            </p>
                        </div>
                        <div class="flex gap-0.5 shrink-0">
                            <a href="{{ route('admin.roles.edit', $role) }}"
                                class="p-2 text-on-surface-variant hover:bg-surface-container hover:text-primary rounded-lg transition-all"
                                title="Edit">
                                <span class="material-symbols-outlined text-[20px]">edit</span>
                            </a>
                            <button
                                onclick="confirm('Are you sure you want to delete this role?') ? document.getElementById('deleterole{{ $role->id }}').submit() : null;"
                                class="p-2 text-on-surface-variant hover:bg-error-container hover:text-error rounded-lg transition-all"
                                title="Delete">
                                <span class="material-symbols-outlined text-[20px]">delete</span>
                            </button>
                            <form class="hidden" id="deleterole{{ $role->id }}" action="{{ route('admin.roles.destroy', $role) }}" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-1.5 mt-auto">
                        @forelse ($role->abilities ?? [] as $ability)
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-primary-fixed text-on-primary-fixed text-[11px] font-bold">
                                {{ config('abilities')[$ability] ?? $ability }}
                            </span>
                        @empty
                            <span class="text-metadata font-metadata text-on-surface-variant italic">No permissions assigned</span>
                        @endforelse
                    </div>
                </div>
            @endforeach

            <a href="{{ route('admin.roles.create') }}"
                class="bg-surface-container-lowest border border-dashed border-outline-variant rounded-xl p-5 flex flex-col items-center justify-center text-center min-h-[140px] text-on-surface-variant hover:border-primary/50 hover:text-primary transition-colors">
                <span class="material-symbols-outlined text-[32px] mb-2">add</span>
                <span class="font-ui-label text-ui-label font-medium">Add New Role</span>
            </a>
        </div>
    </div>
</x-layout>
