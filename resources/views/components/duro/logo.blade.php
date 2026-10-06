@props([
    'size' => 'md',
    'name' => true,
    'tagline' => null,
])

@php
    $markSize = ['sm' => 'size-8', 'md' => 'size-10', 'lg' => 'size-14', 'xl' => 'size-20'][$size] ?? 'size-10';
    $textSize = ['sm' => 'text-lg', 'md' => 'text-2xl', 'lg' => 'text-3xl', 'xl' => 'text-4xl'][$size] ?? 'text-2xl';
@endphp

<span {{ $attributes->class(['group inline-flex items-center gap-2.5']) }}>
    <span role="img" aria-label="{{ config('duro.brand') }} logo" class="duro-logo-mark {{ $markSize }} transition-transform duration-500 group-hover:rotate-[8deg] group-hover:scale-105"></span>

    @if ($name)
        <span class="flex flex-col leading-none">
            <span class="duro-display duro-logo-text {{ $textSize }} !leading-none">{{ config('duro.brand') }}</span>
            @if ($tagline)
                <span class="mt-1 font-label text-[0.6rem] font-bold uppercase tracking-[0.28em] text-ink-subtle">{{ $tagline }}</span>
            @endif
        </span>
    @endif
</span>
