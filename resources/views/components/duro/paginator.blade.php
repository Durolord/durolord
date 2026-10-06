<div class="inline-flex items-center gap-1 rounded-full
 bg-surface/70 border border-line px-1 py-0.5
             ">

    {{-- Previous --}}
    @if ($paginator->onFirstPage())
        <span class="px-2 py-1 text-[10px] rounded-full opacity-40
 text-ink-muted ">
            ‹ Prev
        </span>
    @else
        <button
            wire:click="previousPage('{{ $paginator->getPageName() }}')"
            class="px-2 py-1 text-[10px] rounded-full
 hover:bg-primary/10
                   text-ink-muted ">
            ‹ Prev
        </button>
    @endif

    {{-- Page numbers --}}
    @foreach ($elements as $element)
        {{-- Separator --}}
        @if (is_string($element))
            <span class="px-2 py-1 text-[10px] rounded-full text-ink-subtle ">
                {{ $element }}
            </span>
        @endif

        {{-- Pages --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span class="px-2 py-1 text-[10px] rounded-full
 bg-primary text-on-primary shadow
                                  ">
                        {{ $page }}
                    </span>
                @else
                    <button
                        wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')"
                        class="px-2 py-1 text-[10px] rounded-full
 text-ink-muted
                               hover:bg-primary/10">
                        {{ $page }}
                    </button>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next --}}
    @if ($paginator->hasMorePages())
        <button
            wire:click="nextPage('{{ $paginator->getPageName() }}')"
            class="px-2 py-1 text-[10px] rounded-full
 hover:bg-primary/10
                   text-ink-muted ">
            Next ›
        </button>
    @else
        <span class="px-2 py-1 text-[10px] rounded-full opacity-40
 text-ink-muted ">
            Next ›
        </span>
    @endif

</div>
