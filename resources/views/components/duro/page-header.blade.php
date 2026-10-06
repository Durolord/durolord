@props([
    'title',
    'description' => null,
    'breadcrumbs' => [],
    'eyebrow' => null,
])

<header {{ $attributes->class(['flex flex-col gap-4 md:flex-row md:items-end md:justify-between']) }}>
    <div class="space-y-2">
        @if ($breadcrumbs)
            <x-duro.breadcrumbs :items="$breadcrumbs" />
        @elseif ($eyebrow)
            <p class="duro-eyebrow">{{ $eyebrow }}</p>
        @endif
        <h1 class="duro-heading text-2xl sm:text-3xl">{{ $title }}</h1>
        @if ($description)
            <p class="max-w-2xl text-sm text-ink-muted">{{ $description }}</p>
        @endif
    </div>
    @isset($actions)
        <div class="flex flex-wrap items-center gap-2">{{ $actions }}</div>
    @endisset
</header>
