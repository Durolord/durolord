@php
    $duroThemes = collect(config('duro.themes'))
        ->map(fn (array $theme) => [
            'name' => $theme['name'],
            'family' => $theme['family'],
            'mode' => $theme['mode'],
            'tagline' => $theme['tagline'],
            'swatches' => $theme['swatches'],
        ])
        ->all();

    $duroFamilies = collect(config('duro.families'))
        ->map(fn (array $family) => [
            'name' => $family['name'],
            'light' => $family['light'],
            'dark' => $family['dark'],
        ])
        ->all();

    $pageTitle = $title ?? config('portfolio.name').' — '.config('portfolio.role');
    $pageDescription = $description ?? config('portfolio.summary');
@endphp

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ $pageTitle }}</title>
<meta name="description" content="{{ $pageDescription }}">
<meta name="theme-color" content="#0b0e14">

<meta property="og:type" content="website">
<meta property="og:title" content="{{ $pageTitle }}">
<meta property="og:description" content="{{ $pageDescription }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:image" content="{{ asset('images/brand/runic-steel-mark.webp') }}">
<meta name="twitter:card" content="summary_large_image">

<link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
<link rel="icon" type="image/webp" href="{{ asset('images/brand/runic-steel-mark.webp') }}">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Alegreya+Sans:wght@400;500;700&family=Bangers&family=Barlow:wght@400;500;600;700&family=Bebas+Neue&family=Chakra+Petch:wght@500;600;700&family=Cinzel+Decorative:wght@700&family=Cinzel:wght@500;600;700&family=Cormorant+Garamond:wght@500;600;700&family=EB+Garamond:wght@400;500;600&family=Exo+2:wght@400;500;600;700&family=Grenze+Gotisch:wght@500;600;700;800&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&family=Lora:ital,wght@0,400;0,500;0,600;1,400&family=Montserrat:wght@600;700;800;900&family=Orbitron:wght@500;700;800&family=Oxanium:wght@500;600;700;800&family=Rajdhani:wght@500;600;700&family=Share+Tech+Mono&family=Spectral:wght@400;500;600&display=swap"
>

<script>
    window.__duro = {
        themes: @js($duroThemes),
        families: @js($duroFamilies),
        defaultFamily: @js(config('duro.default_family')),
    };

    (function () {
        var duro = window.__duro;
        var family = null;
        var mode = null;

        try {
            family = localStorage.getItem('duro-family');
            mode = localStorage.getItem('duro-mode');

            var legacy = localStorage.getItem('duro-theme');

            if (! family && legacy && duro.themes[legacy]) {
                family = duro.themes[legacy].family;
                mode = duro.themes[legacy].mode;
            }
        } catch (e) {}

        if (! duro.families[family]) {
            family = duro.defaultFamily;
        }

        if (['light', 'dark', 'system'].indexOf(mode) === -1) {
            mode = 'system';
        }

        var resolved = mode === 'system'
            ? (window.matchMedia && window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark')
            : mode;
        var theme = duro.families[family][resolved];
        var root = document.documentElement;

        root.dataset.theme = theme;
        root.dataset.family = family;
        root.classList.toggle('dark', resolved === 'dark');
        root.style.colorScheme = resolved;
    })();
</script>

@vite(['resources/css/app.css', 'resources/js/app.js'])
@livewireStyles
