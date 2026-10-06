<div>
    {{-- ============================================================
         HERO
    ============================================================ --}}
    <section class="relative isolate overflow-hidden pt-28 sm:pt-32 lg:pt-36">
        <div class="duro-glow-orb -right-24 top-20 size-[28rem]"></div>
        <div class="duro-glow-orb -left-40 bottom-0 size-80 opacity-20"></div>

        <div class="mx-auto grid max-w-7xl items-center gap-14 px-4 pb-20 sm:px-6 lg:grid-cols-[1.1fr_1fr] lg:gap-10 lg:px-8 lg:pb-28">
            <div class="space-y-8">
                <div class="flex flex-wrap items-center gap-3" data-reveal>
                    <span class="duro-badge duro-badge-success duro-badge-dot">{{ $portfolio['availability'] }}</span>
                    <span class="inline-flex items-center gap-1.5 text-xs text-ink-subtle">
                        <x-duro.icon name="map-pin" class="size-3.5" /> {{ $portfolio['location'] }}
                    </span>
                </div>

                <div class="space-y-5" data-reveal style="--reveal-delay: 80ms">
                    <p class="duro-eyebrow">{{ $portfolio['role'] }}</p>
                    <h1 class="duro-display text-6xl sm:text-7xl lg:text-8xl">{{ $portfolio['name'] }}</h1>
                    <p class="max-w-xl text-2xl font-semibold leading-snug tracking-tight text-ink sm:text-[1.65rem]">{{ $portfolio['headline'] }}</p>
                    <p class="max-w-xl text-base leading-relaxed text-ink-muted">{{ $portfolio['summary'] }}</p>
                </div>

                <div class="flex flex-wrap items-center gap-3" data-reveal style="--reveal-delay: 160ms">
                    <x-duro.button href="#contact" size="lg" icon-right="arrow-right">Start a project</x-duro.button>
                    <x-duro.button href="#work" size="lg" variant="secondary" icon="briefcase">View my work</x-duro.button>
                    <x-duro.button :href="route('showcase')" size="lg" variant="ghost" icon="sparkles">Explore the UI kit</x-duro.button>
                </div>

                <dl class="grid max-w-lg grid-cols-3 gap-4 border-t border-line pt-6" data-reveal style="--reveal-delay: 240ms">
                    @foreach ([
                        ['value' => $componentCount, 'suffix' => '+', 'label' => 'UI components'],
                        ['value' => count($themes), 'suffix' => '', 'label' => 'Complete themes'],
                        ['value' => 12, 'suffix' => '', 'label' => 'Laravel version', 'prefix' => 'v'],
                    ] as $stat)
                        <div>
                            <dt class="sr-only">{{ $stat['label'] }}</dt>
                            <dd class="font-display text-3xl font-bold text-ink sm:text-4xl" x-data="countUp({{ $stat['value'] }})" x-intersect.once="start()">
                                {{ $stat['prefix'] ?? '' }}<span x-text="value">{{ $stat['value'] }}</span>{{ $stat['suffix'] }}
                            </dd>
                            <p class="mt-1 text-xs text-ink-subtle">{{ $stat['label'] }}</p>
                        </div>
                    @endforeach
                </dl>
            </div>

            {{-- Brand stage --}}
            <div class="relative mx-auto aspect-square w-full max-w-[34rem]" data-reveal style="--reveal-delay: 120ms">
                <div class="absolute inset-[6%] rounded-full border border-dashed border-line-strong/50 animate-spin-slow"></div>
                <div class="absolute inset-[14%] rounded-full border border-primary/25"></div>
                <div class="absolute inset-[22%] rounded-full bg-primary/10 blur-3xl animate-glow"></div>

                <div class="duro-hero-art absolute inset-[12%] animate-float" role="img" aria-label="{{ $portfolio['name'] }} emblem"></div>

                {{-- Floating code chip --}}
                <div class="duro-card duro-card-glass absolute -left-2 top-[12%] hidden w-60 p-3 sm:block" style="animation: duro-float 8s ease-in-out infinite">
                    <div class="mb-2 flex gap-1.5">
                        <span class="size-2.5 rounded-full bg-danger/80"></span>
                        <span class="size-2.5 rounded-full bg-warning/80"></span>
                        <span class="size-2.5 rounded-full bg-success/80"></span>
                    </div>
                    <pre class="font-mono text-[0.68rem] leading-relaxed text-ink-muted"><span class="text-primary-ink">&lt;x-duro.button</span>
  variant=<span class="text-accent-ink">"primary"</span>
  icon=<span class="text-accent-ink">"rocket"</span><span class="text-primary-ink">&gt;</span>
  Ship it
