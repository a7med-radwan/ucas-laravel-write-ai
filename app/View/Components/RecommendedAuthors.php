<?php

namespace App\View\Components;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RecommendedAuthors extends Component
{

    public $authors;

    /**
     * Create a new component instance.
     */
    public function __construct(public $title = 'Recommended Authors', $count = 3)
    {
        $this->authors = User::take($count)
            ->get()
            ->map(function ($user) {
                return [
                    'name' => $user->name,
                    'username' => '@' . strtolower(str_replace(' ', '', $user->name)),
                    'avatar' => 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=random',
                ];
            });
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.recommended-authors');
    }
}
