<x-layout title="Edit Category">
    @include('dashboard.categories._form', [
    'category' => $category,
    'action' => route('dashboard.categories.update', $category->id),
    'method' => 'PUT',
    'title' => 'Edit Category',
    ])
</x-layout>
