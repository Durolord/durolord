@props([
    'label' => null,
    'hint' => null,
    'rows' => 4,
])

<div class="space-y-1.5">
    @if($label)
        <label class="block text-xs font-medium tracking-[0.14em] uppercase text-neutral-700 dark:text-neutralfog-300">
            {{ $label }}
        </label>
    @endif

    <textarea
        rows="{{ $rows }}"
        {{ $attributes->merge([
            'class' =>
                'block w-full rounded-xl border px-3 py-2 text-sm
                 bg-neutralfog-100 border-neutralfog-300 text-shadow-900
                 placeholder:text-neutral-400
                 focus:outline-none focus:ring-2 focus:ring-electric-400 focus:border-electric-400
                 dark:bg-shadow-950/70 dark:border-shadow-800 dark:text-neutralfog-100 dark:placeholder:text-neutralfog-300/70',
        ]) }}
    ></textarea>

    @error($attributes->whereStartsWith('wire:model')->first())
        <p class="text-xs text-red-500 dark:text-red-400">{{ $message }}</p>
    @enderror

    @if($hint)
        <p class="text-[11px] text-neutral-500 dark:text-neutralfog-400">{{ $hint }}</p>
    @endif
</div>
