<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>{{ $title ?? 'Durolord' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body
    class="min-h-screen antialiased bg-neutralfog-100 text-shadow-900 light:bg-neutralfog-100 light:text-shadow-900 dark:bg-shadow-950 dark:text-neutralfog-100"
    x-data="layoutState()"
>
    <div class="flex items-center justify-between px-4 py-3">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-electric-700 dark:text-electric-300">
            <div class="w-8 h-8 rounded-full border border-electric-500 flex items-center justify-center overflow-hidden bg-neutralfog-100 dark:bg-shadow-900">
                <img
                    src="{{ asset('images/logo.png') }}"
                    alt="Durolord logo"
                    class="w-full h-full object-contain"
                >
            </div>
            <span>DUROLORD</span>
        </a>

        <button
            type="button"
            x-on:click="cycleTheme()"
            x-tooltip.bottom="'Switch theme'"
            class="inline-flex items-center gap-2 rounded-full bg-neutralfog-100/90 border border-neutralfog-300/80 px-2.5 py-1.5 text-[11px] text-neutral-700 hover:text-electric-700 hover:border-electric-500/60 dark:bg-shadow-900/80 dark:border-silver-500/60 dark:text-neutralfog-300 dark:hover:text-electric-300 transition"
            :aria-label="`Theme: ${theme}`"
        >
            <span class="inline-flex">
                <svg x-show="theme === 'light'" x-transition.opacity.duration.150ms class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                    <circle cx="12" cy="12" r="3.5" />
                    <path d="M12 2.5v2.5M12 19v2.5M4.22 4.22l1.77 1.77M18.01 17.99l1.77 1.77M2.5 12h2.5M19 12h2.5M4.22 19.78l1.77-1.77M18.01 6.01l1.77-1.77" />
                </svg>
                <svg x-show="theme === 'dark'" x-transition.opacity.duration.150ms class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                    <path d="M20.5 14.5A7.5 7.5 0 0 1 11 5a7.5 7.5 0 1 0 9.5 9.5Z" />
                </svg>
                <svg x-show="theme === 'system'" x-transition.opacity.duration.150ms class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                    <rect x="3" y="4" width="18" height="13" rx="2" />
                    <path d="M8 20h8" />
                </svg>
            </span>
            <span class="capitalize" x-text="theme"></span>
        </button>
    </div>

    <main class="min-h-screen bg-gradient-to-b from-neutral-50 to-neutral-100 dark:from-shadow-950 dark:to-black">
        <div class="container mx-auto px-4 py-10">
            {{ $slot }}
        </div>
    </main>

    @livewireScripts
</body>
</html>
