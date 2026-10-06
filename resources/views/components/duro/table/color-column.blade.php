@props([
    'color' => null,
    'value' => null,
    'label' => null,
])

@php($swatch = $color ?? $value ?? 'transparent')

<x-duro.table.cell {{ $attributes }}>
    <span class="inline-flex items-center gap-2 rounded-pill border border-line bg-surface-2 py-1 pl-1 pr-2.5">
        <span class="size-4 rounded-full ring-1 ring-ink/20" style="background: {{ $swatch }}"></span>
        <span class="text-xs text-ink-muted">{{ $label ?? (trim($slot) !== '' ? $slot : $swatch) }}</span>
    </span>
</x-duro.table.cell>
