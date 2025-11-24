@props(['interactive' => true])

<tr
    {{ $attributes->class([
        'transition-colors',
        'hover:bg-neutralfog-100/90 dark:hover:bg-shadow-900/80' => $interactive,
    ]) }}
>
    {{ $slot }}
</tr>