<?php

namespace App\Livewire\Landing;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Showcase extends Component
{
    /**
     * @return array<int, array{title: string, description: string, icon: string, route: string, components: array<int, string>}>
     */
    protected function categories(): array
    {
        return [
            [
                'title' => 'Forms',
                'description' => 'Inputs, selects, pickers, editors, uploads, repeaters and builders with validation states baked in.',
                'icon' => 'edit',
                'route' => 'form-components',
                'components' => ['input', 'textarea', 'select', 'multi-select', 'checkbox', 'checkbox-list', 'radio', 'switch', 'toggle-buttons', 'slider', 'date-picker', 'time-picker', 'date-time-picker', 'color-picker', 'tags-input', 'key-value', 'file-upload', 'markdown-editor', 'rich-editor', 'code-editor', 'repeater', 'builder', 'otp-input', 'rating'],
            ],
            [
                'title' => 'Tables',
                'description' => 'Composable data tables: sortable headers, bulk selection, filters, grouped rows and empty states.',
                'icon' => 'table',
                'route' => 'table-components',
                'components' => ['table', 'head', 'header-cell', 'row', 'cell', 'text-column', 'image-column', 'icon-column', 'badge-column', 'color-column', 'input-column', 'select-column', 'toggle-column', 'checkbox-column', 'actions-column', 'group-row', 'summary-row', 'empty-state', 'filters'],
            ],
            [
                'title' => 'Elements & Overlays',
                'description' => 'Buttons, badges, alerts, modals, slide-overs, dropdowns, tabs, accordions, toasts, stats and more.',
                'icon' => 'layers',
                'route' => 'elements',
                'components' => ['button', 'badge', 'alert', 'card', 'modal', 'slide-over', 'dropdown', 'tabs', 'accordion', 'toasts', 'tooltip', 'avatar', 'avatar-group', 'stat', 'progress', 'skeleton', 'stepper', 'timeline', 'breadcrumbs', 'kbd', 'divider', 'empty-state', 'page-header', 'theme-switcher'],
            ],
        ];
    }

    public function render(): View
    {
        return view('livewire.landing.showcase', [
            'categories' => $this->categories(),
            'families' => config('duro.families'),
            'themes' => config('duro.themes'),
            'traits' => config('duro.traits'),
        ])->layout('components.layouts.kit', [
            'title' => 'UI Kit',
        ]);
    }
}
