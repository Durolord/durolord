@props(['on' => false])

<x-duro.table.cell {{ $attributes->only('class')->class('w-20') }}>
    <x-duro.switch :checked="$on" {{ $attributes->except('class') }} />
</x-duro.table.cell>
