<div class="space-y-14">
    {{-- Hero --}}
    <section class="duro-card duro-card-ornate relative overflow-hidden p-8 sm:p-12">
        <div class="duro-grid-lines absolute inset-0 -z-10 opacity-40 [mask-image:radial-gradient(ellipse_at_top_right,black,transparent_65%)]"></div>
        <div class="grid items-center gap-10 lg:grid-cols-[1.4fr_1fr]">
            <div class="space-y-6">
                <x-duro.badge variant="primary" icon="sparkles">Duro UI · v1.0</x-duro.badge>
                <h1 class="duro-display text-4xl sm:text-5xl lg:text-6xl">A component kit with five souls.</h1>
                <p class="max-w-xl text-base leading-relaxed text-ink-muted">
                    Every component below is plain Blade + Alpine, styled by design tokens and ready for Livewire. Switch realms with the picker in the top bar and watch shapes, type and ornaments change — not just colours.
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
            ['icon' => 'palette', 'title' => 'Token driven', 'body' => 'One set of semantic tokens powers five complete themes.'],
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
