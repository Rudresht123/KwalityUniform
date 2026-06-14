<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Show extends Component
{
    public string $url;
    public string $title;
    public string $modal;
    public bool $isModal;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $url = '#',
        string $title = 'View Details',
        string $modal = 'showModal',
        bool $isModal = false
    ) {
        $this->url = $url;
        $this->title = $title;
        $this->modal = $modal;
        $this->isModal = $isModal;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.show');
    }
}