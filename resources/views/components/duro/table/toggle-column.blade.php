<x-duro.table.cell {{ $attributes->class('w-20 text-center') }}>
    <x-duro.toggle
        {{ $attributes->whereStartsWith('wire:model') }}
    />
</x-duro.table.cell>