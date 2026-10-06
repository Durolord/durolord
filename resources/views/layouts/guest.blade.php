{{-- resources/views/layouts/guest.blade.php --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name') }}</title>
    @include('partials.theme-bootstrap')
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
        <x-duro.theme-switcher />
    </div>

    {{-- PAGE WRAPPER --}}
    <div class="flex flex-col items-center justify-center min-h-screen py-10 px-6">

         <main class="flex-1 px-4 md:px-6 py-6">
                {{ $slot }}
        </main>
    </div>

</body>
</html>
