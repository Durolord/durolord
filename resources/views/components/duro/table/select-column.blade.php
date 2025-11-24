@props([
    'options' => [],
])

<x-duro.table.cell>
    <x-duro.select
        {{ $attributes }}
        :options="$options"
    />
</x-duro.table.cell>