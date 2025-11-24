{{-- Orb icon (Duro Code style) --}}
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

    {{-- Glyph specific to this icon --}}
    <path d="M9 12.25a3 3 0 0 1 3-3 3 3 0 0 1 2.7 1.72M7 17.5c1.4-1.7 2.9-2.5 5-2.5s3.6.8 5 2.5" />

    {{-- Mystic crosshair accent --}}
    <path d="M12 4.25v1.75M12 18v1.75M5.25 12H7M17 12h1.75" stroke-opacity="0.5" />
</svg>
