@props([
    'variant' => 'primary',
    'size' => 'md',
    'type' => 'button',
    'href' => null,
    'icon' => null,
    'iconRight' => null,
    'square' => false,
    'loading' => null,
])

@php
    $variant = match ($variant) {
        'electric' => 'primary',
        'gold' => 'accent',
        default => $variant,
    };

    $iconSize = in_array($size, ['sm']) ? 'size-3.5' : 'size-4';

    $classes = [
        'duro-btn',
        'duro-btn-'.$variant,
        'duro-btn-'.$size,
        'duro-btn-icon' => $square,
    ];

    $loadingTarget = $loading === true ? null : $loading;
    $wireTarget = $loadingTarget ? 'wire:target="'.e($loadingTarget).'"' : '';
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->class($classes) }}>
        @if ($icon)
            <x-duro.icon :name="$icon" :class="$iconSize" />
        @endif
        {{ $slot }}
        @if ($iconRight)
            <x-duro.icon :name="$iconRight" :class="$iconSize" />
        @endif
    </a>
@else
    <button
        type="{{ $type }}"
        @if ($loading) wire:loading.attr="disabled" {!! $wireTarget !!} @endif
        {{ $attributes->class($classes) }}
    >
        @if ($loading)
            <svg wire:loading {!! $wireTarget !!} class="{{ $iconSize }} animate-spin" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-opacity="0.25" stroke-width="3" />
                <path d="M21 12a9 9 0 0 0-9-9" stroke="currentColor" stroke-width="3" stroke-linecap="round" />
            </svg>
        @endif

        @if ($icon)
            <span class="inline-flex" @if ($loading) wire:loading.remove {!! $wireTarget !!} @endif>
                <x-duro.icon :name="$icon" :class="$iconSize" />
            </span>
        @endif

        {{ $slot }}

        @if ($iconRight)
            <x-duro.icon :name="$iconRight" :class="$iconSize" />
        @endif
    </button>
@endif
