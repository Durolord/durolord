{{-- resources/views/components/duro/icons/cube.blade.php --}}
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
    {{-- Front vertical edges --}}
    <path d="M6.5 8.2L6.5 15.8L12 19L17.5 15.8L17.5 8.2L12 5L6.5 8.2Z" />

    {{-- Top face --}}
    <path d="M6.5 8.2L12 11.5L17.5 8.2" />

    {{-- Bottom inner edge --}}
    <path d="M12 11.5L12 19" />
</svg>
