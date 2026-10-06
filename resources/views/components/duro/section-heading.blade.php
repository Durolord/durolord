@props([
    'eyebrow' => null,
    'title',
    'description' => null,
    'align' => 'left',
])

<div {{ $attributes->class(['max-w-2xl space-y-4', 'mx-auto text-center' => $align === 'center']) }} data-reveal>
    @if ($eyebrow)
        <p class="duro-eyebrow">{{ $eyebrow }}</p>
    @endif
    <h2 class="duro-heading text-3xl leading-tight sm:text-4xl lg:text-[2.75rem]">{{ $title }}</h2>
    @if ($description)
        <p class="text-base leading-relaxed text-ink-muted sm:text-lg">{{ $description }}</p>
    @endif
</div>
