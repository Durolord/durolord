<div class="space-y-6">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div class="space-y-1">
            <x-duro.badge variant="gold" class="w-max">Services</x-duro.badge>
            <h1 class="text-2xl font-semibold text-shadow-900 dark:text-neutralfog-50">Service tracking</h1>
            <p class="text-sm text-neutral-700 dark:text-neutralfog-300">Search, filter, and review services with message, speaker, and hymn counts.</p>
        </div>

        <div class="flex gap-3">
            <x-duro.button type="button" class="justify-center" onclick="window.location='{{ route('services.create') }}'">New service</x-duro.button>
        </div>
    </div>

    {{-- Filters --}}
    <x-duro.card class="space-y-4 bg-white/80 dark:bg-shadow-900/70">
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
    <x-duro.card class="bg-white/85 dark:bg-shadow-900/70 overflow-hidden">
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
                            <div class="font-semibold text-shadow-900 dark:text-neutralfog-50">{{ \Illuminate\Support\Carbon::parse($service->date)->format('M d, Y') }}</div>
                        </x-duro.table.cell>

                        <x-duro.table.cell>
                            <div class="text-sm font-semibold text-shadow-900 dark:text-neutralfog-100">{{ $service->title ?? 'Untitled service' }}</div>
                            <div class="text-xs text-neutral-600 dark:text-neutralfog-400 line-clamp-1">{{ $service->notes }}</div>
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
                            <x-duro.button type="button" size="sm" class="justify-center" onclick="window.location='{{ route('services.edit', $service) }}'">
                                Edit
                            </x-duro.button>
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
