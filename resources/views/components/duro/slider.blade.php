@props([
    'label' => null,
    'min' => 0,
    'max' => 100,
    'step' => 1,
])

<div
    x-data="{ value: {{ $attributes->get('value') ?? $min }} }"
    class="space-y-1.5"
>
    @if($label)
        <div class="flex items-center justify-between">
            <label class="text-xs font-medium tracking-[0.14em] uppercase text-neutral-700 dark:text-neutralfog-300">
                {{ $label }}
            </label>
            <span class="text-[11px] text-neutral-500 dark:text-neutralfog-400"
                  x-text="value">
            </span>
        </div>
    @endif

    <input
        type="range"
        min="{{ $min }}"
        max="{{ $max }}"
        step="{{ $step }}"
        x-model="value"
        @input="value = $event.target.value; $el.style.setProperty('--val', value)"
        style="--min: {{ $min }}; --max: {{ $max }}; --val: {{ $attributes->get('value') ?? $min }};"
        {{ $attributes->merge([
            'class' => '
                w-full appearance-none cursor-pointer bg-transparent

                /* Track */
                [&::-webkit-slider-runnable-track]:
                    h-2 rounded-full bg-neutralfog-300 dark:bg-shadow-700

                /* Dynamic fill (before thumb) */
                bg-gradient-to-r
                from-electric-500 to-electric-600
                bg-[length:calc((var(--val)-var(--min))/(var(--max)-var(--min))*100%)_100%]
                bg-left bg-no-repeat rounded-full

                /* Thumb */
                [&::-webkit-slider-thumb]:
                    appearance-none h-4 w-4 rounded-full bg-electric-500 border-2 border-white
                    dark:border-shadow-900 transition-shadow duration-150
                [&::-webkit-slider-thumb:hover]:
                    shadow-lg
                [&::-webkit-slider-thumb:active]:
                    ring-4 ring-electric-500/40
            ',
        ]) }}
    >
</div>
