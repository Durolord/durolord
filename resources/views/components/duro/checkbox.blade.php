@props([
    'label' => null,
    'hint' => null,
])

<label class="inline-flex items-start gap-2 text-sm cursor-pointer">
    <span class="mt-0.5 inline-flex">
        <input
            type="checkbox"
            {{ $attributes->merge([
                'class' =>
                    'h-4 w-4 rounded-md border border-neutralfog-300 bg-neutralfog-100
                     text-electric-600 accent-electric-600
                     focus:ring-2 focus:ring-electric-400 focus:ring-offset-1 focus:ring-offset-neutralfog-100
                     dark:bg-shadow-950 dark:border-shadow-700 dark:accent-electric-400 dark:focus:ring-offset-shadow-950',
            ]) }}
        >
    </span>

    <span class="space-y-0.5">
        @if($label)
            <span class="text-neutral-800 dark:text-neutralfog-100">{{ $label }}</span>
        @endif
        @if($hint)
            <span class="block text-[11px] text-neutral-500 dark:text-neutralfog-400">{{ $hint }}</span>
        @endif
    </span>
</label>
