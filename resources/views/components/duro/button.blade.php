@props([
    'variant' => $variant ?? 'primary',
    'size' => $size ?? 'md',
    'type' => $type ?? 'button',
])

@php
    $base = 'inline-flex items-center justify-center rounded-full font-semibold tracking-wide transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-electric-400 disabled:opacity-60 disabled:cursor-not-allowed';

    $sizes = [
        'sm' => 'px-3 py-1.5 text-xs',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-5 py-2.5 text-sm md:text-base',
    ];

    $variants = [
        'primary' => 'bg-electric-500 text-shadow-950 border border-electric-500 hover:bg-electric-400 dark:bg-electric-500 dark:text-shadow-950 dark:border-electric-400 dark:hover:bg-electric-400',
        'ghost'   => 'bg-neutralfog-100 text-shadow-900 border border-neutralfog-300 hover:bg-neutralfog-200 dark:bg-shadow-900/70 dark:text-neutralfog-100 dark:border-electric-700/60 dark:hover:bg-shadow-800',
        'outline' => 'bg-transparent text-electric-700 border border-electric-500 hover:bg-electric-500/5 dark:text-electric-300 dark:border-electric-400 dark:hover:bg-electric-500/10',
        'danger'  => 'bg-gradient-to-br from-red-500 to-red-600 text-neutralfog-100 border border-red-500/80 shadow hover:from-red-600 hover:to-red-700',
    ];

    $sizeClasses = $sizes[$size] ?? $sizes['md'];
    $variantClasses = $variants[$variant] ?? $variants['primary'];

    $classes = implode(' ', [$base, $sizeClasses, $variantClasses, $attributes->get('class')]);
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</button>
