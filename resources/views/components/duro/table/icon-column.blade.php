@props([
    'icon' => null,
    'color' => 'text-electric-600 dark:text-electric-300',
    'label' => null,
])

<x-duro.table.cell {{ $attributes->class('w-12') }}>
    <div class="flex items-center gap-2">
        @if($icon)
            <x-dynamic-component :component="'duro.icons.' . $icon"  class="h-4 w-4 {{ $color }}" />
        @endif
        @if($label)
            <span class="text-xs text-neutral-700 dark:text-neutralfog-200">{{ $label }}</span>
        @else
            {{ $slot }}
        @endif
    </div>
</x-duro.table.cell>