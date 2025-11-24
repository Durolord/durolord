<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="h-full"
    x-data="layoutState()"
    x-bind:class="theme === 'dark' ? 'dark h-full' : 'h-full'"
>
<head>
    <meta charset="utf-8">
    <title>{{ $title ?? 'Durolord - Digital Realms' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body
    class="min-h-screen bg-gradient-to-b from-shadow-950 via-shadow-900 to-shadow-950 text-neutralfog-100 antialiased flex items-center justify-center p-4"
>

    {{-- MYSTICAL AURORA --}}
    <div class="absolute inset-0 pointer-events-none mix-blend-screen opacity-70">
        <div
            class="w-full h-full
            bg-[radial-gradient(circle_at_top,_oklch(0.82_0.19_85/_0.25),_transparent_65%),_
                 radial-gradient(circle_at_20%_80%,_oklch(0.70_0.15_215/_0.3),_transparent_60%),_
                 radial-gradient(circle_at_80%_60%,_oklch(0.75_0.22_320/_0.25),_transparent_60%)]">
        </div>
    </div>

    {{-- MAIN PAGE WRAPPER --}}
    <main class="relative z-10 w-full max-w-4xl mx-auto">

        {{-- GLASS CONTAINER --}}
        <div class="bg-shadow-950/80 border border-silver-500/20 shadow-xl shadow-black/60
                    rounded-2xl backdrop-blur-lg p-8 space-y-6">

            {{-- TOP BAR WITH ONLY A THEME TOGGLE BUTTON --}}
            <div class="flex items-center justify-end">

                <button
                    type="button"
                    x-on:click="cycleTheme()"
                    class="inline-flex items-center justify-center w-9 h-9 rounded-full border
                           border-neutral-700 bg-shadow-900/80 text-xs text-neutralfog-300
                           hover:border-electric-400 hover:text-electric-200 transition"
                    :aria-label="`Theme: ${theme}`"
                >
                    {{-- Light --}}
                    <span x-show="theme === 'light'" x-transition.opacity>☀️</span>

                    {{-- Dark --}}
                    <span x-show="theme === 'dark'" x-transition.opacity>🌙</span>

                    {{-- System --}}
                    <span x-show="theme === 'system'" x-transition.opacity>🖥️</span>
                </button>
            </div>

            {{-- PAGE CONTENT --}}
            <div class="mt-2">
                {{ $slot }}
            </div>
        </div>

        {{-- FOOTER --}}
        <p class="mt-6 text-xs text-center text-neutral-400">
            DUROLORD · Forged in Light and Darkness · {{ date('Y') }}
        </p>
    </main>

    @livewireScripts
</body>
</html>
