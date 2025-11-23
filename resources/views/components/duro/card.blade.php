@props([
    'hover' => $hover ?? true,
    'padding' => $padding ?? 'md',
])

@php
    $base = 'rounded-3xl border backdrop-blur text-sm
             bg-neutralfog-100/95 border-neutralfog-300 text-shadow-900
             dark:bg-shadow-900/80 dark:border-electric-700/50 dark:text-neutralfog-100';

    $pad = [
        'sm' => 'p-3',
        'md' => 'p-5 md:p-6',
        'lg' => 'p-6 md:p-8',
    ][$padding] ?? 'p-5 md:p-6';

    $hoverClasses = $hover
        ? 'transition hover:border-electric-400 hover:shadow-lg hover:shadow-electric-500/20 dark:hover:border-electric-400 dark:hover:shadow-xl dark:hover:shadow-electric-500/30'
        : '';

    $classes = implode(' ', [$base, $pad, $hoverClasses, $attributes->get('class')]);
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</div>
