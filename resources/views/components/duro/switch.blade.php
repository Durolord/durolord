@props([
    'label' => null,
    'hint' => null,
    'checked' => false,
])

<div
    x-data="{ on: @js((bool) $checked) }"
    x-modelable="on"
    {{ $attributes->whereStartsWith('wire:model') }}
    {{ $attributes->whereDoesntStartWith('wire:model')->class(['flex items-center justify-between gap-4']) }}
>
    @if ($label)
        <div class="space-y-0.5">
            <p class="text-sm font-medium text-ink">{{ $label }}</p>
            @if ($hint)
                <p class="duro-hint">{{ $hint }}</p>
            @endif
        </div>
    @endif

    <button type="button" role="switch" :aria-checked="on.toString()" x-on:click="on = ! on" class="duro-switch" @if ($label) aria-label="{{ $label }}" @endif>
        <span class="duro-switch-thumb"></span>
    </button>
</div>
