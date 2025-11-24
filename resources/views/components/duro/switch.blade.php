@props([
    'label' => null,
    'hint' => null,
    'checked' => false,
])

<div
    x-data="{ on: @js((bool) $checked) }"
    x-init="$watch('on', v => $dispatch('input', v))"
    class="flex items-center justify-between gap-4"
>
    @if($label)
        <div class="space-y-0.5">
            <p class="text-sm font-medium text-neutral-800 dark:text-neutralfog-100">
                {{ $label }}
            </p>
            @if($hint)
                <p class="text-[11px] text-neutral-500 dark:text-neutralfog-400">
                    {{ $hint }}
                </p>
            @endif
        </div>
    @endif

    <button
        type="button"
        role="switch"
        :aria-checked="on"
        x-on:click="on = !on"
        class="relative inline-flex h-6 w-11 items-center rounded-full border transition
               border-neutralfog-300 bg-neutralfog-100
               dark:border-shadow-700 dark:bg-shadow-900"
    >
        <span
            class="inline-flex h-4 w-4 transform rounded-full shadow-sm transition
                   bg-neutralfog-100 dark:bg-shadow-950"
            :class="on
                ? 'translate-x-5 !bg-electric-500 dark:!bg-electric-400'
                : 'translate-x-1'"
        ></span>
    </button>
</div>
