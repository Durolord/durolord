@props([
    'variant' => 'info',
    'title' => null,
    'icon' => null,
    'dismissible' => false,
])

@php
    $icon ??= [
        'info' => 'info',
        'success' => 'check-circle',
        'warning' => 'alert-triangle',
        'danger' => 'x-circle',
    ][$variant] ?? 'info';
@endphp

<div
    role="alert"
    @if ($dismissible) x-data="{ shown: true }" x-show="shown" x-transition.opacity @endif
    {{ $attributes->class(['duro-alert', 'duro-alert-'.$variant]) }}
>
    <x-duro.icon :name="$icon" size="md" class="duro-alert-icon" />

    <div class="min-w-0 flex-1 space-y-1">
        @if ($title)
            <p class="font-semibold leading-snug">{{ $title }}</p>
        @endif
        <div class="text-[0.82rem] leading-relaxed text-ink-muted">{{ $slot }}</div>
    </div>

    @if ($dismissible)
        <button type="button" x-on:click="shown = false" class="-m-1 rounded p-1 text-ink-subtle transition hover:text-ink" aria-label="Dismiss">
            <x-duro.icon name="x" />
        </button>
    @endif
</div>
