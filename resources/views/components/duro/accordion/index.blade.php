@props(['multiple' => false])

<div x-data="{ active: null, multiple: @js((bool) $multiple) }" {{ $attributes->class(['divide-y divide-line overflow-hidden duro-card duro-card-flat']) }}>
    {{ $slot }}
</div>
