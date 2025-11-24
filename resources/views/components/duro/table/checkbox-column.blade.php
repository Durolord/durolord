<x-duro.table.cell {{ $attributes->class('w-10 text-center') }}>
    <x-duro.checkbox
        {{ $attributes->whereStartsWith('wire:model') }}
        :label="false"
    />
</x-duro.table.cell>