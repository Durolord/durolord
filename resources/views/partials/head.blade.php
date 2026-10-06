@php
    $duroThemes = collect(config('duro.themes'))
        ->map(fn (array $theme) => [
            'name' => $theme['name'],
            'mode' => $theme['mode'],
            'tagline' => $theme['tagline'],
            'swatches' => $theme['swatches'],
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
    href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&family=Chakra+Petch:wght@500;600;700&family=Cinzel:wght@500;700&family=Exo+2:wght@400;500;600;700&family=Grenze+Gotisch:wght@500;600;700;800&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&family=Lora:ital,wght@0,400;0,500;0,600;1,400&family=Montserrat:wght@600;700;800;900&family=Orbitron:wght@500;700;800&family=Share+Tech+Mono&display=swap"
>

<script>
    window.__duro = {
        themes: @js($duroThemes),
        fallback: @js(config('duro.default_dark_theme')),
        light: @js(config('duro.default_light_theme')),
    };

    (function () {
        var duro = window.__duro;
        var theme = null;

        try {
            theme = localStorage.getItem('duro-theme');
        } catch (e) {}

        var legacy = { dark: duro.fallback, light: duro.light, system: null };

        if (theme in legacy) {
            theme = legacy[theme];
        }

        if (! theme || ! duro.themes[theme]) {
            theme = window.matchMedia && window.matchMedia('(prefers-color-scheme: light)').matches ? duro.light : duro.fallback;
        }

        var root = document.documentElement;
        var isDark = duro.themes[theme].mode !== 'light';

        root.dataset.theme = theme;
        root.classList.toggle('dark', isDark);
        root.style.colorScheme = isDark ? 'dark' : 'light';
    })();
</script>

@vite(['resources/css/app.css', 'resources/js/app.js'])
@livewireStyles
