<?php

namespace App\Livewire\Showcase;

use Livewire\Component;
use Illuminate\Support\Collection;

class TableComponents extends Component
{
    public string $search = '';
    public ?string $filterRole = '';
    public ?string $filterStatus = '';
    public array $selected = [];

    /** @var array<int, bool> */
    public array $active = [];

    /** @var array<int, array> */
    protected array $allRows = [];

    public array $roleOptions = [
        'developer' => 'Developer',
        'designer'  => 'Designer',
        'architect' => 'Architect',
        'overseer'  => 'Overseer',
    ];

    public array $statusOptions = [
        'active'  => 'Active',
        'invited' => 'Invited',
        'paused'  => 'Paused',
    ];

    public function mount(): void
    {
        // Demo data
        $this->allRows = [
            [
                'id'      => 1,
                'name'    => 'Aeris Kallor',
                'email'   => 'aeris@realms.dev',
                'role'    => 'developer',
                'status'  => 'active',
                'avatar'  => 'https://ui-avatars.com/api/?name=Aeris+Kallor',
                'accent'  => '#22e9ff',
                'active'  => true,
            ],
            [
                'id'      => 2,
                'name'    => 'Lyra Voss',
                'email'   => 'lyra@design.run',
                'role'    => 'designer',
                'status'  => 'invited',
                'avatar'  => 'https://ui-avatars.com/api/?name=Lyra+Voss',
                'accent'  => '#d4af37',
                'active'  => false,
            ],
            [
                'id'      => 3,
                'name'    => 'Corin Vale',
                'email'   => 'corin@systems.io',
                'role'    => 'architect',
                'status'  => 'paused',
                'avatar'  => 'https://ui-avatars.com/api/?name=Corin+Vale',
                'accent'  => '#7c3aed',
                'active'  => true,
            ],
        ];

        foreach ($this->allRows as $row) {
            $this->active[$row['id']] = $row['active'];
        }
    }

    public function getRowsProperty(): Collection
    {
        $rows = collect($this->allRows);

        if ($this->search !== '') {
            $rows = $rows->filter(function ($row) {
                return str_contains(strtolower($row['name']), strtolower($this->search))
                    || str_contains(strtolower($row['email']), strtolower($this->search));
            });
        }

        if ($this->filterRole) {
            $rows = $rows->where('role', $this->filterRole);
        }

        if ($this->filterStatus) {
            $rows = $rows->where('status', $this->filterStatus);
        }

        // Sync "active" state from $this->active so toggles reflect Livewire state
        return $rows->map(function ($row) {
            $row['active'] = $this->active[$row['id']] ?? $row['active'];
            return $row;
        });
    }

    public function resetFilters(): void
    {
        $this->search = '';
        $this->filterRole = '';
        $this->filterStatus = '';
    }

    public function render()
    {
        return view('livewire.showcase.table-components')
            ->layout('layouts.app', [
                'title' => 'Table Components — Durolord UI',
            ]);
    }
}
