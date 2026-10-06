@props([
    'href' => null,
    'icon' => null,
    'danger' => false,
    'shortcut' => null,
])

@php
    $classes = ['duro-menu-item', '!text-danger hover:!bg-danger/10' => $danger];
@endphp

@if ($href)
    <a href="{{ $href }}" role="menuitem" {{ $attributes->class($classes) }}>
        @if ($icon) <x-duro.icon :name="$icon" /> @endif
        <span class="flex-1">{{ $slot }}</span>
        @if ($shortcut) <span class="duro-kbd">{{ $shortcut }}</span> @endif
    </a>
@else
    <button role="menuitem" {{ $attributes->merge(['type' => 'button'])->class($classes) }}>
        @if ($icon) <x-duro.icon :name="$icon" /> @endif
        <span class="flex-1">{{ $slot }}</span>
        @if ($shortcut) <span class="duro-kbd">{{ $shortcut }}</span> @endif
    </button>
@endif
