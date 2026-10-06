@php
    $pageTitle = $title ?? config('duro.brand');
    $pageDescription = $description ?? config('duro.brand').' — Duro UI component kit with '.count(config('duro.themes')).' themes.';
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

@include('partials.theme-bootstrap')

@vite(['resources/css/app.css', 'resources/js/app.js'])
@livewireStyles
