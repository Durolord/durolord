@props([
    'code',
    'title',
    'message',
    'icon' => 'alert-triangle',
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head', ['title' => $code.' · '.$title])
</head>
<body class="min-h-screen font-sans antialiased" x-data="layoutState()">
    <div class="duro-backdrop" aria-hidden="true"></div>

    <main class="relative isolate flex min-h-screen flex-col items-center justify-center overflow-hidden px-6 py-16 text-center">
        <div class="duro-glow-orb left-1/2 top-1/3 size-96 -translate-x-1/2"></div>

        <div class="duro-logo-mark size-20 animate-float" role="img" aria-label="{{ config('portfolio.name') }}"></div>

        <p class="duro-display mt-8 text-8xl sm:text-9xl">{{ $code }}</p>
        <h1 class="duro-heading mt-4 text-2xl sm:text-3xl">{{ $title }}</h1>
        <p class="mt-3 max-w-md text-sm leading-relaxed text-ink-muted">{{ $message }}</p>

        <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
            <x-duro.button :href="url('/')" icon="home">Return home</x-duro.button>
            <x-duro.button href="javascript:history.back()" variant="secondary" icon="arrow-left">Go back</x-duro.button>
        </div>

        {{ $slot }}

        <div class="mt-12">
            <x-duro.theme-switcher align="top" />
        </div>
    </main>

    @livewireScripts
</body>
</html>
