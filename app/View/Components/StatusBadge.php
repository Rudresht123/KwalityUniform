<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatusBadge extends Component
{
    public $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function render(): View|Closure|string
    {
        return view('components.status-badge');
    }
}