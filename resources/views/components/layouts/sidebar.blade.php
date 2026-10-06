<aside
    class="hidden md:flex flex-col transition-all duration-200 bg-neutralfog-100/95 border-r border-neutralfog-300/80 dark:bg-shadow-950/95 dark:border-shadow-800/80"
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
            v0.1 - Duro UI
        </span>
    </div>
</aside>
