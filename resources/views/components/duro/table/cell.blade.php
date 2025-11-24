@props(['align' => 'left'])

<td
    {{ $attributes->class([
        'px-4 py-3 text-xs text-neutral-800 dark:text-neutralfog-100 align-middle',
        'text-left' => $align === 'left',
        'text-center' => $align === 'center',
        'text-right' => $align === 'right',
    ]) }}
>
    {{ $slot }}
</td>