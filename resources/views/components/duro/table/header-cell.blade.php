@props(['align' => 'left'])

<th
    {{ $attributes->class([
        'px-4 py-2.5 text-[11px] font-semibold tracking-[0.16em] uppercase text-neutral-600 dark:text-neutralfog-400 border-b border-neutralfog-300/70 dark:border-shadow-800/80',
        'text-left' => $align === 'left',
        'text-center' => $align === 'center',
        'text-right' => $align === 'right',
    ]) }}
>
    {{ $slot }}
</th>