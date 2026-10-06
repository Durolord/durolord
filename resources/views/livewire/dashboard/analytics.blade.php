<div class="space-y-8">
    <x-duro.page-header
        title="Service analytics"
        description="Monthly activity, messages, speakers and hymn usage across all services."
        :breadcrumbs="['Workspace' => route('dashboard'), 'Analytics' => null]"
    />

    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
        <x-duro.stat label="Services this month" :value="$servicesThisMonth" icon="calendar" />
        <x-duro.stat label="Messages" :value="$messageCount" icon="message" />
        <x-duro.stat label="Unique speakers" :value="$uniqueSpeakers" icon="users" />
        <x-duro.stat label="Top hymn count" :value="$topHymns->first()->total ?? 0" icon="star" />
    </div>

    <div class="grid gap-4 lg:grid-cols-2">
        <x-duro.card class="space-y-3">
            <div class="flex items-center justify-between">
                <h3 class="duro-heading text-base">Most-used hymns</h3>
                <x-duro.badge variant="electric">Top 5</x-duro.badge>
            </div>
            <div class="space-y-2 text-sm">
                @forelse ($topHymns as $hymn)
                    <div class="flex items-center justify-between rounded-ui border border-line px-3 py-2">
                        <div class="font-semibold text-ink">Hymn {{ $hymn->hymn_number }}</div>
                        <x-duro.badge variant="electric">{{ $hymn->total }}</x-duro.badge>
                    </div>
                @empty
                    <p class="text-xs text-ink-muted">No hymn data yet.</p>
                @endforelse
            </div>
        </x-duro.card>

        <x-duro.card class="space-y-3">
            <div class="flex items-center justify-between">
                <h3 class="duro-heading text-base">Services by week</h3>
                <x-duro.badge variant="electric">Trend</x-duro.badge>
            </div>
            <div class="space-y-2 text-sm">
                @forelse ($servicesByWeek as $row)
                    <div class="flex items-center justify-between rounded-ui border border-line px-3 py-2">
                        <div class="text-ink-muted">Week {{ $row['label'] }}</div>
                        <x-duro.badge variant="electric">{{ $row['total'] }}</x-duro.badge>
                    </div>
                @empty
                    <p class="text-xs text-ink-muted">No services recorded yet.</p>
                @endforelse
            </div>
        </x-duro.card>
    </div>
</div>
