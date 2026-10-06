<?php

namespace App\Livewire\Showcase;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Elements extends Component
{
    public int $rating = 4;

    public string $otp = '';

    public int $step = 2;

    public function notify(string $variant = 'success'): void
    {
        $messages = [
            'success' => ['Changes saved', 'Your realm settings were updated.'],
            'info' => ['Heads up', 'A new version of the UI kit is available.'],
            'warning' => ['Storage almost full', 'You have used 90% of your quota.'],
            'danger' => ['Sync failed', 'We could not reach the server. Retrying…'],
        ];

        [$title, $body] = $messages[$variant] ?? $messages['success'];

        $this->dispatch('duro-toast', title: $title, body: $body, variant: $variant);
    }

    public function nextStep(): void
    {
        $this->step = $this->step >= 4 ? 1 : $this->step + 1;
    }

    public function render(): View
    {
        return view('livewire.showcase.elements')
            ->layout('components.layouts.app', [
                'title' => 'Elements',
            ]);
    }
}
