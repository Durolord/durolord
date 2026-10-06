@props([
    'title' => null,
    'subtitle' => null,
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head', ['title' => $title ? $title.' · '.config('portfolio.name') : null])
</head>
<body class="min-h-screen font-sans antialiased" x-data="layoutState()">
    <div class="duro-backdrop" aria-hidden="true"></div>

    <div class="grid min-h-screen lg:grid-cols-[1.05fr_1fr]">
        {{-- BRAND PANEL --}}
        <aside class="relative isolate hidden overflow-hidden border-r border-line lg:flex lg:flex-col lg:justify-between lg:p-12">
            <div class="duro-grid-lines absolute inset-0 opacity-40 [mask-image:radial-gradient(ellipse_at_center,black,transparent_70%)]"></div>
            <div class="duro-glow-orb left-1/2 top-1/2 size-96 -translate-x-1/2 -translate-y-1/2"></div>

            <a href="{{ route('home') }}" class="relative z-10 w-max">
                <x-duro.logo size="sm" />
            </a>

            <div class="relative z-10 flex flex-col items-center gap-10 text-center">
                <div class="duro-hero-art aspect-square w-full max-w-sm animate-float" role="img" aria-label="{{ config('portfolio.name') }} emblem"></div>
                <div class="max-w-md space-y-3">
                    <p class="duro-display text-4xl">{{ $title ?? config('portfolio.name') }}</p>
                    @if ($subtitle)
                        <p class="text-sm leading-relaxed text-ink-muted">{{ $subtitle }}</p>
                    @endif
                </div>
            </div>

            <p class="relative z-10 text-xs text-ink-subtle">© {{ date('Y') }} {{ config('portfolio.name') }} · {{ config('portfolio.role') }}</p>
        </aside>

        {{-- CONTENT --}}
        <div class="flex flex-col">
            <div class="flex items-center justify-between p-4 sm:p-6">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-sm text-ink-muted transition hover:text-ink">
                    <x-duro.icon name="arrow-left" /> Back to portfolio
                </a>
                <x-duro.theme-switcher />
            </div>

            <main class="flex flex-1 items-center justify-center px-4 pb-12 sm:px-6">
                <div class="w-full max-w-md">
                    <a href="{{ route('home') }}" class="mb-8 flex justify-center lg:hidden">
                        <x-duro.logo size="md" />
                    </a>
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    <x-duro.toasts />

    @livewireScripts
</body>
</html>
