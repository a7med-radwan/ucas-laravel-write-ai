<x-layout title="Manage Users">
    <div class="pt-8 pb-section-gap px-gutter max-w-container-max mx-auto">
        <header class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
            <div class="max-w-2xl">
                <h1 class="font-display-lg text-display-lg-mobile sm:text-display-lg text-on-surface mb-1.5">User Management</h1>
                <p class="font-body-md text-on-surface-variant">Manage platform users, assign roles, and control account access levels.</p>
            </div>
            @can('create', App\Models\User::class)
            <a href="{{ route('admin.users.create') }}"
                class="inline-flex items-center gap-2 bg-primary text-on-primary px-5 py-2.5 rounded-lg font-ui-button text-ui-button shadow-sm hover:opacity-90 transition-all shrink-0">
                <span class="material-symbols-outlined text-[20px]">person_add</span>
                Create User
            </a>
            @endcan
        </header>

        @if (session()->has('status'))
            <div class="mb-6 p-4 bg-green-50 text-green-800 rounded-xl border border-green-200 flex items-center gap-3">
                <span class="material-symbols-outlined text-green-600">check_circle</span>
                <span class="font-ui-label text-ui-label">{{ session('status') }}</span>
            </div>
        @endif

        <div class="overflow-x-auto bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm">
            <table class="w-full text-left border-collapse min-w-[800px]">
                <thead>
                    <tr class="bg-surface-container-low border-b border-outline-variant">
                        <th class="px-5 py-3.5 font-ui-label text-ui-label font-bold text-on-surface uppercase tracking-wider">User</th>
                        <th class="px-5 py-3.5 font-ui-label text-ui-label font-bold text-on-surface uppercase tracking-wider">Email</th>
                        <th class="px-5 py-3.5 font-ui-label text-ui-label font-bold text-on-surface uppercase tracking-wider">Type</th>
                        <th class="px-5 py-3.5 font-ui-label text-ui-label font-bold text-on-surface uppercase tracking-wider">Status</th>
                        <th class="px-5 py-3.5 font-ui-label text-ui-label font-bold text-on-surface uppercase tracking-wider">Roles</th>
                        <th class="px-5 py-3.5 font-ui-label text-ui-label font-bold text-on-surface uppercase tracking-wider">Joined</th>
                        <th class="px-5 py-3.5 font-ui-label text-ui-label font-bold text-on-surface uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant">
                    @foreach ($users as $user)
                        @php
                            $typeBadge = match ($user->type) {
                                'super-admin' => 'bg-purple-50 text-purple-700 border-purple-200',
                                'admin' => 'bg-blue-50 text-blue-700 border-blue-200',
                                default => 'bg-gray-50 text-gray-600 border-gray-200',
                            };
                            $statusBadge = match ($user->status) {
                                'active' => ['bg-green-50 text-green-700 border-green-200', 'bg-green-500'],
                                'inactive' => ['bg-amber-50 text-amber-700 border-amber-200', 'bg-amber-500'],
                                'suspended' => ['bg-red-50 text-red-700 border-red-200', 'bg-red-500'],
                                default => ['bg-gray-50 text-gray-600 border-gray-200', 'bg-gray-400'],
                            };
                        @endphp
                        <tr class="hover:bg-surface/60 transition-colors">
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-primary-fixed flex items-center justify-center text-on-primary-fixed font-bold text-sm overflow-hidden shrink-0">
                                        @if ($user->avatar)
                                            <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                                        @else
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <div class="font-ui-label text-ui-label font-bold text-on-surface truncate">{{ $user->name }}</div>
                                        <div class="font-metadata text-metadata text-on-surface-variant truncate">{{ '@' . $user->username }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-4 font-ui-label text-ui-label text-on-surface-variant">{{ $user->email }}</td>
                            <td class="px-5 py-4">
                                <span class="inline-flex px-2.5 py-1 rounded-full text-[11px] font-bold border {{ $typeBadge }}">
                                    {{ ucfirst($user->type) }}
                                </span>
                            </td>
                            <td class="px-5 py-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold border {{ $statusBadge[0] }}">
                                    <span class="h-1.5 w-1.5 rounded-full {{ $statusBadge[1] }}"></span>
                                    {{ ucfirst($user->status) }}
                                </span>
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex flex-wrap gap-1">
                                    @forelse ($user->roles as $role)
                                        <span class="px-2 py-0.5 bg-primary-fixed text-on-primary-fixed rounded text-[11px] font-bold">{{ $role->name }}</span>
                                    @empty
                                        <span class="text-metadata font-metadata text-on-surface-variant italic">No roles</span>
                                    @endforelse
                                </div>
                            </td>
                            <td class="px-5 py-4 font-metadata text-metadata text-on-surface-variant whitespace-nowrap">
                                {{ $user->created_at->format('M j, Y') }}
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex justify-end gap-1">
                                    @can('update', $user)
                                    <a href="{{ route('admin.users.edit', $user) }}"
                                        class="p-2 text-on-surface-variant hover:text-primary hover:bg-surface-container rounded-lg transition-all"
                                        title="Edit">
                                        <span class="material-symbols-outlined text-[20px]">edit</span>
                                    </a>
                                    @endcan
                                    @can('delete', $user)
                                    <button
                                        onclick="confirm('Are you sure you want to delete this user?') ? document.getElementById('deleteuser{{ $user->id }}').submit() : null;"
                                        class="p-2 text-on-surface-variant hover:text-error hover:bg-error-container rounded-lg transition-all"
                                        title="Delete">
                                        <span class="material-symbols-outlined text-[20px]">delete</span>
                                    </button>
                                    <form class="hidden" id="deleteuser{{ $user->id }}" action="{{ route('admin.users.destroy', $user) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $users->links('pagination.custom-tailwind') }}
        </div>
    </div>
</x-layout>
