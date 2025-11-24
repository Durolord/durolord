@props([
    'label' => null,
    'value' => null,
])

<x-duro.table.cell>
    <div class="inline-flex items-center gap-2 rounded-full border border-neutralfog-300/80 px-2.5 py-1
                bg-neutralfog-100/70 dark:bg-shadow-900/70 dark:border-shadow-800">
        <span
            class="h-3 w-3 rounded-full border border-shadow-900/40"
            style="background: {{ $value ?? '#ffffff' }}"
        ></span>
        <span class="text-[11px] text-neutral-700 dark:text-neutralfog-200">
            {{ $label ?? $value ?? $slot }}
        </span>
    </div>
</x-duro.table.cell>