<?php

namespace App\View\Components\Duro;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert extends Component
{
    public string $variant;
    public ?string $title;

    public function __construct(string $variant = 'info', ?string $title = null)
    {
        $this->variant = $variant;
        $this->title = $title;
    }

    public function render(): View|Closure|string
    {
        return view('components.duro.alert');
    }
}
