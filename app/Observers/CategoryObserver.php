<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryObserver
{
    /**
     * Handle the Category "creating" event.
     */
    public function creating(Category $category): void
    {
        if (empty($category->slug)) {
            $category->slug = Str::slug($category->name);
        }
    }

    public function restored(Category $category): void
    {
        $category->posts()->update([
                'deleted_at' => null,
            ]);

    }
    public function deleted(Category $category): void
    {
        $category->posts()->delete();

    }
}
