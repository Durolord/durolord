<?php

namespace App\View\Components\Duro;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    public string $name;
    public ?string $label;
    public string $type;

    public function __construct(string $name, ?string $label = null, string $type = 'text')
    {
        $this->name = $name;
        $this->label = $label ?? ucfirst(str_replace('_', ' ', $name));
        $this->type = $type;
    }

    public function render(): View|Closure|string
    {
        return view('components.duro.input');
    }
}
