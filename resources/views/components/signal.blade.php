{{-- Signal icon (Duro Code style) --}}
<svg
    {{ $attributes->merge([
        'class' => 'h-4 w-4',
        'viewBox' => '0 0 24 24',
        'xmlns' => 'http://www.w3.org/2000/svg',
        'aria-hidden' => 'true',
    ]) }}
    fill="none"
    stroke="currentColor"
    stroke-width="1.7"
    stroke-linecap="round"
    stroke-linejoin="round"
>
    {{-- Outer arcane ring --}}
    <circle cx="12" cy="12" r="9" stroke-opacity="0.45" />

    {{-- Inner focus orb --}}
    <circle cx="12" cy="12" r="4.25" stroke-opacity="0.85" />

    {{-- Signal waves --}}
    <path d="M8.5 15c0-1.9 1.6-3.5 3.5-3.5s3.5 1.6 3.5 3.5" />
    <path d="M7 17.5c1.7-2.5 3.7-3.75 5-3.75s3.3 1.25 5 3.75" stroke-opacity="0.7" />
    <path d="M9.5 10.25a5 5 0 0 1 5 0" stroke-opacity="0.7" />

    {{-- Mystic crosshair accent --}}
    <path d="M12 4.25v1.75M12 18v1.75M5.25 12H7M17 12h1.75" stroke-opacity="0.5" />
</svg>
