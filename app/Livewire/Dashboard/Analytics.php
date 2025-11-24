<?php

namespace App\Livewire\Dashboard;

use App\Models\HymnUsage;
use App\Models\Message;
use App\Models\Service;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Analytics extends Component
{
    public function render(): View
    {
        $now = now();
        $servicesThisMonth = Service::query()
            ->whereBetween('date', [$now->clone()->startOfMonth(), $now->clone()->endOfMonth()])
            ->count();

        $messageCount = Message::count();
        $uniqueSpeakers = Message::distinct('speaker_name')->count();

        $topHymns = HymnUsage::query()
            ->select('hymn_number')
            ->selectRaw('count(*) as total')
            ->groupBy('hymn_number')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $servicesByWeek = Service::query()
            ->selectRaw('YEARWEEK(date, 1) as year_week, count(*) as total')
            ->orderBy('year_week')
            ->get()
            ->map(function ($row) {
                return [
                    'label' => $row->year_week,
                    'total' => $row->total,
                ];
            });

        return view('livewire.dashboard.analytics', [
            'servicesThisMonth' => $servicesThisMonth,
            'messageCount' => $messageCount,
            'uniqueSpeakers' => $uniqueSpeakers,
            'topHymns' => $topHymns,
            'servicesByWeek' => $servicesByWeek,
        ])->layout('layouts.duro', [
            'title' => 'Analytics',
        ]);
    }
}
