<div class="space-y-6">
    <div class="flex items-center justify-between gap-3">
        <div class="space-y-1">
            <x-duro.badge variant="gold" class="w-max">Analytics</x-duro.badge>
            <h1 class="text-2xl font-semibold text-shadow-900 dark:text-neutralfog-50">Service analytics</h1>
            <p class="text-sm text-neutral-700 dark:text-neutralfog-300">Restricted to noreply@durolord.com</p>
        </div>
    </div>

    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
        <x-duro.card class="space-y-1 bg-white/80 dark:bg-shadow-900/70">
            <div class="text-xs text-neutral-600 dark:text-neutralfog-400 uppercase tracking-[0.08em]">Services this month</div>
            <div class="text-3xl font-semibold text-electric-700 dark:text-electric-300">{{ $servicesThisMonth }}</div>
        </x-duro.card>
        <x-duro.card class="space-y-1 bg-white/80 dark:bg-shadow-900/70">
            <div class="text-xs text-neutral-600 dark:text-neutralfog-400 uppercase tracking-[0.08em]">Messages</div>
            <div class="text-3xl font-semibold text-electric-700 dark:text-electric-300">{{ $messageCount }}</div>
        </x-duro.card>
        <x-duro.card class="space-y-1 bg-white/80 dark:bg-shadow-900/70">
            <div class="text-xs text-neutral-600 dark:text-neutralfog-400 uppercase tracking-[0.08em]">Unique speakers</div>
            <div class="text-3xl font-semibold text-electric-700 dark:text-electric-300">{{ $uniqueSpeakers }}</div>
        </x-duro.card>
        <x-duro.card class="space-y-1 bg-white/80 dark:bg-shadow-900/70">
            <div class="text-xs text-neutral-600 dark:text-neutralfog-400 uppercase tracking-[0.08em]">Top hymn count</div>
            <div class="text-3xl font-semibold text-electric-700 dark:text-electric-300">{{ $topHymns->first()->total ?? 0 }}</div>
        </x-duro.card>
    </div>

    <div class="grid gap-4 lg:grid-cols-2">
        <x-duro.card class="space-y-3 bg-white/80 dark:bg-shadow-900/70">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-semibold text-shadow-900 dark:text-neutralfog-50">Most-used hymns</h3>
                <x-duro.badge variant="electric">Top 5</x-duro.badge>
            </div>
            <div class="space-y-2 text-sm">
                @forelse ($topHymns as $hymn)
                    <div class="flex items-center justify-between rounded-lg border border-neutralfog-200 dark:border-shadow-800 px-3 py-2">
                        <div class="font-semibold text-shadow-900 dark:text-neutralfog-100">Hymn {{ $hymn->hymn_number }}</div>
                        <x-duro.badge variant="electric">{{ $hymn->total }}</x-duro.badge>
                    </div>
                @empty
                    <p class="text-xs text-neutral-600 dark:text-neutralfog-400">No hymn data yet.</p>
                @endforelse
            </div>
        </x-duro.card>

        <x-duro.card class="space-y-3 bg-white/80 dark:bg-shadow-900/70">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-semibold text-shadow-900 dark:text-neutralfog-50">Services by week</h3>
                <x-duro.badge variant="electric">Trend</x-duro.badge>
            </div>
            <div class="space-y-2 text-sm">
                @forelse ($servicesByWeek as $row)
                    <div class="flex items-center justify-between rounded-lg border border-neutralfog-200 dark:border-shadow-800 px-3 py-2">
                        <div class="text-neutral-700 dark:text-neutralfog-200">Week {{ $row['label'] }}</div>
                        <x-duro.badge variant="electric">{{ $row['total'] }}</x-duro.badge>
                    </div>
                @empty
                    <p class="text-xs text-neutral-600 dark:text-neutralfog-400">No services recorded yet.</p>
                @endforelse
            </div>
        </x-duro.card>
    </div>
</div>
