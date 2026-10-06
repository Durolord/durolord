@props([
    'value' => null,
    'description' => null,
    'muted' => false,
])

<x-duro.table.cell {{ $attributes }}>
    <div class="min-w-0">
        <p @class(['truncate font-medium', 'text-ink-muted' => $muted, 'text-ink' => ! $muted])>{{ $value ?? $slot }}</p>
        @if ($description)
            <p class="truncate text-xs text-ink-subtle">{{ $description }}</p>
        @endif
    </div>
</x-duro.table.cell>
