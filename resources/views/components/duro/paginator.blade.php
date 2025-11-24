<div class="inline-flex items-center gap-1 rounded-full
            bg-white/70 border border-neutral-200 px-1 py-0.5
            dark:bg-shadow-900/80 dark:border-electric-500/20">

    {{-- Previous --}}
    @if ($paginator->onFirstPage())
        <span class="px-2 py-1 text-[10px] rounded-full opacity-40
                     text-neutral-600 dark:text-neutral-400">
            ‹ Prev
        </span>
    @else
        <button
            wire:click="previousPage('{{ $paginator->getPageName() }}')"
            class="px-2 py-1 text-[10px] rounded-full
                   hover:bg-electric-500/10
                   text-neutral-700 dark:text-neutral-200">
            ‹ Prev
        </button>
    @endif

    {{-- Page numbers --}}
    @foreach ($elements as $element)
        {{-- Separator --}}
        @if (is_string($element))
            <span class="px-2 py-1 text-[10px] rounded-full text-neutral-400 dark:text-neutralfog-500">
                {{ $element }}
            </span>
        @endif

        {{-- Pages --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span class="px-2 py-1 text-[10px] rounded-full
                                 bg-electric-500 text-white shadow
                                 dark:bg-electric-500/80 dark:text-shadow-950">
                        {{ $page }}
                    </span>
                @else
                    <button
                        wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')"
                        class="px-2 py-1 text-[10px] rounded-full
                               text-neutral-600 dark:text-neutral-300
                               hover:bg-electric-500/10">
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
                   hover:bg-electric-500/10
                   text-neutral-700 dark:text-neutral-200">
            Next ›
        </button>
    @else
        <span class="px-2 py-1 text-[10px] rounded-full opacity-40
                     text-neutral-600 dark:text-neutral-400">
            Next ›
        </span>
    @endif

</div>
