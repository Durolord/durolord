@props([
    'interactive' => true,
    'selected' => false,
])

<tr {{ $attributes->class(['is-interactive' => $interactive, 'is-selected' => $selected]) }}>
    {{ $slot }}
</tr>
