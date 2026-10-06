@props([
    'icon' => 'sparkles',
    'label' => null,
    'description' => null,
    'color' => 'text-primary-ink',
])

<x-duro.table.cell {{ $attributes }}>
    <div class="flex items-center gap-2.5">
        <span class="duro-icon-tile size-8 {{ $color }}"><x-duro.icon :name="$icon" /></span>
        <div class="min-w-0">
            <p class="truncate text-ink">{{ $label ?? $slot }}</p>
            @if ($description)
                <p class="truncate text-xs text-ink-subtle">{{ $description }}</p>
            @endif
        </div>
    </div>
</x-duro.table.cell>
