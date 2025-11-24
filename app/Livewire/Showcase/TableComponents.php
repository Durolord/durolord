<?php

namespace App\Livewire\Showcase;

use Livewire\Component;

class TableComponents extends Component
{
    /**
     * @var array<int, array<string, mixed>>
     */
    public array $rows = [];

    /** @var array<string, string> */
    public array $roles = [
        'developer' => 'Developer',
        'designer' => 'Designer',
        'architect' => 'Architect',
        'overseer' => 'Overseer',
    ];

    /** @var array<string, string> */
    public array $statuses = [
        'active' => 'Active',
        'invited' => 'Invited',
        'paused' => 'Paused',
        'archived' => 'Archived',
    ];

    public function mount(): void
    {
        $this->rows = [
            [
                'id' => 1,
                'name' => 'Duro Overseer',
                'email' => 'overseer@duro.test',
                'role' => 'Overseer',
                'status' => 'active',
                'team' => 'Core Systems',
                'color' => 'oklch(0.82 0.09 200)',
                'avatar' => null,
                'icon' => 'shield',
                'online' => true,
                'note' => 'Prefers async reviews',
            ],
            [
                'id' => 2,
                'name' => 'Ama Flux',
                'email' => 'ama@duro.test',
                'role' => 'Developer',
                'status' => 'invited',
                'team' => 'Gridworks',
                'color' => 'oklch(0.75 0.15 148)',
                'avatar' => null,
                'icon' => 'sparkles',
                'online' => false,
                'note' => 'New to project',
            ],
            [
                'id' => 3,
                'name' => 'Kelechi Sol',
                'email' => 'kelechi@duro.test',
                'role' => 'Designer',
                'status' => 'paused',
                'team' => 'Interface Guild',
                'color' => 'oklch(0.88 0.05 200)',
                'avatar' => null,
                'icon' => 'palette',
                'online' => true,
                'note' => 'Leading UI polish',
            ],
            [
                'id' => 4,
                'name' => 'Mira Dawn',
                'email' => 'mira@duro.test',
                'role' => 'Architect',
                'status' => 'archived',
                'team' => 'Mystic Systems',
                'color' => 'oklch(0.63 0.20 145.3)',
                'avatar' => null,
                'icon' => 'cube',
                'online' => false,
                'note' => 'Legacy advisor',
            ],
            [
                'id' => 5,
                'name' => 'Jonah Pike',
                'email' => 'jonah@duro.test',
                'role' => 'Developer',
                'status' => 'active',
                'team' => 'Gridworks',
                'color' => 'oklch(0.74 0.14 190)',
                'avatar' => null,
                'icon' => 'code',
                'online' => true,
                'note' => 'Focus: data layer',
            ],
            [
                'id' => 6,
                'name' => 'Priya Stone',
                'email' => 'priya@duro.test',
                'role' => 'Designer',
                'status' => 'active',
                'team' => 'Interface Guild',
                'color' => 'oklch(0.8 0.08 70)',
                'avatar' => null,
                'icon' => 'grid',
                'online' => true,
                'note' => 'Owns design tokens',
            ],
        ];
    }

    public function render()
    {
        return view('livewire.showcase.table-components')
            ->layout('layouts.app', [
                'title' => 'Table Components — Durolord UI',
            ]);
    }
}
