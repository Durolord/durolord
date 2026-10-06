@props([
    'value',
    'colors' => [],
    'dot' => true,
])

<x-duro.table.cell {{ $attributes }}>
    <x-duro.badge :variant="$colors[$value] ?? 'neutral'" :dot="$dot">{{ \Illuminate\Support\Str::headline($value) }}</x-duro.badge>
</x-duro.table.cell>
