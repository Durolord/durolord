@props([
    'variant' => 'primary',
    'dot' => false,
    'solid' => false,
    'icon' => null,
])

@php
    $variant = match ($variant) {
        'electric' => 'primary',
        'gold' => 'accent',
        'silver', 'shadow' => 'neutral',
        default => $variant,
    };
@endphp

<span {{ $attributes->class([
    'duro-badge',
    'duro-badge-'.$variant,
    'duro-badge-dot' => $dot,
    'duro-badge-solid' => $solid,
]) }}>
    @if ($icon)
        <x-duro.icon :name="$icon" class="size-3" />
    @endif
    {{ $slot }}
</span>
