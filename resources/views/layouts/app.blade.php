<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>{{ $title ?? 'Durolord — Digital Realms' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('partials.theme-bootstrap')

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body
    class="min-h-screen antialiased bg-neutralfog-100 text-shadow-900 light:bg-neutralfog-100 light:text-shadow-900 dark:bg-shadow-950 dark:text-neutralfog-100"
    x-data="layoutState()"
>
    <div class="min-h-screen flex">
        {{-- SIDEBAR --}}
        <aside
            class="hidden md:flex flex-col transition-all duration-200
                   bg-neutralfog-100/95 border-r border-neutralfog-300/80
                   dark:bg-shadow-950/95 dark:border-shadow-800/80"
            :class="sidebarCollapsed ? 'w-20' : 'w-64'"
        >
            {{-- Logo / brand --}}
            <div class="px-4 py-5 border-b border-neutralfog-300/80 dark:border-shadow-800/80 flex justify-center md:justify-start">
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="w-9 h-9 rounded-full border border-electric-500 glow-electric flex items-center justify-center overflow-hidden bg-neutralfog-100 dark:bg-shadow-900">
                        <img
                            src="{{ asset('images/logo.png') }}"
                            alt="Durolord logo"
                            class="w-full h-full object-contain"
                        >
                    </div>

                    <div
                        class="origin-left transition-all duration-150"
                        :class="sidebarCollapsed ? 'opacity-0 scale-90 pointer-events-none w-0' : 'opacity-100 scale-100 w-auto'"
                    >
                        <div class="text-sm font-semibold tracking-wide text-gold-500 group-hover:text-gold-400 dark:text-gold-300 dark:group-hover:text-gold-200 transition">
                            DUROLORD
                        </div>
                        <div class="text-[11px] text-neutral-500 dark:text-neutralfog-400">
                            Maker of Digital Realms
                        </div>
                    </div>
                </a>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 px-2 py-4 space-y-1 text-sm">
                <a
                    href="{{ route('home') }}"
                    x-tooltip.bottom="'Realm Landing'"
                    class="flex items-center gap-3 px-3 py-2 rounded-xl transition
                        {{ request()->routeIs('home')
                            ? 'bg-neutralfog-200 text-electric-600 border border-electric-500/40 dark:bg-shadow-900 dark:text-electric-300 dark:border-electric-500/40 glow-electric'
                            : 'text-neutral-700 hover:text-electric-700 hover:bg-neutralfog-200/80 dark:text-neutralfog-300 dark:hover:text-electric-200 dark:hover:bg-shadow-900/70' }}"
                >
                    <span class="inline-flex w-2 h-2 rounded-full bg-electric-500"></span>
                    <span
                        class="truncate transition-all duration-150"
                        :class="sidebarCollapsed ? 'opacity-0 scale-90 w-0' : 'opacity-100 scale-100 w-auto'"
                    >
                        Realm Landing
                    </span>
                </a>

                <a
                    href="{{ route('showcase') }}"
                    x-tooltip.bottom="'Components'"
                    class="flex items-center gap-3 px-3 py-2 rounded-xl transition
                        {{ request()->routeIs('showcase')
                            ? 'bg-neutralfog-200 text-electric-600 border border-electric-500/40 dark:bg-shadow-900 dark:text-electric-300 dark:border-electric-500/40 glow-electric'
                            : 'text-neutral-700 hover:text-electric-700 hover:bg-neutralfog-200/80 dark:text-neutralfog-300 dark:hover:text-electric-200 dark:hover:bg-shadow-900/70' }}"
                >
                    <span class="inline-flex w-2 h-2 rounded-full bg-gold-500"></span>
                    <span
                        class="truncate transition-all duration-150"
                        :class="sidebarCollapsed ? 'opacity-0 scale-90 w-0' : 'opacity-100 scale-100 w-auto'"
                    >
                        Components
                    </span>
                </a>
            </nav>

            {{-- Sidebar footer --}}
            <div class="px-3 py-3 border-t border-neutralfog-300/80 dark:border-shadow-800/80 text-[10px] text-neutral-500 dark:text-neutralfog-400">
                <span
                    class="block transition-all duration-150"
                    :class="sidebarCollapsed ? 'opacity-0 scale-90 w-0' : 'opacity-100 scale-100 w-auto'"
                >
                    v0.1 • Duro UI
                </span>
            </div>
        </aside>

        {{-- MAIN AREA --}}
        <div class="flex-1 flex flex-col">
            {{-- TOP NAVBAR --}}
            <header class="px-4 md:px-6 py-3 flex items-center justify-between border-b bg-neutralfog-100/95 border-neutralfog-300/80 dark:bg-shadow-950/95 dark:border-shadow-800/80">
                <div class="flex items-center gap-3">
                    {{-- Sidebar toggle (desktop) --}}
                    <button
                        type="button"
                        class="hidden md:inline-flex items-center justify-center w-8 h-8 rounded-full border bg-neutralfog-100 border-neutralfog-300 text-neutral-700 hover:bg-neutralfog-200 hover:text-electric-700 dark:bg-shadow-900 dark:border-shadow-800 dark:text-neutralfog-300 dark:hover:bg-shadow-800 dark:hover:text-electric-300 transition"
                        x-on:click="toggleSidebar()"
                        x-tooltip.bottom="'Toggle sidebar'"
                        aria-label="Toggle sidebar"
                    >
                        {{-- Expanded icon --}}
                        <svg
                            x-show="!sidebarCollapsed"
                            x-transition.opacity.duration.150ms
                            class="w-4 h-4"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.6"
                        >
                            <path d="M4 6h16M4 12h10M4 18h16" />
                        </svg>

                        {{-- Collapsed icon --}}
                        <svg
                            x-show="sidebarCollapsed"
                            x-transition.opacity.duration.150ms
                            class="w-4 h-4"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.6"
                        >
                            <path d="M5 6h14M9 12h10M5 18h14" />
                        </svg>
                    </button>

                    {{-- Mobile logo / brand --}}
                    <a href="{{ route('home') }}" class="flex md:hidden items-center gap-2">
                        <div class="w-8 h-8 rounded-full border border-electric-500 flex items-center justify-center overflow-hidden bg-neutralfog-100 dark:bg-shadow-900">
                            <img
                                src="{{ asset('images/logo.png') }}"
                                alt="Durolord logo"
                                class="w-full h-full object-contain"
                            >
                        </div>
                        <span class="text-xs font-semibold text-gold-600 dark:text-gold-300">DUROLORD</span>
                    </a>

                    {{-- Page title --}}
                    <span class="hidden md:inline-flex text-xs uppercase tracking-[0.16em] text-neutral-500 dark:text-neutralfog-400">
                        {{ $title ?? 'Digital Realms' }}
                    </span>
                </div>

                <div class="flex items-center gap-3 md:gap-4 text-xs">
                    {{-- Auth links --}}
                    @if (Route::has('login'))
                        @auth
                            <a
                                href="{{ url('/dashboard') }}"
                                x-tooltip.bottom="'Go to dashboard'"
                                class="hidden sm:inline-flex px-3 py-1.5 rounded-full border bg-neutralfog-100 border-neutralfog-300 text-neutral-700 hover:text-electric-700 hover:border-electric-500/50 dark:bg-shadow-900 dark:border-shadow-800 dark:text-neutralfog-200 dark:hover:text-electric-200 dark:hover:border-electric-500/50 transition"
                            >
                                Dashboard
                            </a>
                        @else
                            <a
                                href="{{ route('login') }}"
                                x-tooltip.bottom="'Log in to your realm'"
                                class="px-3 py-1.5 rounded-full border bg-neutralfog-100 border-neutralfog-300 text-neutral-700 hover:text-electric-700 hover:border-electric-500/50 dark:bg-shadow-900 dark:border-shadow-800 dark:text-neutralfog-200 dark:hover:text-electric-200 dark:hover:border-electric-500/50 transition"
                            >
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <a
                                    href="{{ route('register') }}"
                                    x-tooltip.bottom="'Create a new account'"
                                    class="hidden sm:inline-flex px-3 py-1.5 rounded-full border border-electric-500/70 bg-electric-500/5 text-electric-700 hover:bg-electric-500/15 dark:bg-electric-500/10 dark:text-electric-300 dark:hover:bg-electric-500/20 transition"
                                >
                                    Register
                                </a>
                            @endif
                        @endauth
                    @endif

                    {{-- Theme switcher: single button cycling light → dark → system --}}
                    <div class="flex items-center">
                        <x-duro.theme-switcher />
                    </div>
                </div>
            </header>

            {{-- Page content --}}
            <main class="flex-1">
                {{ $slot }}
            </main>

            {{-- Footer --}}
            <footer class="py-4 text-center text-xs bg-neutralfog-100/95 border-t border-neutralfog-300/80 text-neutral-600 dark:bg-shadow-900/80 dark:border-shadow-800/80 dark:text-neutralfog-300">
                Forged in light and darkness • {{ date('Y') }}
            </footer>
        </div>
    </div>

    @livewireScripts
</body>
</html>
