@props([
    'variant' => $variant ?? 'info',
])

@php
    $base = 'inline-flex items-center gap-1 rounded-full px-3 py-1 text-[11px] font-medium uppercase tracking-[0.16em]';

    $variants = [
        'info'    => 'bg-electric-500/5 text-electric-700 border border-electric-400/60 dark:bg-electric-500/15 dark:text-electric-300 dark:border-electric-400/60',
        'gold'    => 'bg-gold-500/10 text-gold-700 border border-gold-400/60 dark:bg-gold-500/15 dark:text-gold-300 dark:border-gold-400/60',
        'silver'  => 'bg-silver-500/5 text-shadow-900 border border-silver-300/60 dark:bg-silver-500/10 dark:text-silver-100 dark:border-silver-300/60',
        'shadow'  => 'bg-neutralfog-200 text-shadow-900 border border-neutralfog-300 dark:bg-shadow-900 dark:text-neutralfog-200 dark:border-shadow-800',
        'success' => 'bg-emerald-500/10 text-emerald-700 border border-emerald-500/60 dark:bg-emerald-500/15 dark:text-emerald-300 dark:border-emerald-500/60',
        'danger'  => 'bg-red-500/10 text-red-700 border border-red-500/60 dark:bg-red-600/15 dark:text-red-300 dark:border-red-500/60',
    ];

    $variantClasses = $variants[$variant] ?? $variants['info'];

    $classes = implode(' ', [$base, $variantClasses, $attributes->get('class')]);
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</span>
