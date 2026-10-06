@props(['ornament' => true])

<div {{ $attributes->class(['duro-divider', 'duro-divider-ornament' => $ornament]) }} role="separator">
    @if ($ornament)
        <span>{{ $slot }}</span>
    @endif
</div>
