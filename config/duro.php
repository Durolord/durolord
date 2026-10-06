<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Themes
    |--------------------------------------------------------------------------
    |
    | Used when a visitor has not chosen a theme yet. The light or dark default
    | is chosen from the visitor's operating-system color scheme.
    |
    */

    'default_dark_theme' => 'runic-steel',

    'default_light_theme' => 'runic-bronze',

    /*
    |--------------------------------------------------------------------------
    | Themes ("Realms")
    |--------------------------------------------------------------------------
    |
    | Every theme is a complete visual identity: palette, typography, shape
    | language, ornaments and brand art. The CSS lives in resources/css/app.css
    | under [data-theme="<key>"]. Swatches are used by the theme pickers.
    |
    */

    'themes' => [
        'runic-steel' => [
            'name' => 'Runic Steel',
            'mode' => 'dark',
            'tagline' => 'Forged chrome, blue lightning, ancient sigils.',
            'mark' => 'images/brand/runic-steel-mark.webp',
            'wordmark' => 'images/brand/runic-steel-word.webp',
            'swatches' => ['#0b0e14', '#c9d1dc', '#3fa0ff'],
        ],
        'runic-bronze' => [
            'name' => 'Runic Bronze',
            'mode' => 'light',
            'tagline' => 'Hammered copper on warm parchment.',
            'mark' => 'images/brand/runic-bronze-mark.webp',
            'wordmark' => 'images/brand/runic-bronze-word.webp',
            'swatches' => ['#f6f0e4', '#9a5a2c', '#4f8fc0'],
        ],
        'neon-circuit' => [
            'name' => 'Neon Circuit',
            'mode' => 'dark',
            'tagline' => 'Cyan current through violet circuitry.',
            'mark' => 'images/brand/neon-circuit-mark.webp',
            'wordmark' => 'images/brand/neon-circuit-word.webp',
            'swatches' => ['#0a0820', '#5ee7ff', '#7c4dff'],
        ],
        'ink-quill' => [
            'name' => 'Ink & Quill',
            'mode' => 'light',
            'tagline' => 'Crisp outlines, crimson ink, editorial calm.',
            'mark' => 'images/brand/ink-quill-mark.webp',
            'wordmark' => 'images/brand/ink-quill-word.webp',
            'swatches' => ['#ffffff', '#141414', '#d7193f'],
        ],
        'crimson-codex' => [
            'name' => 'Crimson Codex',
            'mode' => 'dark',
            'tagline' => 'Black steel, blood-red edges, sharp intent.',
            'mark' => 'images/brand/crimson-codex-icon.webp',
            'wordmark' => 'images/brand/crimson-codex-mark.webp',
            'swatches' => ['#0c0c0d', '#f2f2f2', '#e11d38'],
        ],
    ],

];
