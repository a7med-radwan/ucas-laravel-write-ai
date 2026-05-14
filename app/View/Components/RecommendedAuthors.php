<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RecommendedAuthors extends Component
{

    public array $authors = [];
    public array $data = [
        [
            'name' => 'John Doe',
            'username' => '@johndoe',
            'avatar' => 'https://randomuser.me/api/portraits/men/1.jpg'
        ],
        [
            'name' => 'Jane Smith',
            'username' => '@janesmith',
            'avatar' => 'https://randomuser.me/api/portraits/women/1.jpg'
        ],
        [
            'name' => 'Bob Johnson',
            'username' => '@bobjohnson',
            'avatar' => 'https://randomuser.me/api/portraits/men/2.jpg'
        ]
    ];

    /**
     * Create a new component instance.
     */
    public function __construct(public $title = 'Recommended Authors', $count = 3)
    {
        $this->authors = array_slice($this->data, 0, $count);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.recommended-authors');
    }
}
