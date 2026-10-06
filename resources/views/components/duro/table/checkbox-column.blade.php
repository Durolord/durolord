<x-duro.table.cell {{ $attributes->only('class')->class('w-10') }}>
    <input type="checkbox" class="duro-check" aria-label="Select row" {{ $attributes->except('class') }}>
</x-duro.table.cell>
