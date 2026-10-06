<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>{{ $title ?? 'Durolord' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.theme-bootstrap')
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

        <x-duro.theme-switcher />
    </div>

    <main class="min-h-screen bg-gradient-to-b from-neutral-50 to-neutral-100 dark:from-shadow-950 dark:to-black">
        <div class="container mx-auto px-4 py-10">
            {{ $slot }}
        </div>
    </main>

    @livewireScripts
</body>
</html>
