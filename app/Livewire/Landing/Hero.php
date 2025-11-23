<?php

namespace App\Livewire\Landing;

use Livewire\Component;

class Hero extends Component
{
    public string $cta = 'Enter the Realm';
    public int $clicks = 0;

    public function incrementClicks(): void
    {
        $this->clicks++;
        $this->cta = $this->clicks > 0
            ? 'Welcome back, Weaver'
            : 'Enter the Realm';
    }

    public function render()
    {
        return view('livewire.landing.hero')
            ->layout('layouts.app', [
                'title' => 'Durolord — Maker of Digital Realms',
            ]);
    }
}
