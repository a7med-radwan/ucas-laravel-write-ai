<x-layout title="Edit User">
    @include('admin.users._form', [
        'action' => route('admin.users.update', $user),
        'method' => 'PUT',
    ])
</x-layout>
