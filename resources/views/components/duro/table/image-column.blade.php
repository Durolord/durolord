@props([
    'src' => null,
    'alt' => '',
    'rounded' => true,
])

<x-duro.table.cell {{ $attributes->class('w-14') }}>
    <div class="h-10 w-10 overflow-hidden bg-shadow-900/40 flex items-center justify-center
                @if($rounded) rounded-full @else rounded-lg @endif">
        @if($src)
            <img src="{{ $src }}" alt="{{ $alt }}" class="h-full w-full object-cover">
        @else
            <span class="text-[10px] uppercase tracking-[0.16em] text-neutralfog-400">N/A</span>
        @endif
    </div>
</x-duro.table.cell>