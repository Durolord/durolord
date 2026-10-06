<div class="space-y-12">
    <x-duro.page-header
        title="Tables"
        description="Filament-style data tables assembled from small, composable Blade parts. This demo is fully live: search, filter, sort and bulk-select are powered by Livewire."
        :breadcrumbs="['UI Kit' => route('showcase'), 'Tables' => null]"
    >
        <x-slot:actions>
            <x-duro.button variant="secondary" icon="edit" :href="route('form-components')">Forms</x-duro.button>
            <x-duro.button icon="layers" :href="route('elements')">Elements</x-duro.button>
        </x-slot:actions>
    </x-duro.page-header>

    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <x-duro.stat label="Members" :value="count($rows)" icon="users" change="+2" description="this week" />
        <x-duro.stat label="Active" :value="collect($rows)->where('status', 'active')->count()" icon="check-circle" />
        <x-duro.stat label="Online now" :value="collect($rows)->where('online', true)->count()" icon="signal" />
        <x-duro.stat label="Teams" :value="collect($rows)->pluck('team')->unique()->count()" icon="layers" />
    </div>

    <x-docs.example title="Live data table" description="Search, filter by role or status, sort by any column header and select rows to reveal bulk actions." class="!p-0 overflow-visible">
        <x-duro.table.table class="[&_.duro-table-wrap]:border-0 [&_.duro-table-wrap]:shadow-none">
            <x-slot:toolbar>
                <x-duro.table.filters>
                    <x-duro.table.filter-search wire:model.live.debounce.250ms="search" name="search" placeholder="Search name, email or team…" />
                    <x-duro.table.filter-select wire:model.live="role" name="role" :options="$roles" placeholder="Any role" />
                    <x-duro.table.filter-select wire:model.live="status" name="status" :options="$statuses" placeholder="Any status" />

                    <x-slot:actions>
                        @if ($search || $role || $status)
                            <x-duro.button variant="ghost" size="sm" icon="x" wire:click="resetFilters">Reset</x-duro.button>
                        @endif
                    </x-slot:actions>
                </x-duro.table.filters>

                @if (count($selected))
                    <div class="mt-3 flex items-center justify-between gap-3 rounded-ui border border-primary/40 bg-primary/10 px-3 py-2 text-sm" wire:transition>
                        <span class="text-ink"><strong>{{ count($selected) }}</strong> selected</span>
                        <div class="flex gap-2">
                            <x-duro.button size="sm" variant="ghost" wire:click="$set('selected', [])">Clear</x-duro.button>
                            <x-duro.button size="sm" variant="danger" icon="trash" wire:click="archiveSelected" loading="archiveSelected">Archive</x-duro.button>
                        </div>
                    </div>
                @endif
            </x-slot:toolbar>

            <x-duro.table.head>
                <x-duro.table.checkbox-header
                    x-on:change="$wire.set('selected', $event.target.checked ? {{ \Illuminate\Support\Js::from($this->visibleIds) }} : [])"
                    :checked="count($selected) > 0 && count($selected) === count($this->visibleIds)"
                />
                @foreach (['name' => 'Member', 'role' => 'Role', 'status' => 'Status', 'team' => 'Team'] as $column => $label)
                    <x-duro.table.header-cell sortable :direction="$sortBy === $column ? $sortDirection : null" wire:click="sort('{{ $column }}')">{{ $label }}</x-duro.table.header-cell>
                @endforeach
                <x-duro.table.header-cell>Note</x-duro.table.header-cell>
                <x-duro.table.header-cell>Active</x-duro.table.header-cell>
                <x-duro.table.header-cell align="right">Actions</x-duro.table.header-cell>
            </x-duro.table.head>

            <x-duro.table.body>
                @forelse ($this->filteredRows as $row)
                    <x-duro.table.row wire:key="member-{{ $row['id'] }}" :selected="in_array((string) $row['id'], $selected, true)">
                        <x-duro.table.checkbox-column wire:model.live="selected" value="{{ $row['id'] }}" />
                        <x-duro.table.image-column :name="$row['name']" :description="$row['email']" :status="$row['online'] ? 'online' : 'offline'" />
                        <x-duro.table.icon-column :icon="$row['icon']" :label="$row['role']" />
                        <x-duro.table.badge-column :value="$row['status']" :colors="$statusColors" />
                        <x-duro.table.color-column :color="$row['color']" :label="$row['team']" />
                        <x-duro.table.input-column :value="$row['note']" aria-label="Note for {{ $row['name'] }}" />
                        <x-duro.table.toggle-column :on="$row['status'] === 'active'" />
                        <x-duro.table.actions-column>
                            <x-duro.button size="sm" variant="ghost" square icon="eye" x-tooltip="'View'" aria-label="View" />
                            <x-duro.button size="sm" variant="ghost" square icon="edit" x-tooltip="'Edit'" aria-label="Edit" />
                            <x-duro.dropdown align="right" width="w-44">
                                <x-slot:trigger>
                                    <x-duro.button size="sm" variant="ghost" square icon="more-horizontal" aria-label="More actions" />
                                </x-slot:trigger>
                                <x-duro.dropdown.item icon="mail">Send message</x-duro.dropdown.item>
                                <x-duro.dropdown.item icon="copy" x-copy="{{ \Illuminate\Support\Js::from($row['email']) }}">Copy email</x-duro.dropdown.item>
                                <x-duro.dropdown.divider />
                                <x-duro.dropdown.item icon="trash" danger>Remove</x-duro.dropdown.item>
                            </x-duro.dropdown>
                        </x-duro.table.actions-column>
                    </x-duro.table.row>
                @empty
                    <x-duro.table.empty-state title="No members match" description="Try a different search term or reset the filters.">
                        <x-slot:action>
                            <x-duro.button variant="secondary" size="sm" icon="refresh" wire:click="resetFilters">Reset filters</x-duro.button>
                        </x-slot:action>
                    </x-duro.table.empty-state>
                @endforelse
            </x-duro.table.body>

            <x-duro.table.summary-row>
                <td colspan="99">Showing <strong class="text-ink">{{ $this->filteredRows->count() }}</strong> of {{ count($rows) }} members · sorted by {{ $sortBy }} ({{ $sortDirection }})</td>
            </x-duro.table.summary-row>
        </x-duro.table.table>

        <x-slot:code>
            @verbatim
            <x-duro.table.table>
                <x-duro.table.head>
                    <x-duro.table.header-cell sortable direction="asc" wire:click="sort('name')">Member</x-duro.table.header-cell>
                    <x-duro.table.header-cell>Status</x-duro.table.header-cell>
                </x-duro.table.head>
                <x-duro.table.body>
                    @foreach ($members as $member)
                        <x-duro.table.row wire:key="member-{{ $member->id }}">
                            <x-duro.table.image-column :name="$member->name" :description="$member->email" />
                            <x-duro.table.badge-column :value="$member->status" :colors="['active' => 'success']" />
                        </x-duro.table.row>
                    @endforeach
                </x-duro.table.body>
            </x-duro.table.table>
            @endverbatim
        </x-slot:code>
    </x-docs.example>

    <x-docs.example title="Grouped rows" description="Group records under labelled dividers — perfect for teams, departments or dates.">
        <x-duro.table.table striped>
            <x-duro.table.head>
                <x-duro.table.header-cell>Member</x-duro.table.header-cell>
                <x-duro.table.header-cell>Role</x-duro.table.header-cell>
                <x-duro.table.header-cell align="right">Status</x-duro.table.header-cell>
            </x-duro.table.head>
            <x-duro.table.body>
                @foreach ($this->groupedRows as $team => $members)
                    <x-duro.table.group-row :label="$team" :count="$members->count()" wire:key="group-{{ \Illuminate\Support\Str::slug($team) }}">
                        @foreach ($members as $member)
                            <x-duro.table.row wire:key="grouped-{{ $member['id'] }}">
                                <x-duro.table.text-column :value="$member['name']" :description="$member['email']" />
                                <x-duro.table.text-column :value="$member['role']" muted />
                                <x-duro.table.cell align="right"><x-duro.badge :variant="$statusColors[$member['status']]">{{ $member['status'] }}</x-duro.badge></x-duro.table.cell>
                            </x-duro.table.row>
                        @endforeach
                    </x-duro.table.group-row>
                @endforeach
            </x-duro.table.body>
        </x-duro.table.table>
    </x-docs.example>

    <x-docs.example title="Empty state" description="Friendly guidance when a query returns nothing.">
        <x-duro.table.table>
            <x-duro.table.body>
                <x-duro.table.empty-state icon="database" title="This table is waiting" description="Connect a data source or create your first record to get started.">
                    <x-slot:action>
                        <x-duro.button size="sm" icon="plus">Create record</x-duro.button>
                    </x-slot:action>
                </x-duro.table.empty-state>
            </x-duro.table.body>
        </x-duro.table.table>
    </x-docs.example>
</div>
