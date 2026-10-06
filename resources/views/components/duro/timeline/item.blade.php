@props([
    'title',
    'time' => null,
    'icon' => 'sparkles',
    'active' => false,
])

<li class="relative">
    <span @class([
        'absolute -left-[2.85rem] grid size-7 place-items-center rounded-full border bg-surface',
        'border-primary text-primary-ink shadow-glow' => $active,
        'border-line text-ink-subtle' => ! $active,
    ])>
        <x-duro.icon :name="$icon" class="size-3.5" />
    </span>
    <div class="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-1">
        <h4 class="font-semibold text-ink">{{ $title }}</h4>
        @if ($time)
            <time class="font-mono text-xs text-ink-subtle">{{ $time }}</time>
        @endif
    </div>
    <div class="mt-1.5 text-sm leading-relaxed text-ink-muted">{{ $slot }}</div>
</li>
