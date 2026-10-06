@props([
    'label' => null,
    'min' => 0,
    'max' => 100,
    'step' => 1,
    'value' => null,
    'suffix' => '',
])

<div
    x-data="{ value: @js((float) ($value ?? $min)), min: @js((float) $min), max: @js((float) $max) }"
    x-modelable="value"
    {{ $attributes->whereStartsWith('wire:model') }}
    class="space-y-2.5"
>
    @if ($label)
        <div class="flex items-center justify-between">
            <span class="duro-label">{{ $label }}</span>
            <span class="rounded-ui border border-line bg-surface-2 px-2 py-0.5 font-mono text-xs text-ink"><span x-text="value"></span>{{ $suffix }}</span>
        </div>
    @endif

    <div class="relative flex h-5 items-center">
        <div class="duro-progress !h-1.5">
            <div class="duro-progress-bar" :style="`width: ${((value - min) / (max - min)) * 100}%`"></div>
        </div>
        <input
            type="range"
            min="{{ $min }}"
            max="{{ $max }}"
            step="{{ $step }}"
            x-model.number="value"
            {{ $attributes->whereDoesntStartWith('wire:model')->class(['absolute inset-0 w-full cursor-pointer appearance-none bg-transparent [&::-webkit-slider-thumb]:size-4 [&::-webkit-slider-thumb]:appearance-none [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:border-2 [&::-webkit-slider-thumb]:border-primary [&::-webkit-slider-thumb]:bg-surface [&::-webkit-slider-thumb]:shadow-glow [&::-moz-range-thumb]:size-4 [&::-moz-range-thumb]:rounded-full [&::-moz-range-thumb]:border-2 [&::-moz-range-thumb]:border-primary [&::-moz-range-thumb]:bg-surface']) }}
        >
    </div>

    <div class="flex justify-between font-mono text-[0.65rem] text-ink-subtle">
        <span>{{ $min }}{{ $suffix }}</span>
        <span>{{ $max }}{{ $suffix }}</span>
    </div>
</div>
