<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EditButton extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $url = '#',
        public string $title = 'Edit Record',
        public string $modal = 'editModal',
        public bool $isModal =false
    )
    {
        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.edit-button');
    }
}
