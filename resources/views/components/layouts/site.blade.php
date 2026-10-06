@props([
    'title' => null,
    'description' => null,
])

@php
    $navLinks = [
        'About' => route('home').'#about',
        'Work' => route('home').'#work',
        'Services' => route('home').'#services',
        'Realms' => route('home').'#realms',
        'Process' => route('home').'#process',
        'UI Kit' => route('showcase'),
    ];
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head', ['title' => $title, 'description' => $description])
</head>
<body class="min-h-screen font-sans antialiased" x-data="layoutState()" :class="mobileNav && 'overflow-hidden'">
    <div class="duro-backdrop" aria-hidden="true"></div>

    <a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-[100] duro-btn duro-btn-primary duro-btn-sm">Skip to content</a>

    {{-- HEADER --}}
    <header
        class="fixed inset-x-0 top-0 z-50 transition-all duration-300"
        :class="scrolled ? 'border-b border-line bg-canvas/80 shadow-card backdrop-blur-xl' : 'border-b border-transparent'"
    >
        <div class="mx-auto flex h-18 max-w-7xl items-center justify-between gap-4 px-4 sm:px-6 lg:px-8" style="height: 4.5rem">
            <a href="{{ route('home') }}" class="shrink-0" aria-label="{{ config('portfolio.name') }} — home">
                <x-duro.logo size="sm" />
            </a>

            <nav class="hidden items-center gap-1 lg:flex" aria-label="Primary">
                @foreach ($navLinks as $label => $url)
                    <a href="{{ $url }}" class="relative rounded-ui px-3.5 py-2 text-sm font-medium text-ink-muted transition hover:text-ink after:absolute after:inset-x-3.5 after:bottom-1 after:h-px after:origin-left after:scale-x-0 after:bg-primary after:transition-transform hover:after:scale-x-100">
                        {{ $label }}
                    </a>
                @endforeach
            </nav>

            <div class="flex items-center gap-2">
                <x-duro.theme-switcher class="hidden sm:block" />

                @auth
                    <x-duro.button :href="route('dashboard')" variant="ghost" size="sm" class="hidden md:inline-flex">Dashboard</x-duro.button>
                @endauth

                <x-duro.button :href="route('home').'#contact'" size="sm" icon-right="arrow-right" class="hidden sm:inline-flex">Hire me</x-duro.button>

                <button type="button" class="duro-btn duro-btn-secondary duro-btn-sm duro-btn-icon lg:hidden" x-on:click="mobileNav = true" aria-label="Open menu">
                    <x-duro.icon name="menu" />
                </button>
            </div>
        </div>
    </header>

    {{-- MOBILE NAV --}}
    <div x-cloak x-show="mobileNav" class="fixed inset-0 z-[60] lg:hidden" x-on:keydown.escape.window="mobileNav = false">
        <div x-show="mobileNav" x-transition.opacity class="absolute inset-0 bg-black/60 backdrop-blur-sm" x-on:click="mobileNav = false"></div>
        <div
            x-show="mobileNav"
            x-trap.inert="mobileNav"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="translate-x-full"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-end="translate-x-full"
            class="duro-panel absolute inset-y-0 right-0 flex w-[min(22rem,88vw)] flex-col !rounded-none p-6"
        >
            <div class="flex items-center justify-between">
                <x-duro.logo size="sm" />
                <button type="button" class="duro-btn duro-btn-ghost duro-btn-sm duro-btn-icon" x-on:click="mobileNav = false" aria-label="Close menu">
                    <x-duro.icon name="x" size="md" />
                </button>
            </div>

            <nav class="mt-10 flex flex-col gap-1" aria-label="Mobile">
                @foreach ($navLinks as $label => $url)
                    <a href="{{ $url }}" x-on:click="mobileNav = false" class="flex items-center justify-between rounded-ui px-3 py-3 font-display text-xl text-ink transition hover:bg-primary/10">
                        {{ $label }}
                        <x-duro.icon name="arrow-right" class="text-ink-subtle" />
                    </a>
                @endforeach
            </nav>

            <div class="mt-auto space-y-4">
                <x-duro.theme-switcher align="top" class="w-full" />
                <x-duro.button :href="route('home').'#contact'" class="w-full" icon-right="arrow-right" x-on:click="mobileNav = false">Hire me</x-duro.button>
            </div>
        </div>
    </div>

    <main id="main">
        {{ $slot }}
    </main>

    {{-- FOOTER --}}
    <footer class="duro-band relative overflow-hidden">
        <div class="mx-auto grid max-w-7xl gap-12 px-4 py-16 sm:px-6 lg:grid-cols-[1.4fr_1fr_1fr] lg:px-8">
            <div class="space-y-5">
                <x-duro.logo size="md" :tagline="config('portfolio.role')" />
                <p class="max-w-sm text-sm leading-relaxed text-ink-muted">{{ config('portfolio.summary') }}</p>
                <div class="flex gap-2">
                    @foreach (array_filter(config('portfolio.socials')) as $network => $url)
                        <a href="{{ $url }}" target="_blank" rel="noopener" class="duro-btn duro-btn-secondary duro-btn-sm duro-btn-icon" aria-label="{{ $network }}" x-tooltip.top="'{{ $network }}'">
                            <x-duro.icon :name="['GitHub' => 'github', 'LinkedIn' => 'linkedin', 'X' => 'x-brand'][$network] ?? 'globe'" />
                        </a>
                    @endforeach
                    <a href="mailto:{{ config('portfolio.email') }}" class="duro-btn duro-btn-secondary duro-btn-sm duro-btn-icon" aria-label="Email" x-tooltip.top="'Email'">
                        <x-duro.icon name="mail" />
                    </a>
                </div>
            </div>

            <div>
                <p class="duro-label mb-4">Explore</p>
                <ul class="space-y-2.5 text-sm">
                    @foreach ($navLinks as $label => $url)
                        <li><a href="{{ $url }}" class="text-ink-muted transition hover:text-primary-ink">{{ $label }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div>
                <p class="duro-label mb-4">UI Kit</p>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ route('form-components') }}" class="text-ink-muted transition hover:text-primary-ink">Form components</a></li>
                    <li><a href="{{ route('table-components') }}" class="text-ink-muted transition hover:text-primary-ink">Table components</a></li>
                    <li><a href="{{ route('elements') }}" class="text-ink-muted transition hover:text-primary-ink">Elements & overlays</a></li>
                    <li><a href="{{ route('login') }}" class="text-ink-muted transition hover:text-primary-ink">Client login</a></li>
                </ul>
            </div>
        </div>

        <div class="border-t border-line">
            <div class="mx-auto flex max-w-7xl flex-col gap-3 px-4 py-6 text-xs text-ink-subtle sm:flex-row sm:items-center sm:justify-between sm:px-6 lg:px-8">
                <p>© {{ date('Y') }} {{ config('portfolio.name') }}. Forged with Laravel, Livewire & Tailwind.</p>
                <p class="flex items-center gap-2">
                    Current realm:
                    <span class="font-semibold text-ink" x-text="$store.theme.meta.name"></span>
                    <button type="button" class="duro-link" x-on:click="cycleTheme($event)">Next realm →</button>
                </p>
            </div>
        </div>
    </footer>

    <x-duro.toasts />

    @livewireScripts
</body>
</html>
