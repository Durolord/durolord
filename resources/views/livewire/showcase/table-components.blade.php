<div class="min-h-[calc(100vh-5rem)]">
    <section class="container mx-auto px-6 py-16 lg:py-20 space-y-8">

        {{-- Page heading --}}
        <header class="space-y-3 max-w-2xl">
            <x-duro.badge variant="gold">
                DURO CODE • TABLE COMPONENTS
            </x-duro.badge>

            <h1 class="text-3xl md:text-4xl font-extrabold leading-tight tracking-tight text-electric-700 dark:text-electric-300">
                Mystic Tables &amp; Data Grids
            </h1>

            <p class="text-sm md:text-base text-neutral-700 dark:text-neutralfog-300">
                A showcase of Duro-styled table components: columns, filters, grouping, and summaries.
            </p>
        </header>

        {{-- Table demo --}}
        <x-duro.table
            title="Realm Members"
            description="People across your digital realms with roles, status, and accents."
        >
            {{-- Filters --}}
            <x-duro.table.filters>
                <x-duro.table.filter-search
                    wire:model.debounce.300ms="search"
                    placeholder="Search name or email…"
                />

                <x-duro.table.filter-select
                    label="Role"
                    wire:model="filterRole"
                    :options="$roleOptions"
                />

                <x-duro.table.filter-select
                    label="Status"
                    wire:model="filterStatus"
                    :options="$statusOptions"
                />

                <x-slot:actions>
                    <x-duro.button
                        variant="ghost"
                        size="xs"
                        type="button"
                        wire:click="resetFilters"
                    >
                        Reset
                    </x-duro.button>
                </x-slot:actions>
            </x-duro.table.filters>

            {{-- Head --}}
            <x-duro.table.head>
                <x-duro.table.header-cell class="w-8">
                    <input
                        type="checkbox"
                        class="h-4 w-4 rounded border-neutralfog-400 text-electric-500 focus:ring-electric-400 dark:border-shadow-600 dark:bg-shadow-900"
                        {{-- You could wire this up to "select all" later --}}
                    >
                </x-duro.table.header-cell>

                <x-duro.table.header-cell>Person</x-duro.table.header-cell>
                <x-duro.table.header-cell>Email</x-duro.table.header-cell>
                <x-duro.table.header-cell>Role</x-duro.table.header-cell>
                <x-duro.table.header-cell>Status</x-duro.table.header-cell>
                <x-duro.table.header-cell>Accent</x-duro.table.header-cell>
                <x-duro.table.header-cell align="center">Active</x-duro.table.header-cell>
                <x-duro.table.header-cell align="right">Actions</x-duro.table.header-cell>
            </x-duro.table.head>

            {{-- Body --}}
            <x-duro.table.body>
                @php
                    $rows = $this->rows; /** @var \Illuminate\Support\Collection $rows */
                @endphp

                @if($rows->isEmpty())
                    <x-duro.table.empty-state :colspan="8"
                        title="No matching members"
                        message="Try adjusting your filters or adding a new realm member."
                    >
                        <x-slot:action>
                            <x-duro.button type="button">
                                Add member
                            </x-duro.button>
                        </x-slot:action>
                    </x-duro.table.empty-state>
                @else
                    {{-- Example grouping by role --}}
                    @foreach($rows->groupBy('role') as $role => $group)
                        <x-duro.table.group-row
                            :label="$roleOptions[$role] ?? ucfirst($role)"
                            :colspan="8"
                        />

                        @foreach($group as $row)
                            <x-duro.table.row>
                                {{-- Checkbox column --}}
                                <x-duro.table.checkbox-column>
                                    <input
                                        type="checkbox"
                                        class="h-4 w-4 rounded border-neutralfog-400 text-electric-500 focus:ring-electric-400 dark:border-shadow-600 dark:bg-shadow-900"
                                        wire:model="selected"
                                        value="{{ $row['id'] }}"
                                    >
                                </x-duro.table.checkbox-column>

                                {{-- Image + name --}}
                                <x-duro.table.image-column
                                    :src="$row['avatar']"
                                    :alt="$row['name']"
                                />

                                <x-duro.table.text-column :value="$row['email']" muted />

                                {{-- Role as simple text column --}}
                                <x-duro.table.text-column
                                    :value="$roleOptions[$row['role']] ?? ucfirst($row['role'])"
                                />

                                {{-- Status: select column --}}
                                <x-duro.table.select-column
                                    wire:model="status.{{ $row['id'] }}"
                                    :options="$statusOptions"
                                />

                                {{-- Accent color --}}
                                <x-duro.table.color-column
                                    :label="$row['accent']"
                                    :value="$row['accent']"
                                />

                                {{-- Active toggle --}}
                                <x-duro.table.toggle-column
                                    wire:model="active.{{ $row['id'] }}"
                                />

                                {{-- Actions --}}
                                <x-duro.table.actions-column>
                                    <x-duro.button
                                        size="xs"
                                        variant="ghost"
                                        type="button"
                                    >
                                        Edit
                                    </x-duro.button>
                                    <x-duro.button
                                        size="xs"
                                        variant="ghost"
                                        type="button"
                                    >
                                        More
                                    </x-duro.button>
                                </x-duro.table.actions-column>
                            </x-duro.table.row>
                        @endforeach
                    @endforeach

                    {{-- Summary row --}}
                    <x-duro.table.summary-row>
                        <x-duro.table.cell colspan="8" align="right" class="text-[11px] text-neutral-600 dark:text-neutralfog-300">
                            Showing {{ $rows->count() }} member(s) • Selected: {{ count($selected) }}
                        </x-duro.table.cell>
                    </x-duro.table.summary-row>
                @endif
            </x-duro.table.body>
        </x-duro.table>

    </section>
</div>
