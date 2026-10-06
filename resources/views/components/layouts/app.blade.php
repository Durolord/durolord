@props([
    'title' => null,
    'description' => null,
])

@php
    $user = auth()->user();

    $navGroups = [
        'Overview' => array_values(array_filter([
            $user ? ['label' => 'Dashboard', 'route' => 'dashboard', 'icon' => 'home'] : null,
            ['label' => 'Portfolio', 'route' => 'home', 'icon' => 'globe'],
        ])),
        'UI Kit' => [
            ['label' => 'Overview', 'route' => 'showcase', 'icon' => 'sparkles'],
            ['label' => 'Forms', 'route' => 'form-components', 'icon' => 'edit'],
            ['label' => 'Tables', 'route' => 'table-components', 'icon' => 'table'],
            ['label' => 'Elements', 'route' => 'elements', 'icon' => 'layers', 'badge' => 'New'],
        ],
    ];

    if ($user) {
        $navGroups['Workspace'] = array_values(array_filter([
            ['label' => 'Services', 'route' => 'services.index', 'active' => 'services.*', 'icon' => 'calendar'],
            $user->email === 'noreply@durolord.com' ? ['label' => 'Analytics', 'route' => 'dashboard.analytics', 'icon' => 'bar-chart'] : null,
            ['label' => 'Profile', 'route' => 'profile', 'icon' => 'user'],
        ]));
    }

    $commands = collect($navGroups)
        ->flatMap(fn ($items, $group) => collect($items)->map(fn ($item) => [
            'label' => $item['label'],
            'group' => $group,
            'icon' => $item['icon'],
            'href' => route($item['route']),
        ]))
        ->merge(collect(config('duro.themes'))->map(fn ($theme, $key) => [
            'label' => 'Switch to '.$theme['name'],
            'group' => 'Realms',
            'icon' => 'palette',
            'theme' => $key,
            'keywords' => 'theme '.$theme['mode'],
        ])->values())
        ->values();
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head', ['title' => $title ? $title.' · '.config('portfolio.name') : null, 'description' => $description])
</head>
<body class="min-h-screen font-sans antialiased" x-data="layoutState()">
    <div class="duro-backdrop" aria-hidden="true"></div>

    <div class="flex min-h-screen">
        {{-- DESKTOP SIDEBAR --}}
        <aside
            class="sticky top-0 hidden h-screen shrink-0 flex-col border-r border-line bg-canvas/70 backdrop-blur-xl transition-[width] duration-300 lg:flex"
            :class="sidebarCollapsed ? 'w-[4.75rem]' : 'w-64'"
        >
            <div class="flex h-16 items-center border-b border-line px-4">
                <a href="{{ route('home') }}" class="overflow-hidden">
                    <x-duro.logo size="sm" x-bind:class="sidebarCollapsed && '[&>span:last-child]:hidden'" />
                </a>
            </div>

            <x-layouts.sidebar :groups="$navGroups" />

            <div class="border-t border-line p-3">
                <button type="button" x-on:click="toggleSidebar()" class="duro-menu-item justify-center" :class="! sidebarCollapsed && '!justify-start'" aria-label="Toggle sidebar">
                    <x-duro.icon name="chevrons-left" class="transition-transform" x-bind:class="sidebarCollapsed && 'rotate-180'" />
                    <span x-show="! sidebarCollapsed" class="text-xs">Collapse</span>
                </button>
            </div>
        </aside>

        {{-- MOBILE SIDEBAR --}}
        <div x-cloak x-show="mobileNav" class="fixed inset-0 z-[60] lg:hidden" x-on:keydown.escape.window="mobileNav = false">
            <div x-show="mobileNav" x-transition.opacity class="absolute inset-0 bg-black/60 backdrop-blur-sm" x-on:click="mobileNav = false"></div>
            <aside
                x-show="mobileNav"
                x-trap.inert="mobileNav"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="-translate-x-full"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-end="-translate-x-full"
                class="duro-panel absolute inset-y-0 left-0 flex w-72 flex-col !rounded-none"
            >
                <div class="flex h-16 items-center justify-between border-b border-line px-4">
                    <x-duro.logo size="sm" />
                    <button type="button" x-on:click="mobileNav = false" class="duro-btn duro-btn-ghost duro-btn-sm duro-btn-icon" aria-label="Close menu">
                        <x-duro.icon name="x" size="md" />
                    </button>
                </div>
                <x-layouts.sidebar :groups="$navGroups" />
            </aside>
        </div>

        {{-- MAIN --}}
        <div class="flex min-w-0 flex-1 flex-col">
            <header class="sticky top-0 z-40 flex h-16 items-center gap-3 border-b border-line bg-canvas/75 px-4 backdrop-blur-xl sm:px-6">
                <button type="button" class="duro-btn duro-btn-ghost duro-btn-sm duro-btn-icon lg:hidden" x-on:click="mobileNav = true" aria-label="Open menu">
                    <x-duro.icon name="menu" size="md" />
                </button>

                <button type="button" x-on:click="palette = true" class="duro-btn duro-btn-ghost duro-btn-sm duro-btn-icon sm:hidden" aria-label="Search">
                    <x-duro.icon name="search" size="md" />
                </button>

                <button
                    type="button"
                    x-on:click="palette = true"
                    class="duro-field hidden max-w-sm flex-1 cursor-pointer px-3 py-2 text-left text-sm text-ink-subtle sm:flex"
                >
                    <x-duro.icon name="search" />
                    <span class="flex-1 truncate">Search pages & realms…</span>
                    <span class="hidden items-center gap-1 sm:flex"><x-duro.kbd>⌘</x-duro.kbd><x-duro.kbd>K</x-duro.kbd></span>
                </button>

                <div class="ml-auto flex items-center gap-2">
                    <x-duro.theme-switcher class="hidden sm:block" />
                    <x-duro.theme-switcher compact class="sm:hidden" />

                    @auth
                        <x-duro.dropdown align="right" width="w-60">
                            <x-slot:trigger>
                                <button type="button" class="flex items-center gap-2 rounded-full p-0.5 transition hover:ring-2 hover:ring-primary/40" aria-label="Account menu">
                                    <x-duro.avatar :name="$user->name" size="sm" status="online" />
                                </button>
                            </x-slot:trigger>

                            <div class="px-3 py-2">
                                <p class="truncate text-sm font-semibold text-ink">{{ $user->name }}</p>
                                <p class="truncate text-xs text-ink-subtle">{{ $user->email }}</p>
                            </div>
                            <x-duro.dropdown.divider />
                            <x-duro.dropdown.item :href="route('dashboard')" icon="home">Dashboard</x-duro.dropdown.item>
                            <x-duro.dropdown.item :href="route('profile')" icon="settings">Profile & security</x-duro.dropdown.item>
                            <x-duro.dropdown.divider />
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-duro.dropdown.item type="submit" icon="logout" danger>Sign out</x-duro.dropdown.item>
                            </form>
                        </x-duro.dropdown>
                    @else
                        <x-duro.button :href="route('login')" variant="secondary" size="sm">Log in</x-duro.button>
                    @endauth
                </div>
            </header>

            <main class="flex-1">
                <div class="mx-auto w-full max-w-7xl px-4 py-8 sm:px-6 lg:px-8 lg:py-10">
                    {{ $slot }}
                </div>
            </main>

            <footer class="border-t border-line px-6 py-4 text-center text-xs text-ink-subtle">
                {{ config('portfolio.name') }} UI · Realm: <span class="font-semibold text-ink-muted" x-text="$store.theme.meta.name"></span> · {{ date('Y') }}
            </footer>
        </div>
    </div>

    {{-- COMMAND PALETTE --}}
    <div
        x-cloak
        x-show="palette"
        x-on:keydown.escape.window="palette = false"
        x-on:close-palette.window="palette = false"
        class="fixed inset-0 z-[80] flex items-start justify-center p-4 pt-[12vh]"
    >
        <div x-show="palette" x-transition.opacity class="absolute inset-0 bg-black/60 backdrop-blur-sm" x-on:click="palette = false"></div>

        <div
            x-show="palette"
            x-trap.noscroll="palette"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-data="commandPalette(@js($commands))"
            class="duro-panel relative w-full max-w-xl overflow-hidden"
            role="dialog"
            aria-label="Command palette"
        >
            <div class="flex items-center gap-3 border-b border-line px-4">
                <x-duro.icon name="search" class="text-ink-subtle" />
                <input
                    type="text"
                    x-model="query"
                    x-on:input="active = 0"
                    x-on:keydown.down.prevent="move(1)"
                    x-on:keydown.up.prevent="move(-1)"
                    x-on:keydown.enter.prevent="run(results[active], $event)"
                    placeholder="Jump to a page or switch realm…"
                    class="h-14 w-full border-0 bg-transparent text-sm text-ink placeholder:text-ink-subtle focus:outline-none focus:ring-0"
                >
                <x-duro.kbd>Esc</x-duro.kbd>
            </div>

            <ul x-ref="list" class="max-h-80 overflow-y-auto p-2">
                <template x-for="(command, index) in results" :key="command.label">
                    <li>
                        <button
                            type="button"
                            x-on:click="run(command, $event)"
                            x-on:mouseenter="active = index"
                            :data-active="(active === index).toString()"
                            :class="active === index && 'is-active'"
                            class="duro-menu-item"
                        >
                            <span class="duro-icon-tile size-7"><x-duro.icon name="arrow-right" class="size-3.5" /></span>
                            <span class="flex-1 text-ink" x-text="command.label"></span>
                            <span class="text-[0.65rem] uppercase tracking-wider text-ink-subtle" x-text="command.group"></span>
                        </button>
                    </li>
                </template>
                <li x-show="results.length === 0" class="py-10 text-center text-sm text-ink-subtle">No matches. Try “tables” or “neon”.</li>
            </ul>
        </div>
    </div>

    <x-duro.toasts />

    @livewireScripts
</body>
</html>
