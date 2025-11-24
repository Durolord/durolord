@props([
    'label',
    'colspan' => 1,
])

<tr>
    <td colspan="{{ $colspan }}" class="bg-neutralfog-200/80 dark:bg-shadow-900/80 px-4 py-2">
        <div class="flex items-center gap-2 text-[11px] font-semibold tracking-[0.16em] uppercase text-neutral-600 dark:text-neutralfog-300">
            <span class="h-px flex-1 bg-neutralfog-300 dark:bg-shadow-700"></span>
            <span>{{ $label }}</span>
            <span class="h-px flex-1 bg-neutralfog-300 dark:bg-shadow-700"></span>
        </div>
    </td>
</tr>