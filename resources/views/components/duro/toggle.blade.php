@props([
    'label' => null,
    'hint' => null,
    'checked' => false,
])

<x-duro.switch :label="$label" :hint="$hint" :checked="$checked || $attributes->get('checked')" {{ $attributes->except('checked') }} />
