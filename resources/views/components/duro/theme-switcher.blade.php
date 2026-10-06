@props([
    'align' => 'right',
    'compact' => false,
])

<div
    x-data="{ open: false }"
    x-on:keydown.escape.window="open = false"
    x-on:click.outside="open = false"
    {{ $attributes->class(['relative']) }}
>
    <button
        type="button"
        x-on:click="open = ! open"
        x-tooltip="'Switch realm'"
        :aria-expanded="open.toString()"
        aria-haspopup="true"
        @class([
            'duro-btn duro-btn-secondary duro-btn-sm',
            'duro-btn-icon' => $compact,
        ])
    >
        <span class="flex -space-x-1">
            <template x-for="color in ($store.theme.meta.swatches ?? [])" :key="color">
                <span class="size-3 rounded-full ring-2 ring-surface-2" :style="`background:${color}`"></span>
            </template>
        </span>
        @unless ($compact)
            <span class="hidden sm:inline" x-text="$store.theme.meta.name"></span>
            <x-duro.icon name="chevron-down" class="size-3.5 opacity-60" />
        @endunless
        <span class="sr-only">Change theme</span>
    </button>

    <div
        x-cloak
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-end="opacity-0 scale-95"
        @class([
            'duro-panel absolute z-[60] mt-2 w-80 p-2',
            'right-0 origin-top-right' => $align === 'right',
            'left-0 origin-top-left' => $align === 'left',
            'bottom-full mb-2 left-0 origin-bottom-left' => $align === 'top',
        ])
    >
        <p class="px-2 pb-2 pt-1 font-label text-[0.62rem] font-bold uppercase tracking-[0.24em] text-ink-subtle">Choose your realm</p>

        @foreach (config('duro.themes') as $key => $theme)
            <button
                type="button"
                x-on:click="$store.theme.set(@js($key), $event); open = false"
                class="duro-menu-item items-start gap-3 py-2.5"
                :class="{ 'is-active': $store.theme.current === @js($key) }"
            >
                <span class="relative mt-0.5 grid size-9 shrink-0 place-items-center overflow-hidden rounded-md border border-line" style="background: {{ $theme['swatches'][0] }}">
                    <span class="absolute inset-x-0 bottom-0 h-1/3" style="background: {{ $theme['swatches'][2] }}"></span>
                    <span class="relative size-3 rounded-full" style="background: {{ $theme['swatches'][1] }}"></span>
                </span>
                <span class="min-w-0 flex-1">
                    <span class="flex items-center gap-2 text-sm font-semibold text-ink">
                        {{ $theme['name'] }}
                        <span class="text-[0.6rem] font-medium uppercase tracking-wider text-ink-subtle">{{ $theme['mode'] }}</span>
                    </span>
                    <span class="block text-xs leading-snug text-ink-subtle">{{ $theme['tagline'] }}</span>
                </span>
                <x-duro.icon name="check" class="mt-1 text-primary-ink" x-show="$store.theme.current === {{ \Illuminate\Support\Js::from($key) }}" />
            </button>
        @endforeach
    </div>
</div>
