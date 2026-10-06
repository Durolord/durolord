@props([
    'label' => null,
    'hint' => null,
    'value' => '#3fa0ff',
    'swatches' => ['#3fa0ff', '#5ee7ff', '#7c4dff', '#d7193f', '#e11d38', '#9a5a2c', '#22c55e', '#f59e0b', '#141414'],
])

<div
    x-data="{ color: @js($value) }"
    x-modelable="color"
    {{ $attributes->whereStartsWith('wire:model') }}
    class="space-y-2"
>
    @if ($label)
        <p class="duro-label">{{ $label }}</p>
    @endif

    <div class="duro-field pr-1.5">
        <label class="ml-1.5 size-7 shrink-0 cursor-pointer overflow-hidden rounded-ui ring-1 ring-line" :style="`background:${color}`">
            <input type="color" x-model="color" class="size-full cursor-pointer opacity-0" aria-label="{{ $label ?? 'Pick a colour' }}">
        </label>
        <input type="text" x-model.lazy="color" class="duro-field-input font-mono uppercase" maxlength="9">
    </div>

    <div class="flex flex-wrap gap-1.5">
        @foreach ($swatches as $swatch)
            <button
                type="button"
                x-on:click="color = @js($swatch)"
                class="size-6 rounded-full ring-offset-2 ring-offset-surface transition hover:scale-110"
                :class="color.toLowerCase() === @js(strtolower($swatch)) ? 'ring-2 ring-primary' : 'ring-1 ring-line'"
                style="background: {{ $swatch }}"
                aria-label="Use {{ $swatch }}"
            ></button>
        @endforeach
    </div>

    @if ($hint)
        <p class="duro-hint">{{ $hint }}</p>
    @endif
</div>
