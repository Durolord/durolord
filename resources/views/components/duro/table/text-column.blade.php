@props(['value' => null, 'muted' => false])

<x-duro.table.cell {{ $attributes }}>
    <span @class([
        'truncate block',
        'text-neutral-600 dark:text-neutralfog-300' => $muted,
    ])>
        {{ $value ?? $slot }}
    </span>
</x-duro.table.cell>