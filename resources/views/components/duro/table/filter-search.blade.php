@props(['placeholder' => 'Search…'])

<x-duro.input
    {{ $attributes }}
    :label="false"
    :hint="null"
    name="filter"
    :placeholder="$placeholder"
/>