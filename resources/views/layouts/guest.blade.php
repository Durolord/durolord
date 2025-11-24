{{-- resources/views/layouts/guest.blade.php --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{
    darkMode: localStorage.getItem('theme') === 'dark',
    toggleTheme() {
        this.darkMode = !this.darkMode;
        localStorage.setItem('theme', this.darkMode ? 'dark' : 'light');
        document.documentElement.classList.toggle('dark', this.darkMode);
    }
}"
x-init="
    document.documentElement.classList.toggle('dark', darkMode);
"
class="scroll-smooth"
>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body
    class="min-h-screen antialiased bg-neutralfog-100 text-shadow-900 light:bg-neutralfog-100 light:text-shadow-900 dark:bg-shadow-950 dark:text-neutralfog-100"
    x-data="layoutState()"
>

    {{-- ========================= --}}
    {{-- TOP RIGHT THEME SWITCHER --}}
    {{-- ========================= --}}
    <div class="absolute top-4 right-4 z-50">
        <button
            type="button"
            x-on:click="cycleTheme()"
            x-tooltip.bottom="'Switch theme'"
            class="inline-flex items-center gap-2 rounded-full bg-neutralfog-100/90 border border-neutralfog-300/80 px-2.5 py-1.5 text-[11px] text-neutral-700 hover:text-electric-700 hover:border-electric-500/60 dark:bg-shadow-900/80 dark:border-silver-500/60 dark:text-neutralfog-300 dark:hover:text-electric-300 transition"
            :aria-label="`Theme: ${theme}`"
        >
            <span class="inline-flex">
                {{-- Light icon --}}
                <svg
                    x-show="theme === 'light'"
                    x-transition.opacity.duration.150ms
                    class="w-3.5 h-3.5"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.6"
                >
                    <circle cx="12" cy="12" r="3.5" />
                    <path d="M12 2.5v2.5M12 19v2.5M4.22 4.22l1.77 1.77M18.01 17.99l1.77 1.77M2.5 12h2.5M19 12h2.5M4.22 19.78l1.77-1.77M18.01 6.01l1.77-1.77" />
                </svg>

                {{-- Dark icon --}}
                <svg
                    x-show="theme === 'dark'"
                    x-transition.opacity.duration.150ms
                    class="w-3.5 h-3.5"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.6"
                >
                    <path d="M20.5 14.5A7.5 7.5 0 0 1 11 5a7.5 7.5 0 1 0 9.5 9.5Z" />
                </svg>

                {{-- System icon --}}
                <svg
                    x-show="theme === 'system'"
                    x-transition.opacity.duration.150ms
                    class="w-3.5 h-3.5"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.6"
                >
                    <rect x="3" y="4" width="18" height="13" rx="2" />
                    <path d="M8 20h8" />
                </svg>
            </span>

            <span class="capitalize" x-text="theme"></span>
        </button>
    </div>

    {{-- PAGE WRAPPER --}}
    <div class="flex flex-col items-center justify-center min-h-screen py-10 px-6">

         <main class="flex-1 px-4 md:px-6 py-6">
                {{ $slot }}
        </main>
    </div>

</body>
</html>
