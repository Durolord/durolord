<div class="min-h-[calc(100vh-5rem)] flex items-center">
    <section class="container mx-auto px-6 py-16 grid gap-12 md:grid-cols-[minmax(0,1.3fr)_minmax(0,1fr)] items-center">

        {{-- LEFT SIDE --}}
        <div class="space-y-6">

            {{-- Badge --}}
            <x-duro.badge variant="gold" class="text-[10px]">
                DURO CODE • DIGITAL REALMS • LIVEWIRE
            </x-duro.badge>

            {{-- Headline --}}
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight tracking-tight">
                <span class="block text-electric-300 drop-shadow dark:text-electric-300">
                    Hi — I’m Durolord
                </span>
                <span class="block text-gold-300 dark:text-gold-300">
                    Maker of Digital Realms
                </span>
            </h1>

            {{-- Sub-copy --}}
            <p class="max-w-xl text-neutral-700 dark:text-neutralfog-300 text-sm md:text-base">
                I build fast, maintainable Laravel + Livewire experiences wrapped in
                a mystical, Soulslike aesthetic. Code is my spellbook;
                the web is my realm.
            </p>

            {{-- CTA + Status --}}
            <div class="flex flex-wrap gap-4 pt-4 items-center">

                {{-- CTA BUTTON (Livewire) --}}
                <x-duro.button
                    wire:click="incrementClicks"
                    variant="primary"
                    size="md"
                >
                    {{ $cta }}
                </x-duro.button>

                {{-- STATUS CARD --}}
                <x-duro.card
                    hover="false"
                    padding="sm"
                    class="text-xs flex items-center gap-3
                           bg-neutralfog-200/90 border-neutralfog-300 text-shadow-900
                           dark:bg-shadow-900/70 dark:border-silver-500/60 dark:text-neutralfog-200"
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
            class="relative overflow-hidden
                   bg-neutralfog-100 border-neutralfog-300
                   dark:bg-shadow-900/70 dark:border-electric-700/60 glow-arcane"
        >

            {{-- Aurora overlay --}}
            <div class="absolute inset-0 pointer-events-none bg-aurora-light dark:bg-aurora-dark opacity-40 mix-blend-screen"></div>

            <div class="relative space-y-4">

                <h2 class="text-lg font-semibold text-shadow-900 dark:text-silver-50">
                    Realm Status
                </h2>

                <p class="text-xs text-neutral-700 dark:text-neutralfog-300">
                    Laravel • Livewire • Alpine • Tailwind v4 • Duro Code palette.
                    A fully armed TALL starter, ready to forge HRMS, CMS, and trackers.
                </p>

                {{-- Stats --}}
                <div class="grid grid-cols-2 gap-3 text-[11px]">

                    <x-duro.card
                        hover="false"
                        padding="sm"
                        class="bg-neutralfog-100 border-neutralfog-300 text-shadow-900
                               dark:bg-shadow-950/70 dark:border-electric-500/50"
                    >
                        <div class="text-[10px] text-neutral-600 dark:text-neutralfog-300 mb-1">
                            Stack
                        </div>
                        <div class="font-semibold text-electric-700 dark:text-electric-300">
                            TALL • Soulslike
                        </div>
                    </x-duro.card>

                    <x-duro.card
                        hover="false"
                        padding="sm"
                        class="bg-neutralfog-100 border-neutralfog-300 text-shadow-900
                               dark:bg-shadow-950/70 dark:border-gold-500/50"
                    >
                        <div class="text-[10px] text-neutral-600 dark:text-neutralfog-300 mb-1">
                            Alignment
                        </div>
                        <div class="font-semibold text-gold-700 dark:text-gold-300">
                            Forged in Light & Darkness
                        </div>
                    </x-duro.card>

                </div>

                {{-- Hover footer message --}}
                <div class="pt-2 text-[11px] text-neutral-600 dark:text-neutralfog-300">
                    <span
                        class="text-electric-700 dark:text-purplearc-glow"
                        x-text="hover ? 'Sigils detected... hover acknowledged.' : 'Hover to awaken the sigils.'"
                    ></span>
                </div>

            </div>
        </x-duro.card>

    </section>
</div>
