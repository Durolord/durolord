<?php

namespace App\Livewire\Landing;

use Livewire\Component;

class Showcase extends Component
{
    public function render()
    {
        return view('livewire.landing.showcase')
            ->layout('layouts.app', [
                'title' => 'Showcase — Durolord UI',
            ]);
    }
}
