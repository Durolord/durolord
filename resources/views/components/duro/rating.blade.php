@props([
    'value' => 0,
    'max' => 5,
    'readonly' => false,
])

<div
    x-data="{ value: @js((int) $value), hover: 0 }"
    x-modelable="value"
    {{ $attributes->whereStartsWith('wire:model') }}
    {{ $attributes->whereDoesntStartWith('wire:model')->class(['inline-flex items-center gap-1']) }}
    role="radiogroup"
>
    @for ($i = 1; $i <= $max; $i++)
        <button
            type="button"
            @unless ($readonly) x-on:click="value = {{ $i }}" x-on:mouseenter="hover = {{ $i }}" x-on:mouseleave="hover = 0" @endunless
            class="transition hover:scale-110 disabled:cursor-default"
            :class="(hover || value) >= {{ $i }} ? 'text-warning' : 'text-line-strong'"
            @disabled($readonly)
            aria-label="{{ $i }} star{{ $i > 1 ? 's' : '' }}"
        >
            <x-duro.icon name="star" size="md" x-bind:fill="(hover || value) >= {{ $i }} ? 'currentColor' : 'none'" />
        </button>
    @endfor
</div>
