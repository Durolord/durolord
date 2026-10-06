@props([
    'hover' => false,
    'padding' => 'md',
    'variant' => 'default',
    'heading' => null,
    'description' => null,
    'icon' => null,
])

@php
    $hover = filter_var($hover, FILTER_VALIDATE_BOOLEAN);

    $paddingClass = [
        'none' => '',
        'sm' => 'p-4',
        'md' => 'p-5 md:p-6',
        'lg' => 'p-6 md:p-8',
    ][$padding] ?? 'p-5 md:p-6';
@endphp

<div {{ $attributes->class([
    'duro-card',
    $paddingClass,
    'duro-card-interactive' => $hover,
    'duro-card-flat' => $variant === 'flat',
    'duro-card-glass' => $variant === 'glass',
    'duro-card-ornate' => $variant === 'ornate',
]) }}>
    @if ($heading || $description || isset($actions))
        <div class="mb-5 flex items-start justify-between gap-4">
            <div class="flex items-start gap-3">
                @if ($icon)
                    <span class="duro-icon-tile size-10">
                        <x-duro.icon :name="$icon" size="md" />
                    </span>
                @endif
                <div class="space-y-1">
                    @if ($heading)
                        <h3 class="duro-heading text-lg leading-tight">{{ $heading }}</h3>
                    @endif
                    @if ($description)
                        <p class="text-sm text-ink-muted">{{ $description }}</p>
                    @endif
                </div>
            </div>

            @isset($actions)
                <div class="flex shrink-0 items-center gap-2">{{ $actions }}</div>
            @endisset
        </div>
    @endif

    {{ $slot }}

    @isset($footer)
        <div class="mt-6 flex items-center justify-end gap-3 border-t border-line pt-4">
            {{ $footer }}
        </div>
    @endisset
</div>
