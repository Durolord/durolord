<div class="relative min-h-[calc(100vh-5rem)] overflow-hidden">
    <div class="absolute inset-0 bg-aurora-light dark:bg-aurora-dark opacity-50"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-neutralfog-100/90 via-white/70 to-electric-500/10 dark:from-shadow-950/95 dark:via-shadow-900/85 dark:to-electric-700/15"></div>

    <section class="relative container mx-auto px-6 py-16 lg:py-20 space-y-12">
        {{-- HEADER --}}
        <header class="grid gap-6 lg:grid-cols-[minmax(0,1.6fr)_minmax(0,1fr)] items-start">
            <div class="space-y-3">
                <x-duro.badge variant="gold" class="w-max">
                    Duro Table Kit Showcase
                </x-duro.badge>

                <h1 class="text-3xl md:text-4xl font-extrabold leading-tight tracking-tight text-electric-700 dark:text-electric-200">
                    Duro Mystic Tables &amp; Columns
                </h1>

                <p class="text-sm md:text-base text-neutral-600 dark:text-neutralfog-300 max-w-3xl">
                    Every table primitive in one screen: shell, rows, cells, filters, and columns. Swap the fake data with Livewire queries and you have a production-ready list view.
                </p>
            </div>

            <div class="grid gap-3 sm:grid-cols-2 text-xs">
                <x-duro.card hover="false" padding="sm" class="flex items-start gap-2 bg-neutralfog-50/80 border-neutralfog-200 dark:bg-shadow-900/70 dark:border-shadow-800">
                    <span class="mt-1 h-2 w-2 rounded-full bg-electric-500 glow-electric"></span>
                    <div>
                        <div class="font-semibold text-shadow-900 dark:text-neutralfog-50">Theme-ready</div>
                        <p class="text-neutral-600 dark:text-neutralfog-400">Light/dark parity, sticky headers recommended for long lists.</p>
                    </div>
                </x-duro.card>

                <x-duro.card hover="false" padding="sm" class="flex items-start gap-2 bg-neutralfog-50/80 border-neutralfog-200 dark:bg-shadow-900/70 dark:border-shadow-800">
                    <span class="mt-1 h-2 w-2 rounded-full bg-gold-500 glow-gold"></span>
                    <div>
                        <div class="font-semibold text-shadow-900 dark:text-neutralfog-50">Livewire friendly</div>
                        <p class="text-neutral-600 dark:text-neutralfog-400">Add `wire:key` per row and bind filters with `wire:model.live`.</p>
                    </div>
                </x-duro.card>
            </div>
        </header>

        <div class="grid gap-10 xl:grid-cols-[minmax(0,2fr)_minmax(0,1.2fr)] items-start">
            {{-- MAIN TABLE DEMO --}}
            <div class="space-y-6">
                {{-- FILTER BAR --}}
                <section class="space-y-3">
                    <div class="flex items-center justify-between gap-3 flex-wrap">
                        <h2 class="text-xs font-semibold tracking-wide uppercase text-shadow-900 dark:text-silver-50">
                            Filters &amp; Search
                        </h2>
                        <p class="text-[11px] text-neutral-600 dark:text-neutralfog-400">
                            Wire these to a Livewire query scope for real filtering.
                        </p>
                    </div>
                    <div class="rounded-2xl border border-neutral-200/80 bg-white/90 shadow-sm dark:border-shadow-700 dark:bg-shadow-900/80 backdrop-blur p-4">
                        <x-duro.table.filters>
                            <div class="grid gap-3 md:grid-cols-3">
                                <x-duro.table.filter-search placeholder="Search members..." />
                                <x-duro.table.filter-select label="Role" :options="$roles" placeholder="Any role" />
                                <x-duro.table.filter-select label="Status" :options="$statuses" placeholder="Any status" />
                            </div>
                        </x-duro.table.filters>
                    </div>
                </section>

                {{-- FULL TABLE USING ALL CORE PARTS --}}
                <section class="space-y-3">
                    <h2 class="text-xs font-semibold tracking-wide uppercase text-shadow-900 dark:text-silver-50">
                        Full Table Anatomy
                    </h2>
                    <p class="text-xs text-neutral-600 dark:text-neutralfog-300">
                        Uses <span class="font-semibold">table, head, header-cell, body, row, cell,
                        checkbox-column, text-column, icon-column, color-column, image-column,
                        input-column, select-column, toggle-column, actions-column, summary-row</span>.
                        Add `wire:key` to rows when data is dynamic.
                    </p>

                    <div class="rounded-2xl border border-neutral-200/80 bg-white shadow-sm dark:border-shadow-700 dark:bg-shadow-900/80 overflow-hidden backdrop-blur">
                        <x-duro.table.table>
                            {{-- TABLE HEAD --}}
                            <x-duro.table.head>
                                <x-duro.table.header-cell class="w-10">
                                    <x-duro.table.checkbox-column />
                                </x-duro.table.header-cell>

                                <x-duro.table.header-cell>Member</x-duro.table.header-cell>
                                <x-duro.table.header-cell>Role</x-duro.table.header-cell>
                                <x-duro.table.header-cell>Status</x-duro.table.header-cell>
                                <x-duro.table.header-cell>Team / Color</x-duro.table.header-cell>
                                <x-duro.table.header-cell>Presence</x-duro.table.header-cell>
                                <x-duro.table.header-cell class="w-32">Inline Edit</x-duro.table.header-cell>
                                <x-duro.table.header-cell class="w-24">Toggle</x-duro.table.header-cell>
                                <x-duro.table.header-cell class="w-32 text-right">Actions</x-duro.table.header-cell>
                            </x-duro.table.head>

                            {{-- TABLE BODY --}}
                            <x-duro.table.body>
                                @forelse($rows as $row)
                                    <x-duro.table.row :key="$row['id']">
                                        {{-- CHECKBOX COLUMN --}}
                                        <x-duro.table.checkbox-column :value="$row['id']" />

                                        {{-- IMAGE + TEXT --}}
                                        <x-duro.table.image-column
                                            :src="$row['avatar'] ?? null"
                                            :initials="collect(explode(' ', $row['name']))->map(fn($p) => mb_substr($p, 0, 1))->join('')"
                                        >
                                            <x-duro.table.text-column :value="$row['name']" :description="$row['email']" />
                                        </x-duro.table.image-column>

                                        {{-- ICON + TEXT --}}
                                        <x-duro.table.icon-column :icon="$row['icon'] ?? 'user'">
                                            <x-duro.table.text-column :value="$row['role']" :description="$row['team']" />
                                        </x-duro.table.icon-column>

                                        {{-- STATUS SELECT --}}
                                        <x-duro.table.select-column :options="$statuses" :value="$row['status']" />

                                        {{-- COLOR + TEAM --}}
                                        <x-duro.table.color-column :color="$row['color']">
                                            <x-duro.table.text-column :value="$row['team']" description="Realm channel" />
                                        </x-duro.table.color-column>

                                        {{-- PRESENCE --}}
                                        <x-duro.table.icon-column :icon="$row['online'] ? 'signal' : 'wifi-off'">
                                            <x-duro.table.text-column :value="$row['online'] ? 'Online' : 'Away'" description="Presence" />
                                        </x-duro.table.icon-column>

                                        {{-- INLINE INPUT --}}
                                        <x-duro.table.input-column :value="$row['note']" placeholder="Note..." />

                                        {{-- TOGGLE --}}
                                        <x-duro.table.toggle-column :on="$row['status'] === 'active'" />

                                        {{-- ACTIONS --}}
                                        <x-duro.table.actions-column>
                                            <x-duro.button size="sm" variant="ghost" class="px-2">View</x-duro.button>
                                            <x-duro.button size="sm" variant="primary" class="px-2">Edit</x-duro.button>
                                        </x-duro.table.actions-column>
                                    </x-duro.table.row>
                                @empty
                                    <x-duro.table.empty-state
                                        title="No members found"
                                        description="Adjust your filters or invite the first member to this realm."
                                    />
                                @endforelse
                            </x-duro.table.body>

                            {{-- SUMMARY ROW --}}
                            <x-duro.table.summary-row>
                                <x-duro.table.cell colspan="4">
                                    <span class="text-xs text-neutral-600 dark:text-neutralfog-300">
                                        Showing <span class="font-semibold">{{ count($rows) }}</span> members.
                                    </span>
                                </x-duro.table.cell>
                                <x-duro.table.cell colspan="5" class="text-right">
                                    <span class="text-xs text-neutral-600 dark:text-neutralfog-300">
                                        Replace the arrays with Livewire collections for real data.
                                    </span>
                                </x-duro.table.cell>
                            </x-duro.table.summary-row>
                        </x-duro.table.table>
                    </div>
                </section>

                {{-- GROUP ROW DEMO --}}
                <section class="space-y-3">
                    <h2 class="text-xs font-semibold tracking-wide uppercase text-shadow-900 dark:text-silver-50">
                        Group Rows
                    </h2>
                    <p class="text-xs text-neutral-600 dark:text-neutralfog-300">
                        Demonstrates <span class="font-semibold">group-row</span> with nested
                        <span class="font-semibold">row</span> and <span class="font-semibold">cell</span>.
                    </p>

                    <div class="rounded-2xl border border-neutral-200/80 bg-white shadow-sm dark:border-shadow-700 dark:bg-shadow-900/80 overflow-hidden backdrop-blur">
                        <x-duro.table.table>
                            <x-duro.table.head>
                                <x-duro.table.header-cell>Team</x-duro.table.header-cell>
                                <x-duro.table.header-cell>Member</x-duro.table.header-cell>
                                <x-duro.table.header-cell>Status</x-duro.table.header-cell>
                            </x-duro.table.head>

                            <x-duro.table.body>
                                <x-duro.table.group-row label="Core Systems">
                                    @foreach($rows as $row)
                                        @if($row['team'] === 'Core Systems')
                                            <x-duro.table.row>
                                                <x-duro.table.cell>{{ $row['team'] }}</x-duro.table.cell>
                                                <x-duro.table.cell>{{ $row['name'] }}</x-duro.table.cell>
                                                <x-duro.table.cell>{{ ucfirst($row['status']) }}</x-duro.table.cell>
                                            </x-duro.table.row>
                                        @endif
                                    @endforeach
                                </x-duro.table.group-row>

                                <x-duro.table.group-row label="Other Guilds">
                                    @foreach($rows as $row)
                                        @if($row['team'] !== 'Core Systems')
                                            <x-duro.table.row>
                                                <x-duro.table.cell>{{ $row['team'] }}</x-duro.table.cell>
                                                <x-duro.table.cell>{{ $row['name'] }}</x-duro.table.cell>
                                                <x-duro.table.cell>{{ ucfirst($row['status']) }}</x-duro.table.cell>
                                            </x-duro.table.row>
                                        @endif
                                    @endforeach
                                </x-duro.table.group-row>
                            </x-duro.table.body>
                        </x-duro.table.table>
                    </div>
                </section>
            </div>

            {{-- SIDE PANEL --}}
            <aside class="space-y-6">
                <section class="space-y-3">
                    <h2 class="text-xs font-semibold tracking-wide uppercase text-shadow-900 dark:text-silver-50">
                        Component Map
                    </h2>
                    <x-duro.card hover="false" padding="sm" class="bg-white/80 border-neutral-200 text-xs text-neutral-700 dark:bg-shadow-900/70 dark:border-shadow-800 dark:text-neutralfog-200 space-y-2">
                        <p>
                            <span class="font-semibold">Structure:</span>
                            <code>table, head, header-cell, body, row, group-row, summary-row, cell, empty-state</code>
                        </p>
                        <p>
                            <span class="font-semibold">Columns:</span>
                            <code>checkbox-column, text-column, icon-column, image-column, color-column,
                                input-column, select-column, toggle-column, actions-column</code>
                        </p>
                        <p>
                            <span class="font-semibold">Filters:</span>
                            <code>filters, filter-search, filter-select</code>
                        </p>
                        <p>
                            <span class="font-semibold">Tips:</span>
                            Use sticky heads, zebra rows, and `wire:key` per row for Livewire diffing.
                        </p>
                    </x-duro.card>
                </section>

                {{-- EMPTY STATE SOLO --}}
                <section class="space-y-3">
                    <h2 class="text-xs font-semibold tracking-wide uppercase text-shadow-900 dark:text-silver-50">
                        Empty State Alone
                    </h2>
                    <div class="rounded-2xl border border-dashed border-neutral-300 bg-white/70 shadow-sm dark:border-shadow-700 dark:bg-shadow-900/70 overflow-hidden backdrop-blur p-4">
                        <x-duro.table.table>
                            <x-duro.table.body>
                                <x-duro.table.empty-state
                                    title="This table is waiting"
                                    description="Drop your own data source here to awaken the grid."
                                />
                            </x-duro.table.body>
                        </x-duro.table.table>
                    </div>
                </section>
            </aside>
        </div>
    </section>
</div>
