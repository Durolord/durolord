@props(['value' => null])

<x-duro.table.cell {{ $attributes->only('class') }}>
    <input type="text" value="{{ $value }}" class="duro-control min-w-36 !py-1.5 !text-xs" {{ $attributes->except('class') }}>
</x-duro.table.cell>
