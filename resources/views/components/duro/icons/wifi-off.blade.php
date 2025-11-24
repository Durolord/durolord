{{-- WiFi Off icon (Duro Code style) --}}
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

    {{-- WiFi arcs (dimmed because "off") --}}
    <path d="M7.5 14.5a6.4 6.4 0 0 1 9 0" stroke-opacity="0.35" />
    <path d="M9.5 16.5a3.8 3.8 0 0 1 5 0" stroke-opacity="0.3" />
    <path d="M11.5 18.5h1" stroke-opacity="0.3" />

    {{-- OFF slash --}}
    <path d="M6 6l12 12" stroke-opacity="0.9" />

    {{-- Mystic crosshair accents --}}
    <path d="M12 4.25v1.75M12 18v1.75M5.25 12H7M17 12h1.75" stroke-opacity="0.5" />
</svg>
