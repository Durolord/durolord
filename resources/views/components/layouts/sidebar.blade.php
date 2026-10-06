@props(['groups' => []])

<nav class="flex-1 space-y-6 overflow-y-auto px-3 py-5" aria-label="Panel">
    @foreach ($groups as $group => $items)
        <div class="space-y-1">
            <p class="px-3 pb-1 font-label text-[0.6rem] font-bold uppercase tracking-[0.24em] text-ink-subtle transition-opacity" :class="sidebarCollapsed && 'lg:opacity-0'">{{ $group }}</p>

            @foreach ($items as $item)
                @php($active = request()->routeIs($item['active'] ?? $item['route']))
                <a
                    href="{{ route($item['route']) }}"
                    x-tooltip.right="sidebarCollapsed ? @js($item['label']) : ''"
                    @class([
                        'group relative flex items-center gap-3 rounded-ui px-3 py-2 text-sm font-medium transition',
                        'bg-primary/12 text-ink' => $active,
                        'text-ink-muted hover:bg-ink/5 hover:text-ink' => ! $active,
                    ])
                    @if ($active) aria-current="page" @endif
                >
                    @if ($active)
                        <span class="absolute inset-y-1.5 left-0 w-[3px] rounded-full bg-primary shadow-glow"></span>
                    @endif
                    <x-duro.icon :name="$item['icon']" @class(['size-[1.1rem]', 'text-primary-ink' => $active, 'text-ink-subtle group-hover:text-ink' => ! $active]) />
                    <span class="truncate transition-opacity" :class="sidebarCollapsed && 'lg:hidden'">{{ $item['label'] }}</span>
                    @isset($item['badge'])
                        <span class="duro-badge duro-badge-primary ml-auto !px-1.5 !py-0 !text-[0.55rem]" :class="sidebarCollapsed && 'lg:hidden'">{{ $item['badge'] }}</span>
                    @endisset
                </a>
            @endforeach
        </div>
    @endforeach
</nav>
