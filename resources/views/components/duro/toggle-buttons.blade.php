@props([
    'label'   => null,
    'options' => [], // ['value' => 'Label']
    'value'   => null,
    'name'    => null,
])

<div
    x-data="{
        selected: @js($value ?? null),
        set(val) {
            this.selected = val;
            $dispatch('input', val); // allows wire:model / x-model on parent
        },
        isActive(val) {
            return String(this.selected) === String(val);
        },
    }"
    class="space-y-1.5"
>
    @if($label)
        <p class="text-xs font-medium tracking-[0.14em] uppercase text-neutral-700 dark:text-neutralfog-300">
            {{ $label }}
        </p>
    @endif

    <div class="inline-flex flex-wrap gap-1.5">
        @foreach($options as $optionValue => $text)
            <button
                type="button"
                class="px-3 py-1.5 rounded-full border text-xs transition
                       border-neutralfog-300 text-neutral-700 bg-neutralfog-100
                       hover:border-electric-400 hover:text-electric-700
                       dark:border-shadow-700 dark:bg-shadow-950 dark:text-neutralfog-200
                       dark:hover:border-electric-400 dark:hover:text-electric-300"
                :class="isActive(@js($optionValue))
                    ? 'border-electric-500 bg-electric-500/10 text-electric-700 dark:bg-electric-500/20 dark:text-electric-300'
                    : ''"
                x-on:click="set(@js($optionValue))"
            >
                {{ $text }}
            </button>
        @endforeach
    </div>

    {{-- Hidden field so plain forms still work --}}
    <input
        type="hidden"
        name="{{ $name }}"
        x-model="selected"
    >
</div>
