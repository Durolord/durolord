{{-- Desktop glyph (Duro Code style) --}}
<svg
    {{ $attributes->merge([
        'class' => 'h-4 w-4',
        'viewBox' => '0 0 24 24',
        'xmlns' => 'http://www.w3.org/2000/svg',
        'aria-hidden' => 'true',
    ]) }}
    fill="none"
    stroke="currentColor"
    stroke-width="1.6"
    stroke-linecap="round"
    stroke-linejoin="round"
>
    {{-- Arcane bezel --}}
    <rect x="4" y="5" width="16" height="12" rx="2.25" stroke-opacity="0.85" />

    {{-- Interface grid --}}
    <path d="M8 9.25h8M8 12h4.5" stroke-opacity="0.65" />

    {{-- Stand --}}
    <path d="M10 17v1.75h4V17" stroke-opacity="0.75" />

    {{-- Base rune --}}
    <path d="M7.5 19.5h9" stroke-opacity="0.55" />
</svg>
