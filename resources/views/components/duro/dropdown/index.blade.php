@props([
    'align' => 'right',
    'width' => 'w-56',
])

<div x-data="{ open: false }" x-on:click.outside="open = false" x-on:keydown.escape.window="open = false" {{ $attributes->class(['relative inline-block']) }}>
    <div x-on:click="open = ! open">{{ $trigger }}</div>

    <div
        x-cloak
        x-show="open"
        x-on:click="open = false"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-end="opacity-0 scale-95"
        @class([
            'duro-panel absolute z-50 mt-2 p-1.5',
            $width,
            'right-0 origin-top-right' => $align === 'right',
            'left-0 origin-top-left' => $align === 'left',
        ])
        role="menu"
    >
        {{ $slot }}
    </div>
</div>
