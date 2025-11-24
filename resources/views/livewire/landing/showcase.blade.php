<div class="relative min-h-[calc(100vh-5rem)]">
    {{-- BACKGROUND LAYERS --}}
    <div class="pointer-events-none absolute inset-0 z-0 bg-aurora-light dark:bg-aurora-dark opacity-50"></div>
    <div class="pointer-events-none absolute inset-0 z-0 bg-gradient-to-b
                from-neutralfog-100/90 via-neutralfog-50/80 to-electric-500/10
                dark:from-shadow-950/95 dark:via-shadow-950/85 dark:to-electric-700/15"></div>

    {{-- MAIN CONTENT --}}
    <section class="relative z-10 container mx-auto max-w-6xl px-6 py-12 lg:py-16 space-y-8">

        {{-- Header + CTA --}}
        <x-duro.card
            class="bg-white/80 dark:bg-shadow-900/70 border-neutralfog-200 dark:border-shadow-800
                   backdrop-blur space-y-6"
        >
            <div class="flex flex-col gap-8 lg:flex-row lg:items-start lg:justify-between">
                <div class="space-y-5 flex-1">
                    <p variant="gold" class="w-max">
                        Component reference
                    </p>

                    <div class="space-y-3">
                        <h2 class="text-2xl sm:text-3xl md:text-4xl font-semibold text-shadow-900 dark:text-silver-50 leading-tight">
                            Ship-ready UI kit for forms and data
                        </h2>
                        <p class="text-sm text-neutral-700 dark:text-neutralfog-300 max-w-2xl leading-relaxed">
                            Senior defaults baked in: validation states, dark-mode parity, consistent spacing,
                            and reusable patterns. Grab and drop these pieces into HRMS, CMS, trackers, or analytics.
                        </p>
                    </div>

                    {{-- Feature highlights --}}
                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-3 text-xs pt-2">
                        <x-duro.card
                            hover="false"
                            padding="sm"
                            class="flex items-center gap-2 bg-neutralfog-50/70 border-neutralfog-200
                                   dark:bg-shadow-900/60 dark:border-shadow-800"
                        >
                            <span class="h-2 w-2 flex-shrink-0 rounded-full bg-electric-500 glow-electric"></span>
                            <div class="min-w-0">
                                <div class="font-semibold text-shadow-900 dark:text-neutralfog-50">Dark/light parity</div>
                                <div class="text-neutral-600 dark:text-neutralfog-400 truncate">Every component respects theme.</div>
                            </div>
                        </x-duro.card>

                        <x-duro.card
                            hover="false"
                            padding="sm"
                            class="flex items-center gap-2 bg-neutralfog-50/70 border-neutralfog-200
                                   dark:bg-shadow-900/60 dark:border-shadow-800"
                        >
                            <span class="h-2 w-2 flex-shrink-0 rounded-full bg-gold-500 glow-gold"></span>
                            <div class="min-w-0">
                                <div class="font-semibold text-shadow-900 dark:text-neutralfog-50">Validation-ready</div>
                                <div class="text-neutral-600 dark:text-neutralfog-400 truncate">
                                    Error bags + success states aligned.
                                </div>
                            </div>
                        </x-duro.card>

                        <x-duro.card
                            hover="false"
                            padding="sm"
                            class="flex items-center gap-2 bg-neutralfog-50/70 border-neutralfog-200
                                   dark:bg-shadow-900/60 dark:border-shadow-800"
                        >
                            <span class="h-2 w-2 flex-shrink-0 rounded-full bg-silver-400"></span>
                            <div class="min-w-0">
                                <div class="font-semibold text-shadow-900 dark:text-neutralfog-50">Composable</div>
                                <div class="text-neutral-600 dark:text-neutralfog-400 truncate">
                                    Volt/Livewire friendly APIs.
                                </div>
                            </div>
                        </x-duro.card>
                    </div>
                </div>

                {{-- CTAs --}}
                <div class="flex flex-col gap-3 w-full lg:w-auto lg:flex-shrink-0 pt-4 lg:pt-0">
                    <a
                        href="{{ route('form-components') }}"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-electric-500/60 text-sm
                            text-electric-700 hover:bg-electric-500/10 dark:text-electric-300 dark:hover:bg-electric-500/15 transition"
                    >
                        View form components
                        <span aria-hidden="true">→</span>
                    </a>

                <a
                    href="{{ route('table-components') }}"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-electric-500/60 text-sm
                        text-electric-700 hover:bg-electric-500/10 dark:text-electric-300 dark:hover:bg-electric-500/15 transition"
                >
                    View table components
                    <span aria-hidden="true">→</span>
                </a>

                </div>
            </div>
        </x-duro.card>

        {{-- Design Principles Section --}}
        <section class="space-y-4">
            <h3 class="text-xs font-semibold text-shadow-900 dark:text-neutralfog-200 uppercase tracking-wider">
                Design Principles
            </h3>
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 text-xs">
                <x-duro.card
                    hover="false"
                    padding="sm"
                    class="flex items-start gap-3 bg-neutralfog-50/80 border-neutralfog-200
                           dark:bg-shadow-900/60 dark:border-shadow-800"
                >
                    <span class="mt-1 h-2 w-2 flex-shrink-0 rounded-full bg-electric-500 glow-electric"></span>
                    <div class="space-y-1 min-w-0">
                        <div class="font-semibold text-shadow-900 dark:text-neutralfog-50">Production muscle</div>
                        <p class="text-neutral-700 dark:text-neutralfog-300">
                            Auth, 2FA, theming, dashboards, and Livewire flows already aligned to enterprise guardrails.
                        </p>
                    </div>
                </x-duro.card>

                <x-duro.card
                    hover="false"
                    padding="sm"
                    class="flex items-start gap-3 bg-neutralfog-50/80 border-neutralfog-200
                           dark:bg-shadow-900/60 dark:border-shadow-800"
                >
                    <span class="mt-1 h-2 w-2 flex-shrink-0 rounded-full bg-gold-500 glow-gold"></span>
                    <div class="space-y-1 min-w-0">
                        <div class="font-semibold text-shadow-900 dark:text-neutralfog-50">Maintainable patterns</div>
                        <p class="text-neutral-700 dark:text-neutralfog-300">
                            Volt/Livewire pages, reusable Duro components, and consistent tokens keep delivery calm.
                        </p>
                    </div>
                </x-duro.card>

                <x-duro.card
                    hover="false"
                    padding="sm"
                    class="flex items-start gap-3 bg-neutralfog-50/80 border-neutralfog-200
                           dark:bg-shadow-900/60 dark:border-shadow-800"
                >
                    <span class="mt-1 h-2 w-2 flex-shrink-0 rounded-full bg-silver-400"></span>
                    <div class="space-y-1 min-w-0">
                        <div class="font-semibold text-shadow-900 dark:text-neutralfog-50">Dark/light parity</div>
                        <p class="text-neutral-700 dark:text-neutralfog-300">
                            Every component respects theming, spacing, and error states for consistent UX.
                        </p>
                    </div>
                </x-duro.card>
            </div>
        </section>

        {{-- Form Kit Section --}}
        <section class="space-y-4">
            <h3 class="text-xs font-semibold text-shadow-900 dark:text-neutralfog-200 uppercase tracking-wider">
                Form Kit
            </h3>
            <div class="grid gap-4 text-xs md:grid-cols-2 lg:grid-cols-3">
                <x-duro.card class="space-y-3 bg-neutralfog-50/70 dark:bg-shadow-900/55">
                    <h4 class="text-sm font-semibold text-electric-700 dark:text-electric-300">Inputs and editors</h4>
                    <p class="text-neutral-700 dark:text-neutralfog-400">
                        Rich text, markdown, code, and classic inputs tuned for accessibility and spacing.
                    </p>
                    <div class="grid grid-cols-2 gap-2">
                        <p variant="electric" class="text-[10px]">x-duro.input</p>
                        <p variant="electric" class="text-[10px]">x-duro.textarea</p>
                        <p variant="electric" class="text-[10px]">x-duro.rich-editor</p>
                        <p variant="electric" class="text-[10px]">x-duro.markdown-editor</p>
                        <p variant="electric" class="text-[10px]">x-duro.code-editor</p>
                    </div>
                    <div class="text-neutral-600 dark:text-neutralfog-400 text-xs">
                        Use Livewire state + error bags for inline validation messaging.
                    </div>
                </x-duro.card>

                <x-duro.card class="space-y-3 bg-neutralfog-50/70 dark:bg-shadow-900/55">
                    <h4 class="text-sm font-semibold text-electric-700 dark:text-electric-300">Choices and toggles</h4>
                    <p class="text-neutral-700 dark:text-neutralfog-400">
                        All common selectors share consistent hit targets and label spacing.
                    </p>
                    <div class="grid grid-cols-2 gap-2">
                        <p variant="electric" class="text-[10px]">x-duro.select</p>
                        <p variant="electric" class="text-[10px]">x-duro.checkbox</p>
                        <p variant="electric" class="text-[10px]">x-duro.checkbox-list</p>
                        <p variant="electric" class="text-[10px]">x-duro.radio</p>
                        <p variant="electric" class="text-[10px]">x-duro.toggle</p>
                        <p variant="electric" class="text-[10px]">x-duro.toggle-buttons</p>
                        <p variant="electric" class="text-[10px]">x-duro.slider</p>
                    </div>
                    <div class="text-neutral-600 dark:text-neutralfog-400 text-xs">
                        Wire to Livewire with <code>wire:model.live</code> for immediate UX.
                    </div>
                </x-duro.card>

                <x-duro.card class="space-y-3 bg-neutralfog-50/70 dark:bg-shadow-900/55">
                    <h4 class="text-sm font-semibold text-electric-700 dark:text-electric-300">Meta and structure</h4>
                    <p class="text-neutral-700 dark:text-neutralfog-400">
                        Helpers for schedules, key/value pairs, tags, repeaters, and builders.
                    </p>
                    <div class="space-y-1 text-neutral-700 dark:text-neutralfog-400 text-xs">
                        <div>x-duro.date-time-picker</div>
                        <div>x-duro.date-picker</div>
                        <div>x-duro.time-picker</div>
                        <div>x-duro.tags-input</div>
                        <div>x-duro.key-value</div>
                        <div>x-duro.multi-select</div>
                        <div>x-duro.color-picker</div>
                        <div>x-duro.repeater</div>
                        <div>x-duro.builder</div>
                    </div>
                    <div class="text-neutral-600 dark:text-neutralfog-400 text-xs">
                        Compose into wizards or multi-step flows with shared spacing tokens.
                    </div>
                </x-duro.card>
            </div>
        </section>

        {{-- Chrome + Flows Section --}}
        <section class="space-y-4">
            <h3 class="text-xs font-semibold text-shadow-900 dark:text-neutralfog-200 uppercase tracking-wider">
                Chrome, Flows & Notes
            </h3>
            <div class="grid gap-4 text-xs md:grid-cols-3">
                <x-duro.card class="space-y-3 bg-neutralfog-50/70 dark:bg-shadow-900/55">
                    <h4 class="text-sm font-semibold text-electric-700 dark:text-electric-300">Files and chrome</h4>
                    <div class="space-y-1 text-neutral-700 dark:text-neutralfog-400">
                        <div>x-duro.file-upload</div>
                        <div>x-duro.button</div>
                        <div>x-duro.alert</div>
                        <div>x-duro.badge</div>
                        <div>x-duro.card</div>
                    </div>
                    <div class="text-neutral-600 dark:text-neutralfog-400 text-xs">
                        Pair alerts with status badges for inline success/error feedback.
                    </div>
                </x-duro.card>

                <x-duro.card class="space-y-3 bg-neutralfog-50/70 dark:bg-shadow-900/55">
                    <h4 class="text-sm font-semibold text-electric-700 dark:text-electric-300">Reusable flows</h4>
                    <div class="space-y-1 text-neutral-700 dark:text-neutralfog-400">
                        <div>Profile + password updates (Fortify)</div>
                        <div>Two-factor onboarding and recovery</div>
                        <div>Login, register, verify, reset</div>
                        <div>Dashboard shell with theming</div>
                    </div>
                    <div class="text-neutral-600 dark:text-neutralfog-400 text-xs">
                        Guard with policies/gates and re-use error bags per Fortify action.
                    </div>
                </x-duro.card>

                <x-duro.card class="space-y-3 bg-neutralfog-50/70 dark:bg-shadow-900/55">
                    <h4 class="text-sm font-semibold text-electric-700 dark:text-electric-300">Delivery notes</h4>
                    <div class="space-y-1 text-neutral-700 dark:text-neutralfog-400">
                        <div>Use factories in tests; avoid DB::raw joins.</div>
                        <div>Prefer route() + named routes for links.</div>
                        <div>Run Pint (<code>vendor/bin/pint --dirty</code>) pre-commit.</div>
                        <div>Leverage error bags per form section.</div>
                    </div>
                    <div class="text-neutral-600 dark:text-neutralfog-400 text-xs">
                        Keeps code senior-looking and predictable for teammates.
                    </div>
                </x-duro.card>
            </div>
        </section>

        {{-- Table Kit Section --}}
        <section class="space-y-4">
            <h3 class="text-xs font-semibold text-shadow-900 dark:text-neutralfog-200 uppercase tracking-wider">
                Table Kit
            </h3>
            <div class="grid gap-4 lg:grid-cols-[1.1fr_1fr]">
                <x-duro.card class="space-y-3 bg-neutralfog-50/70 dark:bg-shadow-900/55">
                    <div class="flex items-center gap-2">
                        <p variant="electric">Tables</p>
                        <span class="text-xs text-neutral-600 dark:text-neutralfog-400">
                            Composable parts for list views
                        </span>
                    </div>
                    <div class="grid gap-2 md:grid-cols-2 text-xs">
                        <div class="space-y-1">
                            <div class="font-semibold text-shadow-900 dark:text-neutralfog-100">Shell</div>
                            <div>table.blade.php</div>
                            <div>head.blade.php</div>
                            <div>body.blade.php</div>
                            <div>empty-state.blade.php</div>
                            <div>filters.blade.php</div>
                        </div>
                        <div class="space-y-1">
                            <div class="font-semibold text-shadow-900 dark:text-neutralfog-100">Rows and cells</div>
                            <div>group-row.blade.php</div>
                            <div>row.blade.php</div>
                            <div>header-cell.blade.php</div>
                            <div>cell.blade.php</div>
                            <div>summary-row.blade.php</div>
                        </div>
                    </div>
                    <div class="text-neutral-600 dark:text-neutralfog-400 text-xs">
                        Suggested UX: striped rows, row hover, sticky header, and bulk selection affordances.
                    </div>
                </x-duro.card>

                <x-duro.card class="space-y-3 bg-neutralfog-50/70 dark:bg-shadow-900/55">
                    <div class="flex items-center gap-2">
                        <p variant="electric">Columns</p>
                        <span class="text-xs text-neutral-600 dark:text-neutralfog-400">
                            Drop-in building blocks
                        </span>
                    </div>
                    <div class="grid grid-cols-2 gap-2 text-xs">
                        <div class="space-y-1">
                            <div>actions-column</div>
                            <div>checkbox-column</div>
                            <div>color-column</div>
                            <div>icon-column</div>
                            <div>image-column</div>
                        </div>
                        <div class="space-y-1">
                            <div>input-column</div>
                            <div>select-column</div>
                            <div>text-column</div>
                            <div>toggle-column</div>
                        </div>
                    </div>
                    <div class="text-neutral-600 dark:text-neutralfog-400 text-xs">
                        Filter helpers: filter-search, filter-select, filter-checkbox, filter-input.
                        Add Livewire <code>wire:key</code> on repeating rows.
                    </div>
                </x-duro.card>
            </div>
        </section>

        {{-- Footer --}}
        <div class="pt-4 border-t border-neutralfog-200/50 dark:border-shadow-800/50 mt-8">
            <p class="text-[11px] text-neutral-600 dark:text-neutralfog-400 leading-relaxed">
                Tune these primitives once and every module inherits the same Duro polish: 
                HRMS, CMS, church tracker, analytics, and beyond.
            </p>
        </div>
    </section>
</div>
