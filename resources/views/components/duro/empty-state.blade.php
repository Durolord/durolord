@props([
    'icon' => 'layers',
    'title' => 'Nothing here yet',
    'description' => null,
])

<div {{ $attributes->class(['flex flex-col items-center justify-center gap-3 px-6 py-12 text-center']) }}>
    <span class="duro-icon-tile size-14">
        <x-duro.icon :name="$icon" size="lg" />
    </span>
    <h3 class="duro-heading text-lg">{{ $title }}</h3>
    @if ($description)
        <p class="max-w-sm text-sm text-ink-muted">{{ $description }}</p>
    @endif
    @isset($action)
        <div class="mt-2">{{ $action }}</div>
    @endisset
</div>
