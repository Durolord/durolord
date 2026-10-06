@props([
    'label' => null,
    'options' => [],
    'placeholder' => 'All',
])

<div class="min-w-44">
    <x-duro.select :label="$label" :options="$options" :placeholder="$placeholder" :searchable="false" {{ $attributes }} />
</div>
