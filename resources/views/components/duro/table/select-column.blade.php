@props([
    'options' => [],
    'value' => null,
])

<x-duro.table.cell {{ $attributes->only('class') }}>
    <div class="min-w-36">
        <x-duro.select :options="$options" :value="$value" :searchable="false" placeholder="Choose…" {{ $attributes->except('class') }} />
    </div>
</x-duro.table.cell>
