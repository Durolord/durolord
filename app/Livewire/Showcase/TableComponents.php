<?php

namespace App\Livewire\Showcase;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
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

    public string $search = '';

    public string $role = '';

    public string $status = '';

    public string $sortBy = 'name';

    public string $sortDirection = 'asc';

    /** @var array<int, string> */
    public array $selected = [];

    /** @var array<string, string> */
    public array $statusColors = [
        'active' => 'success',
        'invited' => 'info',
        'paused' => 'warning',
        'archived' => 'neutral',
    ];

    public function sort(string $column): void
    {
        if (! in_array($column, ['name', 'role', 'status', 'team'], true)) {
            return;
        }

        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';

            return;
        }

        $this->sortBy = $column;
        $this->sortDirection = 'asc';
    }

    public function resetFilters(): void
    {
        $this->reset(['search', 'role', 'status']);
    }

    public function archiveSelected(): void
    {
        $count = count($this->selected);

        $this->rows = collect($this->rows)
            ->map(fn (array $row) => in_array((string) $row['id'], $this->selected, true) ? [...$row, 'status' => 'archived'] : $row)
            ->all();

        $this->selected = [];

        $this->dispatch('duro-toast', title: "Archived {$count} ".str('member')->plural($count), body: 'They can be restored from the archive at any time.', variant: 'success');
    }

    /**
     * @return Collection<int, array<string, mixed>>
     */
    #[Computed]
    public function filteredRows(): Collection
    {
        $search = mb_strtolower(trim($this->search));

        $rows = collect($this->rows)
            ->when($search !== '', fn (Collection $rows) => $rows->filter(
                fn (array $row) => str_contains(mb_strtolower($row['name'].' '.$row['email'].' '.$row['team']), $search)
            ))
            ->when($this->role !== '', fn (Collection $rows) => $rows->where('role', $this->roles[$this->role] ?? $this->role))
            ->when($this->status !== '', fn (Collection $rows) => $rows->where('status', $this->status));

        return $rows
            ->sortBy($this->sortBy, SORT_NATURAL | SORT_FLAG_CASE, $this->sortDirection === 'desc')
            ->values();
    }

    /**
     * @return array<int, string>
     */
    #[Computed]
    public function visibleIds(): array
    {
        return $this->filteredRows->pluck('id')->map(fn ($id) => (string) $id)->all();
    }

    /**
     * @return Collection<string, Collection<int, array<string, mixed>>>
     */
    #[Computed]
    public function groupedRows(): Collection
    {
        return collect($this->rows)->groupBy('team');
    }

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

    public function render(): View
    {
        return view('livewire.showcase.table-components')
            ->layout('components.layouts.app', [
                'title' => 'Tables',
            ]);
    }
}
