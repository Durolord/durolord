@props([
    'label' => null,
    'hint' => null,
])

<div class="space-y-1.5">
    @if($label)
        <label class="block text-xs font-medium tracking-[0.14em] uppercase text-neutral-700 dark:text-neutralfog-300">
            {{ $label }}
        </label>
    @endif

    <div class="flex items-center gap-3">
        <input
            type="color"
            {{ $attributes->merge([
                'class' => 'h-9 w-9 rounded-lg border border-neutralfog-300 bg-neutralfog-100 dark:border-shadow-700 dark:bg-shadow-950 p-0 cursor-pointer',
            ]) }}
        >
    </div>

    @if($hint)
        <p class="text-[11px] text-neutral-500 dark:text-neutralfog-400">{{ $hint }}</p>
    @endif
</div>
