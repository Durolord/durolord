<?php

namespace App\View\Components\Duro;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Badge extends Component
{
    public string $variant;

    public function __construct(string $variant = 'info')
    {
        $this->variant = $variant;
    }

    public function render(): View|Closure|string
    {
        return view('components.duro.badge');
    }
}
