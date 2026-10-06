@props([
    'align' => 'right',
    'compact' => false,
])

{{-- Realm switcher + light/dark toggle, shown side by side. --}}
<div {{ $attributes->class(['flex items-center gap-2']) }}>
    <x-duro.realm-switcher :align="$align" :compact="$compact" />
    <x-duro.mode-toggle :labels="! $compact" />
</div>
