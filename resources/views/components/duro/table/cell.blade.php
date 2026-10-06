@props(['align' => 'left'])

<td {{ $attributes->class([
    'text-left' => $align === 'left',
    'text-center' => $align === 'center',
    'text-right' => $align === 'right',
]) }}>
    {{ $slot }}
</td>
