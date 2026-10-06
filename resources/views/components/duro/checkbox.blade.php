@props([
    'label' => null,
    'hint' => null,
])

<label class="inline-flex cursor-pointer items-start gap-2.5 text-sm">
    <input type="checkbox" value="1" {{ $attributes->class(['duro-check mt-0.5']) }}>

    @if ($label || $hint)
        <span class="space-y-0.5">
            @if ($label)
                <span class="block text-ink">{{ $label }}</span>
            @endif
            @if ($hint)
                <span class="duro-hint block">{{ $hint }}</span>
            @endif
        </span>
    @endif
</label>
