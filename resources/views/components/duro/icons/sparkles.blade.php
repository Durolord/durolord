@props(['class' => 'h-4 w-4'])

<svg
    {{ $attributes->merge(['class' => $class]) }}
    viewBox="0 0 24 24"
    fill="none"
    stroke="currentColor"
    stroke-width="1.7"
    stroke-linecap="round"
    stroke-linejoin="round"
>
    {{-- Main big sparkle --}}
    <path d="M12 3.5L13.4 8.1L18 9.5L13.4 10.9L12 15.5L10.6 10.9L6 9.5L10.6 8.1L12 3.5Z" />

    {{-- Small sparkle top-right --}}
    <path d="M18.5 4.5L19.2 6.4L21.1 7.1L19.2 7.8L18.5 9.7L17.8 7.8L15.9 7.1L17.8 6.4L18.5 4.5Z" />

    {{-- Small sparkle bottom-left --}}
    <path d="M6 14.5L6.6 16.1L8.2 16.7L6.6 17.3L6 18.9L5.4 17.3L3.8 16.7L5.4 16.1L6 14.5Z" />
</svg>
