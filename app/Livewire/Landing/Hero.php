<?php

namespace App\Livewire\Landing;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\File;
use Livewire\Component;

class Hero extends Component
{
    public function render(): View
    {
        return view('livewire.landing.hero', [
            'portfolio' => config('portfolio'),
            'themes' => config('duro.themes'),
            'componentCount' => $this->componentCount(),
        ])->layout('components.layouts.site', [
            'title' => config('portfolio.name').' — '.config('portfolio.role'),
        ]);
    }

    /**
     * Count the Blade components that make up the Duro UI kit (icons excluded).
     */
    protected function componentCount(): int
    {
        $path = resource_path('views/components/duro');

        if (! File::isDirectory($path)) {
            return 0;
        }

        return collect(File::allFiles($path))
            ->reject(fn ($file) => str_starts_with($file->getRelativePath(), 'icons'))
            ->count();
    }
}
