<?php

namespace App\Livewire\Services;

use App\Models\Service;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $search = '';

    public ?string $dateFrom = null;

    public ?string $dateTo = null;

    public string $hasMessages = 'any';

    public string $hasHymns = 'any';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingDateFrom(): void
    {
        $this->resetPage();
    }

    public function updatingDateTo(): void
    {
        $this->resetPage();
    }

    public function updatingHasMessages(): void
    {
        $this->resetPage();
    }

    public function updatingHasHymns(): void
    {
        $this->resetPage();
    }

    public function render(): View
    {
        $services = Service::query()
            ->withCount(['messages', 'speakerActivities', 'hymnUsages'])
            ->when($this->search, function ($query) {
                $query->where(function ($inner) {
                    $inner->where('title', 'like', '%'.$this->search.'%')
                        ->orWhereDate('date', $this->search);
                });
            })
            ->when($this->dateFrom, fn ($query) => $query->whereDate('date', '>=', $this->dateFrom))
            ->when($this->dateTo, fn ($query) => $query->whereDate('date', '<=', $this->dateTo))
            ->when($this->hasMessages !== 'any', function ($query) {
                if ($this->hasMessages === 'yes') {
                    $query->whereHas('messages');
                } else {
                    $query->doesntHave('messages');
                }
            })
            ->when($this->hasHymns !== 'any', function ($query) {
                if ($this->hasHymns === 'yes') {
                    $query->whereHas('hymnUsages');
                } else {
                    $query->doesntHave('hymnUsages');
                }
            })
            ->orderByDesc('date')
            ->orderByDesc('id')
            ->paginate(10);

        return view('livewire.services.index', [
            'services' => $services,
        ])->layout('layouts.duro', [
            'title' => 'Services',
        ]);
    }
}
