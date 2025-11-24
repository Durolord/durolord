{{-- resources/views/components/duro/icons/palette.blade.php --}}
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
    {{-- Palette body --}}
    <path d="M12 3.5c-4.7 0-8.5 3.5-8.5 7.8c0 4.5 3.6 9.2 7.9 9.2c1.2 0 2-0.4 2.4-0.9
             c0.5-0.6 0.7-1.4 0.6-2.2c-0.1-0.8-0.5-1.5-0.9-1.9c-0.5-0.5-0.7-1.1-0.5-1.7
             c0.2-0.6 0.7-1.1 1.4-1.2l1.8-0.2c3-0.3 5.3-2.7 5.3-5.6C20.5 6.2 16.8 3.5 12 3.5Z" />

    {{-- Color wells --}}
    <circle cx="9" cy="8.3" r="0.8" />
    <circle cx="6.9" cy="11.1" r="0.8" />
    <circle cx="11.2" cy="6.5" r="0.8" />
    <circle cx="13.9" cy="8.1" r="0.8" />
</svg>
