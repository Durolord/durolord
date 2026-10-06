<div class="space-y-6">
    <x-duro.page-header
        title="Service tracking"
        description="Search, filter, and review services with message, speaker, and hymn counts."
        :breadcrumbs="['Workspace' => route('dashboard'), 'Services' => null]"
    >
        <x-slot:actions>
            <x-duro.button :href="route('services.create')" icon="plus">New service</x-duro.button>
        </x-slot:actions>
    </x-duro.page-header>

    {{-- Filters --}}
    <x-duro.card class="space-y-4">
        <div class="grid gap-3 md:grid-cols-2 lg:grid-cols-4">
            <x-duro.input wire:model.live.debounce.300ms="search" name="search" label="Search title/date" placeholder="Search..." />

            <x-duro.date-picker wire:model.live="dateFrom" name="dateFrom" label="Date from" />
            <x-duro.date-picker wire:model.live="dateTo" name="dateTo" label="Date to" />

            <x-duro.select
                wire:model.live="hasMessages"
                name="hasMessages"
                label="Has messages?"
                :options="['any' => 'Any', 'yes' => 'Yes', 'no' => 'No']"
            />

            <x-duro.select
                wire:model.live="hasHymns"
                name="hasHymns"
                label="Has hymns?"
                :options="['any' => 'Any', 'yes' => 'Yes', 'no' => 'No']"
            />
        </div>
    </x-duro.card>

    {{-- Table --}}
    <x-duro.card padding="none" class="overflow-hidden">
        <x-duro.table.table>
            <x-duro.table.head>
                <x-duro.table.header-cell>Date</x-duro.table.header-cell>
                <x-duro.table.header-cell>Title</x-duro.table.header-cell>
                <x-duro.table.header-cell class="text-center">Messages</x-duro.table.header-cell>
                <x-duro.table.header-cell class="text-center">Speaker acts</x-duro.table.header-cell>
                <x-duro.table.header-cell class="text-center">Hymns</x-duro.table.header-cell>
                <x-duro.table.header-cell class="text-right">Actions</x-duro.table.header-cell>
            </x-duro.table.head>

            <x-duro.table.body>
                @forelse ($services as $service)
                    <x-duro.table.row :key="$service->id">
                        <x-duro.table.cell class="whitespace-nowrap">
                            <div class="font-semibold text-ink">{{ \Illuminate\Support\Carbon::parse($service->date)->format('M d, Y') }}</div>
                        </x-duro.table.cell>

                        <x-duro.table.cell>
                            <div class="text-sm font-semibold text-ink">{{ $service->title ?? 'Untitled service' }}</div>
                            <div class="text-xs text-ink-muted line-clamp-1">{{ $service->notes }}</div>
                        </x-duro.table.cell>

                        <x-duro.table.cell class="text-center">
                            <x-duro.badge variant="electric">{{ $service->messages_count }}</x-duro.badge>
                        </x-duro.table.cell>

                        <x-duro.table.cell class="text-center">
                            <x-duro.badge variant="electric">{{ $service->speaker_activities_count }}</x-duro.badge>
                        </x-duro.table.cell>

                        <x-duro.table.cell class="text-center">
                            <x-duro.badge variant="electric">{{ $service->hymn_usages_count }}</x-duro.badge>
                        </x-duro.table.cell>

                        <x-duro.table.actions-column>
                            <x-duro.button :href="route('services.edit', $service)" size="sm" variant="secondary" icon="edit">Edit</x-duro.button>
                        </x-duro.table.actions-column>
                    </x-duro.table.row>
                @empty
                    <x-duro.table.empty-state
                        title="No services found"
                        description="Adjust filters or create the first service."
                    />
                @endforelse
            </x-duro.table.body>
        </x-duro.table.table>

        <div class="px-3 py-2">
            {{ $services->links() }}
        </div>
    </x-duro.card>
</div>
