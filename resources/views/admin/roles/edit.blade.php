<x-layout title="Edit Role">
    @include('admin.roles._form', [
        'action' => route('admin.roles.update', $role),
        'method' => 'PUT',
    ])
</x-layout>
