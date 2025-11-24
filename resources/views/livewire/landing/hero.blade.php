<div class="relative min-h-[calc(100vh-5rem)] flex items-center overflow-hidden">
    <div class="absolute inset-0 bg-aurora-light dark:bg-aurora-dark opacity-60"></div>
    <div class="absolute inset-0 bg-gradient-to-br from-neutralfog-100/90 via-neutralfog-100/60 to-electric-500/10 dark:from-shadow-950/95 dark:via-shadow-950/80 dark:to-electric-700/20"></div>

    <section class="relative container mx-auto px-6 py-16 grid gap-12 lg:grid-cols-[minmax(0,1.2fr)_minmax(0,1fr)] items-center">
        {{-- LEFT SIDE --}}
        <div class="space-y-7">
            <div class="space-y-3">
                <x-duro.badge variant="gold" class="text-[10px]">
                    Laravel + Livewire + Tailwind v4
                </x-duro.badge>

                <div class="space-y-2">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight tracking-tight text-shadow-900 dark:text-neutralfog-50">
                        <span class="block text-electric-600 dark:text-electric-300">Hi - I am Durolord</span>
                        <span class="block text-gold-600 dark:text-gold-300">I build bold digital realms</span>
                    </h1>

                    <p class="max-w-2xl text-neutral-700 dark:text-neutralfog-300 text-sm md:text-base">
                        Senior-ready Laravel scaffolding with Livewire 3, Alpine, and Tailwind v4. Ship HRMS, CMS, and trackers with the Duro aesthetic baked in, no yak-shaving required.
                    </p>
                </div>

                <div class="grid gap-3 sm:grid-cols-2 text-sm">
                    <x-duro.card hover="false" padding="sm" class="flex items-start gap-2 bg-neutralfog-100/80 border-neutralfog-300 dark:bg-shadow-900/60 dark:border-shadow-800">
                        <span class="mt-1 h-2 w-2 rounded-full bg-electric-500 glow-electric"></span>
                        <div>
                            <div class="font-semibold text-shadow-900 dark:text-neutralfog-50">Production muscle</div>
                            <p class="text-xs text-neutral-600 dark:text-neutralfog-300">Auth, 2FA, theming, and dashboards aligned to enterprise guardrails.</p>
                        </div>
                    </x-duro.card>

                    <x-duro.card hover="false" padding="sm" class="flex items-start gap-2 bg-neutralfog-100/80 border-neutralfog-300 dark:bg-shadow-900/60 dark:border-shadow-800">
                        <span class="mt-1 h-2 w-2 rounded-full bg-gold-500 glow-gold"></span>
                        <div>
                            <div class="font-semibold text-shadow-900 dark:text-neutralfog-50">Maintainable patterns</div>
                            <p class="text-xs text-neutral-600 dark:text-neutralfog-300">Volt/Livewire pages, reusable Duro components, and consistent theming tokens.</p>
                        </div>
                    </x-duro.card>
                </div>
            </div>

            {{-- CTA + Status --}}
            <div class="flex flex-wrap gap-3 pt-2 items-center">
                <x-duro.button
                    wire:click="incrementClicks"
                    variant="primary"
                    size="md"
                >
                    {{ $cta }}
                </x-duro.button>

                <a
                    href="{{ route('showcase') }}"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-electric-500/60 text-sm text-electric-700 hover:bg-electric-500/10 dark:text-electric-300 dark:hover:bg-electric-500/15 transition"
                >
                    Explore components
                    <span aria-hidden="true">→</span>
                </a>

                <x-duro.card
                    hover="false"
                    padding="sm"
                    class="text-xs flex items-center gap-3 bg-neutralfog-200/90 border-neutralfog-300 text-shadow-900 dark:bg-shadow-900/70 dark:border-silver-500/60 dark:text-neutralfog-200"
                >
                    <span class="h-2 w-2 rounded-full bg-gold-400 glow-gold dark:bg-gold-300"></span>
                    <span>
                        {{ $clicks }} realm {{ \Illuminate\Support\Str::plural('entry', $clicks) }} recorded
                    </span>
                </x-duro.card>
            </div>
        </div>

        {{-- RIGHT SIDE CARD --}}
        <x-duro.card
            hover="true"
            padding="lg"
            x-data="{ hover: false }"
            x-on:mouseenter="hover = true"
            x-on:mouseleave="hover = false"
            class="relative overflow-hidden bg-neutralfog-100/90 border-neutralfog-300 dark:bg-shadow-900/80 dark:border-electric-700/60 glow-arcane"
        >
            <div class="absolute inset-0 pointer-events-none bg-aurora-light dark:bg-aurora-dark opacity-40 mix-blend-screen"></div>

            <div class="relative space-y-5">
                <div class="flex items-center justify-between gap-3">
                    <h2 class="text-lg font-semibold text-shadow-900 dark:text-silver-50">
                        Realm status
                    </h2>
                    <x-duro.badge variant="electric">
                        Ready to deploy
                    </x-duro.badge>
                </div>

                <p class="text-sm text-neutral-700 dark:text-neutralfog-300">
                    Laravel, Livewire 3, Alpine, Tailwind v4, Fortify, Volt, and custom Duro UI primitives. Opinionated defaults that stay out of your way.
                </p>

                <div class="grid grid-cols-2 gap-3 text-[11px]">
                    <x-duro.card
                        hover="false"
                        padding="sm"
                        class="bg-neutralfog-100 border-neutralfog-300 text-shadow-900 dark:bg-shadow-950/70 dark:border-electric-500/50"
                    >
                        <div class="text-[10px] text-neutral-600 dark:text-neutralfog-300 mb-1">
                            Stack
                        </div>
                        <div class="font-semibold text-electric-700 dark:text-electric-300">
                            TALL + Soulslike polish
                        </div>
                    </x-duro.card>

                    <x-duro.card
                        hover="false"
                        padding="sm"
                        class="bg-neutralfog-100 border-neutralfog-300 text-shadow-900 dark:bg-shadow-950/70 dark:border-gold-500/50"
                    >
                        <div class="text-[10px] text-neutral-600 dark:text-neutralfog-300 mb-1">
                            Delivery
                        </div>
                        <div class="font-semibold text-gold-700 dark:text-gold-300">
                            Patterns over demos
                        </div>
                    </x-duro.card>
                </div>

                <div class="grid grid-cols-2 gap-3 text-[11px]">
                    <x-duro.card
                        hover="false"
                        padding="sm"
                        class="bg-neutralfog-100 border-neutralfog-300 text-shadow-900 dark:bg-shadow-950/70 dark:border-silver-500/60"
                    >
                        <div class="text-[10px] text-neutral-600 dark:text-neutralfog-300 mb-1">
                            Quality gates
                        </div>
                        <div class="font-semibold text-shadow-900 dark:text-neutralfog-100">
                            Fortify + 2FA + policies
                        </div>
                    </x-duro.card>

                    <x-duro.card
                        hover="false"
                        padding="sm"
                        class="bg-neutralfog-100 border-neutralfog-300 text-shadow-900 dark:bg-shadow-950/70 dark:border-electric-500/50"
                    >
                        <div class="text-[10px] text-neutral-600 dark:text-neutralfog-300 mb-1">
                            Theming
                        </div>
                        <div class="font-semibold text-electric-700 dark:text-electric-300">
                            System / dark / electric
                        </div>
                    </x-duro.card>
                </div>

                <div class="pt-1 text-[11px] text-neutral-600 dark:text-neutralfog-300">
                    <span
                        class="text-electric-700 dark:text-purplearc-glow"
                        x-text="hover ? 'Sigils detected... hover acknowledged.' : 'Hover to awaken the sigils.'"
                    ></span>
                </div>
            </div>
        </x-duro.card>
    </section>
</div>
