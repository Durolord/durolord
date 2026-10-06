@props([
    'label',
    'value',
    'change' => null,
    'trend' => 'up',
    'icon' => null,
    'description' => null,
    'prefix' => '',
    'suffix' => '',
    'animate' => true,
])

@php
    $isNumeric = is_numeric($value);
@endphp

<div {{ $attributes->class(['duro-card p-5']) }}>
    <div class="flex items-start justify-between gap-3">
        <p class="duro-label">{{ $label }}</p>
        @if ($icon)
            <span class="duro-icon-tile size-9"><x-duro.icon :name="$icon" /></span>
        @endif
    </div>

    <p class="mt-3 flex items-baseline gap-1 font-display text-3xl font-bold tracking-tight text-ink sm:text-4xl">
        @if ($isNumeric && $animate)
            <span x-data="countUp({{ (int) $value }})" x-intersect.once="start()">{{ $prefix }}<span x-text="value.toLocaleString()">{{ number_format((float) $value) }}</span>{{ $suffix }}</span>
        @else
            <span>{{ $prefix }}{{ $value }}{{ $suffix }}</span>
        @endif
    </p>

    @if ($change || $description)
        <div class="mt-3 flex items-center gap-2 text-xs">
            @if ($change)
                <span @class([
                    'inline-flex items-center gap-1 font-semibold',
                    'text-success' => $trend === 'up',
                    'text-danger' => $trend === 'down',
                    'text-ink-muted' => ! in_array($trend, ['up', 'down']),
                ])>
                    <x-duro.icon :name="$trend === 'down' ? 'trending-up' : 'trending-up'" @class(['size-3.5', 'rotate-180 -scale-x-100' => $trend === 'down']) />
                    {{ $change }}
                </span>
            @endif
            @if ($description)
                <span class="text-ink-subtle">{{ $description }}</span>
            @endif
        </div>
    @endif
</div>
