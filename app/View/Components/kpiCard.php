<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class KpiCard extends Component
{
    public $icon;
    public $iconClass;
    public $label;
    public $value;
    public $footer;
    public $footerClass;

    public function __construct(
        $icon = null,
        $iconClass = 'bg-primary-transparent text-primary',
        $label = '',
        $value = '',
        $footer = null,
        $footerClass = 'text-muted'
    ) {
        $this->icon = $icon;
        $this->iconClass = $iconClass;
        $this->label = $label;
        $this->value = $value;
        $this->footer = $footer;
        $this->footerClass = $footerClass;
    }

    public function render(): View|Closure|string
    {
        return view('components.kpi-card');
    }
}