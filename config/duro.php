<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Family
    |--------------------------------------------------------------------------
    |
    | Used when a visitor has not chosen a realm yet. The light or dark theme
    | of this family is picked from the visitor's operating-system setting.
    |
    */

    'default_family' => 'runic',

    /*
    |--------------------------------------------------------------------------
    | Families ("Realms")
    |--------------------------------------------------------------------------
    |
    | A family groups a light and a dark theme that share a shape language,
    | typography and ornaments. "trait" points at a personality trait in
    | config/portfolio.php, "motto" says how the realm expresses it and
    | "inspiration" credits the game behind it.
    |
    */

    'families' => [
        'runic' => [
            'name' => 'Runic Forge',
            'trait' => 'builder',
            'motto' => 'Forged, not generated — every detail hammered into place.',
            'inspiration' => null,
            'light' => 'runic-bronze',
            'dark' => 'runic-steel',
        ],
        'neon' => [
            'name' => 'Neon Circuit',
            'trait' => 'systems-thinker',
            'motto' => 'Every component wired into a circuit that makes sense.',
            'inspiration' => null,
            'light' => 'neon-daylight',
            'dark' => 'neon-circuit',
        ],
        'codex' => [
            'name' => 'Quill & Codex',
            'trait' => 'creative',
            'motto' => 'Code and story share the same craft: structure that reads beautifully.',
            'inspiration' => null,
            'light' => 'ink-quill',
            'dark' => 'crimson-codex',
        ],
        'grimoire' => [
            'name' => 'Faerûn Grimoire',
            'trait' => 'systems-thinker',
            'motto' => 'Every choice has consequences, so I plan the whole campaign.',
            'inspiration' => "Baldur's Gate 3",
            'light' => 'gilded-grimoire',
            'dark' => 'illithid',
        ],
        'lands-between' => [
            'name' => 'Lands Between',
            'trait' => 'curious',
            'motto' => 'The best discoveries hide off the beaten path.',
            'inspiration' => 'Elden Ring',
            'light' => 'erdtree',
            'dark' => 'tarnished',
        ],
        'night-city' => [
            'name' => 'Night City',
            'trait' => 'creative',
            'motto' => 'Chrome, neon and a little rebellion — technology with imagination.',
            'inspiration' => 'Cyberpunk 2077',
            'light' => 'corpo',
            'dark' => 'night-city',
        ],
        'web-slinger' => [
            'name' => 'Web-Slinger',
            'trait' => 'quiet-strength',
            'motto' => 'No spotlight needed — show up, adapt, protect what matters.',
            'inspiration' => "Marvel's Spider-Man",
            'light' => 'spider-sense',
            'dark' => 'symbiote',
        ],
        'lordran' => [
            'name' => 'Lordran',
            'trait' => 'relentless',
            'motto' => 'You died. Try again. Learn. Master it.',
            'inspiration' => 'Dark Souls',
            'light' => 'anor-londo',
            'dark' => 'bonfire',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Themes
    |--------------------------------------------------------------------------
    |
    | Every theme is a complete visual identity. Its CSS lives in
    | resources/css/app.css under [data-theme="<key>"], and the family's shared
    | shape rules under [data-family="<family>"]. Swatches feed the pickers:
    | [canvas, ink, primary].
    |
    */

    'themes' => [
        'runic-bronze' => [
            'family' => 'runic',
            'name' => 'Runic Bronze',
            'mode' => 'light',
            'tagline' => 'Hammered copper on warm parchment.',
            'mark' => 'images/brand/runic-bronze-mark.webp',
            'wordmark' => 'images/brand/runic-bronze-word.webp',
            'swatches' => ['#f6f0e4', '#9a5a2c', '#4f8fc0'],
        ],
        'runic-steel' => [
            'family' => 'runic',
            'name' => 'Runic Steel',
            'mode' => 'dark',
            'tagline' => 'Forged chrome, blue lightning, ancient sigils.',
            'mark' => 'images/brand/runic-steel-mark.webp',
            'wordmark' => 'images/brand/runic-steel-word.webp',
            'swatches' => ['#0b0e14', '#c9d1dc', '#3fa0ff'],
        ],
        'neon-daylight' => [
            'family' => 'neon',
            'name' => 'Neon Daylight',
            'mode' => 'light',
            'tagline' => 'Circuit lines etched on frosted glass.',
            'mark' => 'images/brand/neon-circuit-mark.webp',
            'wordmark' => 'images/brand/neon-circuit-word.webp',
            'swatches' => ['#f3f2fb', '#13104a', '#0a9bb8'],
        ],
        'neon-circuit' => [
            'family' => 'neon',
            'name' => 'Neon Circuit',
            'mode' => 'dark',
            'tagline' => 'Cyan current through violet circuitry.',
            'mark' => 'images/brand/neon-circuit-mark.webp',
            'wordmark' => 'images/brand/neon-circuit-word.webp',
            'swatches' => ['#0a0820', '#5ee7ff', '#7c4dff'],
        ],
        'ink-quill' => [
            'family' => 'codex',
            'name' => 'Ink & Quill',
            'mode' => 'light',
            'tagline' => 'Crisp outlines, crimson ink, editorial calm.',
            'mark' => 'images/brand/ink-quill-mark.webp',
            'wordmark' => 'images/brand/ink-quill-word.webp',
            'swatches' => ['#ffffff', '#141414', '#d7193f'],
        ],
        'crimson-codex' => [
            'family' => 'codex',
            'name' => 'Crimson Codex',
            'mode' => 'dark',
            'tagline' => 'Black steel, blood-red edges, sharp intent.',
            'mark' => 'images/brand/crimson-codex-icon.webp',
            'wordmark' => 'images/brand/crimson-codex-mark.webp',
            'swatches' => ['#0c0c0d', '#f2f2f2', '#e11d38'],
        ],
        'gilded-grimoire' => [
            'family' => 'grimoire',
            'name' => 'Gilded Grimoire',
            'mode' => 'light',
            'tagline' => 'Illuminated vellum, gold leaf and arcane violet.',
            'mark' => 'images/brand/gilded-grimoire-mark.svg',
            'wordmark' => 'images/brand/gilded-grimoire-mark.svg',
            'swatches' => ['#f5efe2', '#3b1d4a', '#b0842c'],
        ],
        'illithid' => [
            'family' => 'grimoire',
            'name' => 'Illithid',
            'mode' => 'dark',
            'tagline' => 'Psionic violet, tarnished gold, a tadpole behind the eye.',
            'mark' => 'images/brand/illithid-mark.svg',
            'wordmark' => 'images/brand/illithid-mark.svg',
            'swatches' => ['#120b1a', '#e8c872', '#a45cf0'],
        ],
        'erdtree' => [
            'family' => 'lands-between',
            'name' => 'Erdtree',
            'mode' => 'light',
            'tagline' => 'Golden boughs and the soft light of grace.',
            'mark' => 'images/brand/erdtree-mark.svg',
            'wordmark' => 'images/brand/erdtree-mark.svg',
            'swatches' => ['#f4f0e3', '#3a3322', '#b8902e'],
        ],
        'tarnished' => [
            'family' => 'lands-between',
            'name' => 'Tarnished',
            'mode' => 'dark',
            'tagline' => 'Dim ash, distant gold, a guiding light ahead.',
            'mark' => 'images/brand/tarnished-mark.svg',
            'wordmark' => 'images/brand/tarnished-mark.svg',
            'swatches' => ['#0f0e0b', '#e6d9b0', '#e3b342'],
        ],
        'corpo' => [
            'family' => 'night-city',
            'name' => 'Corpo',
            'mode' => 'light',
            'tagline' => 'Sterile towers, red warnings, yellow tape.',
            'mark' => 'images/brand/corpo-mark.svg',
            'wordmark' => 'images/brand/corpo-mark.svg',
            'swatches' => ['#ecebe6', '#111111', '#e5133d'],
        ],
        'night-city' => [
            'family' => 'night-city',
            'name' => 'Night City',
            'mode' => 'dark',
            'tagline' => 'Acid yellow chrome and glitching neon.',
            'mark' => 'images/brand/night-city-mark.svg',
            'wordmark' => 'images/brand/night-city-mark.svg',
            'swatches' => ['#08080a', '#fcee0a', '#00f0ff'],
        ],
        'spider-sense' => [
            'family' => 'web-slinger',
            'name' => 'Spider-Sense',
            'mode' => 'light',
            'tagline' => 'Comic-book red and blue, inked and halftoned.',
            'mark' => 'images/brand/spider-sense-mark.svg',
            'wordmark' => 'images/brand/spider-sense-mark.svg',
            'swatches' => ['#fbf8f2', '#14213d', '#e0242f'],
        ],
        'symbiote' => [
            'family' => 'web-slinger',
            'name' => 'Symbiote',
            'mode' => 'dark',
            'tagline' => 'Living black, stark white, a hunger for more.',
            'mark' => 'images/brand/symbiote-mark.svg',
            'wordmark' => 'images/brand/symbiote-mark.svg',
            'swatches' => ['#060608', '#f4f4f6', '#8b8fff'],
        ],
        'anor-londo' => [
            'family' => 'lordran',
            'name' => 'Anor Londo',
            'mode' => 'light',
            'tagline' => 'Sun-washed cathedral stone and gilded spires.',
            'mark' => 'images/brand/anor-londo-mark.svg',
            'wordmark' => 'images/brand/anor-londo-mark.svg',
            'swatches' => ['#f1e9d8', '#2e2618', '#c78a2c'],
        ],
        'bonfire' => [
            'family' => 'lordran',
            'name' => 'Bonfire',
            'mode' => 'dark',
            'tagline' => 'Ash, embers and a coiled sword. Rest here.',
            'mark' => 'images/brand/bonfire-mark.svg',
            'wordmark' => 'images/brand/bonfire-mark.svg',
            'swatches' => ['#0d0a08', '#e8dccb', '#f07a1f'],
        ],
    ],

];
