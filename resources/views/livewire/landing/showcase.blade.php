<div class="space-y-14">
    {{-- Hero --}}
    <section class="duro-card duro-card-ornate relative overflow-hidden p-8 sm:p-12">
        <div class="duro-grid-lines absolute inset-0 -z-10 opacity-40 [mask-image:radial-gradient(ellipse_at_top_right,black,transparent_65%)]"></div>
        <div class="grid items-center gap-10 lg:grid-cols-[1.4fr_1fr]">
            <div class="space-y-6">
                <x-duro.badge variant="primary" icon="sparkles">Duro UI · v1.0</x-duro.badge>
                <h1 class="duro-display text-4xl sm:text-5xl lg:text-6xl">A component kit with many souls.</h1>
                <p class="max-w-xl text-base leading-relaxed text-ink-muted">
                    Every component below is plain Blade + Alpine, styled by design tokens and ready for Livewire. Switch realms and flip between light and dark in the top bar — shapes, type and ornaments change, not just colours.
                </p>
                <div class="flex flex-wrap gap-3">
                    <x-duro.button :href="route('form-components')" icon="edit">Forms</x-duro.button>
                    <x-duro.button :href="route('table-components')" variant="secondary" icon="table">Tables</x-duro.button>
                    <x-duro.button :href="route('elements')" variant="secondary" icon="layers">Elements</x-duro.button>
                </div>
            </div>
            <div class="hidden justify-center lg:flex">
                <div class="duro-hero-art aspect-square w-72 animate-float" role="img" aria-label="Realm emblem"></div>
            </div>
        </div>
    </section>

    {{-- Principles --}}
    <section class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        @foreach ([
            ['icon' => 'palette', 'title' => 'Token driven', 'body' => 'One set of semantic tokens powers every realm, in light and dark.'],
            ['icon' => 'bolt', 'title' => 'Livewire ready', 'body' => 'wire:model works on every field, including custom pickers.'],
            ['icon' => 'shield', 'title' => 'Accessible', 'body' => 'Keyboard navigation, focus traps, ARIA roles and reduced motion.'],
            ['icon' => 'code', 'title' => 'Zero build deps', 'body' => 'Blade, Alpine and Tailwind v4 — nothing else to install.'],
        ] as $principle)
            <div class="duro-card p-5" data-reveal style="--reveal-delay: {{ $loop->index * 60 }}ms">
                <span class="duro-icon-tile size-10"><x-duro.icon :name="$principle['icon']" size="md" /></span>
                <h3 class="duro-heading mt-4 text-base">{{ $principle['title'] }}</h3>
                <p class="mt-1.5 text-sm text-ink-muted">{{ $principle['body'] }}</p>
            </div>
        @endforeach
    </section>

    {{-- Realms --}}
    <section id="realms" class="space-y-6" data-reveal>
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div class="space-y-1">
                <h2 class="duro-heading text-2xl">Realms</h2>
                <p class="max-w-2xl text-sm text-ink-muted">{{ count($families) }} realms, each with a light and a dark mode — {{ count($themes) }} themes in total. Pick a side of a card to switch instantly, or use the realm switcher and light/dark toggle in the top bar.</p>
            </div>
            <x-duro.mode-toggle system />
        </div>

        <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-3">
            @foreach ($families as $familyKey => $family)
                <article
                    class="flex flex-col overflow-hidden rounded-card border-2 bg-surface transition duration-300"
                    :class="$store.theme.family === @js($familyKey) ? 'border-primary shadow-glow' : 'border-line hover:border-line-strong'"
                    wire:key="realm-{{ $familyKey }}"
                >
                    <div class="grid grid-cols-2">
                        @foreach (['light', 'dark'] as $mode)
                            @php($themeKey = $family[$mode])
                            <button
                                type="button"
                                data-theme="{{ $themeKey }}"
                                x-on:click="$store.theme.set(@js($themeKey), $event)"
                                class="group relative flex flex-col items-center gap-2 bg-canvas px-3 pb-4 pt-6 text-center text-ink"
                                aria-label="Switch to {{ $themes[$themeKey]['name'] }} ({{ $mode }} mode)"
                            >
                                <span class="absolute left-2 top-2 inline-flex items-center gap-1 rounded-pill bg-surface-2 px-1.5 py-0.5 text-[0.55rem] font-semibold uppercase tracking-wider text-ink-subtle">
                                    <x-duro.icon :name="$mode === 'light' ? 'sun' : 'moon'" class="size-2.5" /> {{ $mode }}
                                </span>
                                <span class="absolute right-2 top-2 grid size-5 place-items-center rounded-full bg-primary text-on-primary transition" :class="$store.theme.current === @js($themeKey) ? 'scale-100 opacity-100' : 'scale-50 opacity-0'">
                                    <x-duro.icon name="check" class="size-3" stroke="3" />
                                </span>
                                <span class="duro-logo-mark mt-2 block size-16 transition-transform duration-500 group-hover:scale-110 group-hover:rotate-3"></span>
                                <span class="font-display text-sm font-bold leading-tight text-ink">{{ $themes[$themeKey]['name'] }}</span>
                                <span class="flex items-center gap-1.5">
                                    <span class="rounded-ui bg-primary px-2 py-0.5 font-label text-[0.55rem] font-bold uppercase tracking-wider text-on-primary">Button</span>
                                    <span class="rounded-ui border border-line bg-surface px-2 py-0.5 text-[0.55rem] text-ink-muted">Input</span>
                                </span>
                            </button>
                        @endforeach
                    </div>

                    <div class="flex flex-1 flex-col gap-1.5 border-t border-line p-4">
                        <div class="flex items-start justify-between gap-2">
                            <h3 class="font-semibold text-ink">{{ $family['name'] }}</h3>
                            @if ($family['inspiration'])
                                <span class="shrink-0 rounded-pill border border-line px-2 py-0.5 text-[0.6rem] text-ink-subtle">
                                    <x-duro.icon name="star" class="inline size-2.5" /> {{ $family['inspiration'] }}
                                </span>
                            @endif
                        </div>
                        @if ($trait = $traits[$family['trait']] ?? null)
                            <p class="inline-flex w-max items-center gap-1.5 font-label text-[0.62rem] font-bold uppercase tracking-[0.18em] text-primary-ink">
                                <x-duro.icon :name="$trait['icon']" class="size-3" /> {{ $trait['title'] }}
                            </p>
                        @endif
                        <p class="text-xs leading-relaxed text-ink-muted">{{ $family['motto'] }}</p>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    {{-- Categories --}}
    @foreach ($categories as $category)
        <section class="space-y-5" data-reveal>
            <div class="flex flex-wrap items-end justify-between gap-4">
                <div class="flex items-center gap-4">
                    <span class="duro-icon-tile size-12"><x-duro.icon :name="$category['icon']" size="lg" /></span>
                    <div>
                        <h2 class="duro-heading text-2xl">{{ $category['title'] }}</h2>
                        <p class="text-sm text-ink-muted">{{ $category['description'] }}</p>
                    </div>
                </div>
                <x-duro.button :href="route($category['route'])" variant="outline" size="sm" icon-right="arrow-right">Open demos</x-duro.button>
            </div>

            <div class="flex flex-wrap gap-2">
                @foreach ($category['components'] as $component)
                    <a href="{{ route($category['route']) }}" class="rounded-ui border border-line bg-surface px-3 py-1.5 font-mono text-xs text-ink-muted transition hover:-translate-y-0.5 hover:border-primary hover:text-primary-ink">&lt;x-duro.{{ $component }}&gt;</a>
                @endforeach
            </div>
        </section>
    @endforeach

    {{-- Quick start --}}
    <x-docs.example title="Quick start" description="Compose a full form section in a handful of lines.">
        <div class="grid gap-5 md:grid-cols-2">
            <x-duro.input name="qs_name" label="Project name" icon="briefcase" placeholder="Realm Analytics" />
            <x-duro.select label="Status" :options="['draft' => 'Draft', 'active' => 'Active', 'archived' => 'Archived']" value="active" />
            <div class="md:col-span-2">
                <x-duro.textarea name="qs_notes" label="Notes" rows="3" placeholder="What makes this project special?" />
            </div>
        </div>
        <div class="mt-6 flex justify-end gap-3">
            <x-duro.button variant="ghost">Cancel</x-duro.button>
            <x-duro.button icon="check" x-on:click="duroToast({ title: 'Project saved', variant: 'success' })">Save project</x-duro.button>
        </div>

        <x-slot:code>
            @verbatim
            <x-duro.input name="name" label="Project name" icon="briefcase" wire:model="name" />
            <x-duro.select label="Status" wire:model.live="status" :options="$statuses" />
            <x-duro.textarea name="notes" label="Notes" rows="3" wire:model.blur="notes" />

            <x-duro.button wire:click="save" icon="check" loading="save">Save project</x-duro.button>
            @endverbatim
        </x-slot:code>
    </x-docs.example>
</div>
