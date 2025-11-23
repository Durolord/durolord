@props([
    'variant' => $variant ?? 'info',
    'title' => $title ?? null,
])

@php
    $base = 'rounded-2xl border px-4 py-3 text-sm flex gap-3 items-start';

    $variants = [
        'info' => 'bg-electric-500/5 border-electric-400/60 text-shadow-900 dark:bg-electric-500/10 dark:border-electric-500/60 dark:text-neutralfog-100',
        'success' => 'bg-emerald-500/5 border-emerald-400/60 text-shadow-900 dark:bg-emerald-500/10 dark:border-emerald-500/60 dark:text-neutralfog-100',
        'warning' => 'bg-gold-500/8 border-gold-400/70 text-shadow-900 dark:bg-gold-500/12 dark:border-gold-400/70 dark:text-neutralfog-100',
        'danger' => 'bg-red-500/8 border-red-500/80 text-shadow-900 dark:bg-red-600/15 dark:border-red-500/80 dark:text-red-100',
    ];

    $bullet = [
        'info' => 'bg-electric-400',
        'success' => 'bg-emerald-400',
        'warning' => 'bg-gold-400',
        'danger' => 'bg-red-400',
    ];

    $variantClasses = $variants[$variant] ?? $variants['info'];
    $bulletClasses = $bullet[$variant] ?? $bullet['info'];

    $classes = implode(' ', [$base, $variantClasses, $attributes->get('class')]);
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    <div class="mt-1">
        <span class="inline-block h-2 w-2 rounded-full {{ $bulletClasses }} glow-gold"></span>
    </div>
    <div class="space-y-1">
        @if($title)
            <div class="font-semibold text-[13px]">
                {{ $title }}
            </div>
        @endif
        <div class="text-[13px] text-neutral-700 dark:text-neutralfog-200">
            {{ $slot }}
        </div>
    </div>
</div>
