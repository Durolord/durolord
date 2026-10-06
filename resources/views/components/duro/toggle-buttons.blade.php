@props([
    'label' => null,
    'options' => [],
    'value' => null,
    'icons' => [],
])

<div
    x-data="{ selected: @js($value === null ? null : (string) $value) }"
    x-modelable="selected"
    {{ $attributes->whereStartsWith('wire:model') }}
    {{ $attributes->whereDoesntStartWith('wire:model')->class(['space-y-1.5']) }}
>
    @if ($label)
        <p class="duro-label">{{ $label }}</p>
    @endif

    <div class="duro-tabs" role="radiogroup">
        @foreach ($options as $optionValue => $text)
            <button
                type="button"
                role="radio"
                class="duro-tab inline-flex items-center gap-1.5"
                x-on:click="selected = @js((string) $optionValue)"
                :aria-selected="(String(selected) === @js((string) $optionValue)).toString()"
                :aria-checked="(String(selected) === @js((string) $optionValue)).toString()"
            >
                @isset($icons[$optionValue])
                    <x-duro.icon :name="$icons[$optionValue]" class="size-3.5" />
                @endisset
                {{ $text }}
            </button>
        @endforeach
    </div>
</div>