<span class="text-primary-ink">&lt;/x-duro.button&gt;</span></pre>
                </div>

                {{-- Floating status chip --}}
                <div class="duro-card duro-card-glass absolute -right-1 bottom-[14%] hidden items-center gap-3 p-3 pr-5 sm:flex" style="animation: duro-float 9s ease-in-out -3s infinite">
                    <span class="duro-icon-tile size-9"><x-duro.icon name="check-circle" /></span>
                    <div>
                        <p class="text-xs font-semibold text-ink">All tests passing</p>
                        <p class="text-[0.68rem] text-ink-subtle">Deployed to production</p>
                    </div>
                </div>

                {{-- Floating realm chip --}}
                <button type="button" x-on:click="cycleTheme($event)" class="duro-card duro-card-glass absolute bottom-[2%] left-[8%] hidden items-center gap-2 px-3 py-2 text-xs sm:flex" style="animation: duro-float 10s ease-in-out -5s infinite">
                    <x-duro.icon name="palette" class="text-primary-ink" />
                    <span class="text-ink-muted">Realm:</span>
                    <span class="font-semibold text-ink" x-text="$store.theme.meta.name"></span>
                    <x-duro.icon name="refresh" class="size-3 text-ink-subtle" />
                </button>
            </div>
        </div>

        {{-- Stack marquee --}}
        <div class="duro-band overflow-hidden py-5">
            <div class="duro-marquee-mask flex">
                <div class="flex shrink-0 animate-marquee items-center gap-10 pr-10 hover:[animation-play-state:paused]">
                    @foreach (array_merge($portfolio['stack'], $portfolio['stack']) as $tech)
                        <span class="flex items-center gap-10 whitespace-nowrap font-label text-sm font-bold uppercase tracking-[0.2em] text-ink-subtle">
                            {{ $tech }}
                            <span class="size-1.5 rotate-45 bg-primary/70"></span>
                        </span>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================================
         SERVICES
    ============================================================ --}}
    <section id="services" class="mx-auto max-w-7xl px-4 py-24 sm:px-6 lg:px-8 lg:py-32">
        <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
            <x-duro.section-heading
                eyebrow="What I do"
                title="From blank repo to production — and everything in between."
                description="I partner with founders, agencies and teams who want software that is fast, maintainable and genuinely pleasant to use."
            />
            <x-duro.button href="#contact" variant="outline" icon-right="arrow-right" class="self-start lg:self-auto" data-reveal>Discuss your project</x-duro.button>
        </div>

        <div class="mt-14 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($portfolio['services'] as $service)
                <article class="duro-card duro-card-interactive flex flex-col p-6" data-reveal style="--reveal-delay: {{ $loop->index * 80 }}ms">
                    <span class="duro-icon-tile size-12"><x-duro.icon :name="$service['icon']" size="lg" /></span>
                    <h3 class="duro-heading mt-6 text-xl">{{ $service['title'] }}</h3>
                    <p class="mt-3 flex-1 text-sm leading-relaxed text-ink-muted">{{ $service['body'] }}</p>
                    <ul class="mt-6 space-y-2 border-t border-line pt-5">
                        @foreach ($service['points'] as $point)
                            <li class="flex items-center gap-2 text-xs text-ink-muted">
                                <x-duro.icon name="check" class="size-3.5 text-primary-ink" stroke="2.5" /> {{ $point }}
                            </li>
                        @endforeach
                    </ul>
                </article>
            @endforeach
        </div>
    </section>

    {{-- ============================================================
         SELECTED WORK
    ============================================================ --}}
    <section id="work" class="duro-band py-24 lg:py-32">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-duro.section-heading
                eyebrow="Selected work"
                title="Systems built to carry real workloads."
                description="A selection of products I have designed and engineered — several are running live inside this very site."
            />

            <div class="mt-14 grid gap-6 lg:grid-cols-2">
                @foreach ($portfolio['projects'] as $project)
                    @php($link = $project['route'] ? route($project['route']) : ($project['url'] ?? null))
                    <article class="duro-card duro-card-interactive group flex flex-col overflow-hidden" data-reveal style="--reveal-delay: {{ ($loop->index % 2) * 100 }}ms">
                        {{-- Preview --}}
                        <div class="relative h-52 overflow-hidden border-b border-line bg-canvas/60">
                            <div class="duro-grid-lines absolute inset-0 opacity-50 [mask-image:linear-gradient(to_bottom,black,transparent)]"></div>
                            <div class="absolute inset-x-6 top-6 bottom-0 rounded-t-ui border border-b-0 border-line bg-surface shadow-card transition-transform duration-500 group-hover:-translate-y-2">
                                <div class="flex items-center gap-1.5 border-b border-line px-3 py-2">
                                    <span class="size-2 rounded-full bg-danger/70"></span>
                                    <span class="size-2 rounded-full bg-warning/70"></span>
                                    <span class="size-2 rounded-full bg-success/70"></span>
                                    <span class="ml-3 h-2 w-32 rounded-full bg-surface-3"></span>
                                </div>
                                <div class="grid grid-cols-[4.5rem_1fr] gap-3 p-3">
                                    <div class="space-y-2">
                                        <div class="h-2 w-full rounded-full bg-primary/50"></div>
                                        @for ($i = 0; $i < 4; $i++)
                                            <div class="h-2 rounded-full bg-surface-3" style="width: {{ 90 - $i * 12 }}%"></div>
                                        @endfor
                                    </div>
                                    <div class="space-y-2.5">
                                        <div class="flex gap-2">
                                            @for ($i = 0; $i < 3; $i++)
                                                <div class="h-10 flex-1 rounded-ui border border-line bg-surface-2 p-1.5">
                                                    <div class="h-1.5 w-1/2 rounded-full bg-ink-subtle/40"></div>
                                                    <div class="mt-1.5 h-2.5 w-3/4 rounded-full {{ $i === 0 ? 'bg-primary/60' : 'bg-ink-subtle/30' }}"></div>
                                                </div>
                                            @endfor
                                        </div>
                                        @for ($i = 0; $i < 3; $i++)
                                            <div class="flex items-center gap-2">
                                                <div class="size-3 rounded-full bg-surface-3"></div>
                                                <div class="h-2 flex-1 rounded-full bg-surface-3"></div>
                                                <div class="h-2 w-10 rounded-full {{ $i === 1 ? 'bg-success/50' : 'bg-primary/30' }}"></div>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <span class="duro-icon-tile absolute right-5 top-5 size-11 bg-surface"><x-duro.icon :name="$project['icon']" size="md" /></span>
                        </div>

                        <div class="flex flex-1 flex-col p-6 sm:p-7">
                            <div class="flex items-center justify-between gap-3">
                                <x-duro.badge variant="primary">{{ $project['category'] }}</x-duro.badge>
                                @if ($link)
                                    <span class="inline-flex items-center gap-1 text-xs text-success"><span class="size-1.5 rounded-full bg-success"></span> Live demo</span>
                                @endif
                            </div>
                            <h3 class="duro-heading mt-4 text-2xl">{{ $project['title'] }}</h3>
                            <p class="mt-3 text-sm leading-relaxed text-ink-muted">{{ $project['summary'] }}</p>

                            <ul class="mt-5 grid gap-2 sm:grid-cols-3">
                                @foreach ($project['outcomes'] as $outcome)
                                    <li class="flex items-start gap-2 text-xs text-ink">
                                        <x-duro.icon name="check-circle" class="mt-px size-3.5 text-primary-ink" /> {{ $outcome }}
                                    </li>
                                @endforeach
                            </ul>

                            <div class="mt-auto flex flex-wrap items-center justify-between gap-4 pt-6">
                                <div class="flex flex-wrap gap-1.5">
                                    @foreach ($project['stack'] as $tech)
                                        <span class="rounded-ui border border-line bg-surface-2 px-2 py-0.5 font-mono text-[0.68rem] text-ink-muted">{{ $tech }}</span>
                                    @endforeach
                                </div>
                                @if ($link)
                                    <x-duro.button :href="$link" variant="link" size="sm" icon-right="arrow-up-right">Open</x-duro.button>
                                @else
                                    <span class="text-xs text-ink-subtle">Case study on request</span>
                                @endif
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============================================================
         REALMS (THEME GALLERY)
    ============================================================ --}}
    <section id="realms" class="mx-auto max-w-7xl px-4 py-24 sm:px-6 lg:px-8 lg:py-32">
        <x-duro.section-heading
            align="center"
            eyebrow="Five realms, one codebase"
            title="Pick a realm. The whole site transforms."
            description="Each theme is a full identity — palette, typography, shapes, ornaments and brand art — driven by design tokens. That same flexibility goes into the products I build for clients."
        />

        <div class="mt-14 grid gap-4 sm:grid-cols-2 lg:grid-cols-5">
            @foreach ($themes as $key => $theme)
                <button
                    type="button"
                    data-theme="{{ $key }}"
                    x-on:click="$store.theme.set(@js($key), $event)"
                    class="group relative flex flex-col overflow-hidden rounded-card border-2 bg-canvas p-5 text-left text-ink transition duration-300 hover:-translate-y-1.5"
                    :class="$store.theme.current === @js($key) ? 'border-primary shadow-glow' : 'border-line hover:border-line-strong'"
                    data-reveal
                    style="--reveal-delay: {{ $loop->index * 70 }}ms"
                    aria-label="Switch to the {{ $theme['name'] }} theme"
                >
                    <span class="absolute right-3 top-3 grid size-6 place-items-center rounded-full bg-primary text-on-primary transition" :class="$store.theme.current === @js($key) ? 'scale-100 opacity-100' : 'scale-50 opacity-0'">
                        <x-duro.icon name="check" class="size-3.5" stroke="3" />
                    </span>

                    <span class="duro-logo-mark mx-auto my-4 block size-24 transition-transform duration-500 group-hover:scale-110 group-hover:rotate-3"></span>

                    <span class="font-display text-xl font-bold leading-tight text-ink">{{ $theme['name'] }}</span>
                    <span class="mt-1 text-xs leading-snug text-ink-muted">{{ $theme['tagline'] }}</span>

                    <span class="mt-5 flex items-center gap-2">
                        <span class="rounded-ui bg-primary px-2.5 py-1 font-label text-[0.6rem] font-bold uppercase tracking-wider text-on-primary">Button</span>
                        <span class="rounded-ui border border-line bg-surface px-2.5 py-1 text-[0.65rem] text-ink-muted">Input</span>
                        <span class="ml-auto flex -space-x-1">
                            @foreach ($theme['swatches'] as $swatch)
                                <span class="size-3.5 rounded-full ring-2 ring-canvas" style="background: {{ $swatch }}"></span>
                            @endforeach
                        </span>
                    </span>
                </button>
            @endforeach
        </div>

        <p class="mt-8 text-center text-xs text-ink-subtle">Tip: press <x-duro.kbd>⌘</x-duro.kbd> <x-duro.kbd>K</x-duro.kbd> inside the UI kit to switch realms from the command palette.</p>
    </section>

    {{-- ============================================================
         PROCESS
    ============================================================ --}}
    <section id="process" class="duro-band py-24 lg:py-32">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-duro.section-heading
                eyebrow="How we work together"
                title="A calm, transparent process."
                description="No black boxes. You always know what is being built, why, and when you can click it."
            />

            <ol class="relative mt-14 grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                <div class="absolute left-0 right-0 top-7 hidden h-px bg-gradient-to-r from-transparent via-line-strong to-transparent lg:block" aria-hidden="true"></div>
                @foreach ($portfolio['process'] as $step)
                    <li class="relative" data-reveal style="--reveal-delay: {{ $loop->index * 90 }}ms">
                        <span class="relative z-10 grid size-14 place-items-center rounded-full border-2 border-primary bg-surface font-display text-xl font-bold text-primary-ink shadow-glow">
                            {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                        </span>
                        <h3 class="duro-heading mt-6 text-xl">{{ $step['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-ink-muted">{{ $step['body'] }}</p>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    {{-- ============================================================
         UI KIT PLAYGROUND
    ============================================================ --}}
    <section class="mx-auto max-w-7xl px-4 py-24 sm:px-6 lg:px-8 lg:py-32">
        <div class="grid items-center gap-12 lg:grid-cols-[1fr_1.15fr]">
            <div class="space-y-8">
                <x-duro.section-heading
                    eyebrow="Duro UI kit"
                    title="A Filament-grade component library, built from scratch."
                    description="Forms, tables, overlays, navigation and feedback — every piece themeable, accessible and wired for Livewire. Try it right here."
                />

                <ul class="grid gap-3 sm:grid-cols-2" data-reveal>
                    @foreach (['Searchable selects & multi-selects', 'Date, time & date-time pickers', 'Data tables with filters', 'Modals, slide-overs & toasts', 'Repeaters, builders & key-value', 'Command palette & keyboard nav'] as $feature)
                        <li class="flex items-center gap-2.5 text-sm text-ink-muted">
                            <span class="grid size-5 place-items-center rounded-full bg-primary/15 text-primary-ink"><x-duro.icon name="check" class="size-3" stroke="3" /></span>
                            {{ $feature }}
                        </li>
                    @endforeach
                </ul>

                <div class="flex flex-wrap gap-3" data-reveal>
                    <x-duro.button :href="route('showcase')" icon-right="arrow-right">Browse all components</x-duro.button>
                    <x-duro.button :href="route('form-components')" variant="secondary" icon="edit">Form demo</x-duro.button>
                </div>
            </div>

            <div class="duro-card duro-card-ornate p-6 sm:p-8" data-reveal style="--reveal-delay: 120ms">
                <x-duro.tabs :tabs="['actions' => 'Actions', 'inputs' => 'Inputs', 'feedback' => 'Feedback']">
                    <x-duro.tabs.panel name="actions" class="space-y-6">
                        <div class="flex flex-wrap gap-3">
                            <x-duro.button icon="rocket">Primary</x-duro.button>
                            <x-duro.button variant="secondary">Secondary</x-duro.button>
                            <x-duro.button variant="outline">Outline</x-duro.button>
                            <x-duro.button variant="ghost">Ghost</x-duro.button>
                        </div>
                        <div class="flex flex-wrap items-center gap-3">
                            <x-duro.badge variant="primary">Primary</x-duro.badge>
                            <x-duro.badge variant="success" dot>Online</x-duro.badge>
                            <x-duro.badge variant="warning">Pending</x-duro.badge>
                            <x-duro.badge variant="danger">Overdue</x-duro.badge>
                        </div>
                        <div class="flex items-center justify-between gap-4 rounded-ui border border-line bg-surface-2 p-4">
                            <div class="flex items-center gap-3">
                                <x-duro.avatar-group :names="['Ada Lovelace', 'Alan Turing', 'Grace Hopper', 'Linus Torvalds', 'Margaret Hamilton']" :max="3" />
                                <span class="text-xs text-ink-muted">5 collaborators</span>
                            </div>
                            <x-duro.button size="sm" variant="secondary" icon="plus" x-on:click="duroToast({ title: 'Invitation sent', body: 'Your teammate will receive an email shortly.', variant: 'success' })">Invite</x-duro.button>
                        </div>
                    </x-duro.tabs.panel>

                    <x-duro.tabs.panel name="inputs" class="space-y-5" x-cloak>
                        <x-duro.input name="demo_search" label="Search" icon="search" placeholder="Find anything…" />
                        <x-duro.select label="Framework" :options="['laravel' => 'Laravel', 'livewire' => 'Livewire', 'filament' => 'Filament', 'alpine' => 'Alpine.js']" value="livewire" />
                        <div class="grid gap-4 sm:grid-cols-2">
                            <x-duro.switch label="Email alerts" hint="Weekly summary" :checked="true" />
                            <x-duro.checkbox label="Accept terms" checked />
                        </div>
                    </x-duro.tabs.panel>

                    <x-duro.tabs.panel name="feedback" class="space-y-5" x-cloak>
                        <x-duro.alert variant="success" title="Deployment complete">Version 2.4 is live on all regions.</x-duro.alert>
                        <x-duro.progress label="Sprint progress" :value="72" />
                        <x-duro.stepper :steps="['Brief', 'Design', 'Build', 'Launch']" :current="3" />
                    </x-duro.tabs.panel>
                </x-duro.tabs>
            </div>
        </div>
    </section>

    {{-- ============================================================
         FAQ + CONTACT
    ============================================================ --}}
    <section id="contact" class="duro-band py-24 lg:py-32">
        <div class="mx-auto grid max-w-7xl gap-14 px-4 sm:px-6 lg:grid-cols-[0.9fr_1.1fr] lg:px-8">
            <div class="space-y-10">
                <x-duro.section-heading
                    eyebrow="Let's build something"
                    title="Tell me about your project."
                    description="Share a few details and I will reply with questions, ideas and a clear next step."
                />

                <div class="grid gap-3 sm:grid-cols-2" data-reveal>
                    <a href="mailto:{{ $portfolio['email'] }}" class="duro-card duro-card-interactive flex items-center gap-3 p-4">
                        <span class="duro-icon-tile size-10"><x-duro.icon name="mail" size="md" /></span>
                        <span class="min-w-0">
                            <span class="block text-xs text-ink-subtle">Email</span>
                            <span class="block truncate text-sm font-semibold text-ink">{{ $portfolio['email'] }}</span>
                        </span>
                    </a>
                    <div class="duro-card flex items-center gap-3 p-4">
                        <span class="duro-icon-tile size-10"><x-duro.icon name="clock" size="md" /></span>
                        <span>
                            <span class="block text-xs text-ink-subtle">Availability</span>
                            <span class="block text-sm font-semibold text-ink">{{ $portfolio['availability'] }}</span>
                        </span>
                    </div>
                </div>

                <div class="space-y-4" data-reveal>
                    <p class="duro-label">Frequently asked</p>
                    <x-duro.accordion>
                        @foreach ($portfolio['faq'] as $item)
                            <x-duro.accordion.item :title="$item['question']" :open="$loop->first">
                                {{ $item['answer'] }}
                            </x-duro.accordion.item>
                        @endforeach
                    </x-duro.accordion>
                </div>
            </div>

            <div data-reveal style="--reveal-delay: 120ms">
                <livewire:landing.contact />
            </div>
        </div>
    </section>
</div>
