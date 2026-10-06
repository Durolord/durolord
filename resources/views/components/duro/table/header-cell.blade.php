@props([
    'align' => 'left',
    'sortable' => false,
    'direction' => null,
])

<th
    scope="col"
    @if ($direction) aria-sort="{{ $direction === 'asc' ? 'ascending' : 'descending' }}" @endif
    {{ $attributes->class([
        'text-left' => $align === 'left',
        'text-center' => $align === 'center',
        'text-right' => $align === 'right',
    ]) }}
>
    @if ($sortable)
        <span class="inline-flex cursor-pointer select-none items-center gap-1 transition hover:text-ink">
            {{ $slot }}
            <x-duro.icon :name="$direction === 'desc' ? 'chevron-down' : 'chevron-up'" @class(['size-3', 'opacity-30' => ! $direction, 'text-primary-ink' => $direction]) />
        </span>
    @else
        {{ $slot }}
    @endif
</th>
