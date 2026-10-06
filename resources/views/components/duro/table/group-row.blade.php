@props([
    'label',
    'colspan' => 99,
    'count' => null,
])

<tr>
    <td colspan="{{ $colspan }}" class="!bg-surface-2 !py-2">
        <div class="flex items-center gap-3 font-label text-[0.65rem] font-bold uppercase tracking-[0.18em] text-ink-muted">
            <span>{{ $label }}</span>
            @if (! is_null($count))
                <span class="duro-badge duro-badge-neutral !py-0">{{ $count }}</span>
            @endif
            <span class="h-px flex-1 bg-line"></span>
        </div>
    </td>
</tr>
{{ $slot }}
