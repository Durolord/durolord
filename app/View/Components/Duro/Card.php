<?php

namespace App\View\Components\Duro;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    public bool $hover;
    public string $padding;

    public function __construct(bool $hover = true, string $padding = 'md')
    {
        $this->hover = $hover;
        $this->padding = $padding;
    }

    public function render(): View|Closure|string
    {
        return view('components.duro.card');
    }
}
