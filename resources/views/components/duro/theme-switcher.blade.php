@props([
    'align' => 'right',
    'compact' => false,
])

@php
    $themes = config('duro.themes');
@endphp

<div
    x-data="{ open: false }"
    x-on:keydown.escape.window="open = false"
    x-on:click.outside="open = false"
    {{ $attributes->class(['relative']) }}
>
    <div class="flex items-center gap-1">
        <button
            type="button"
            x-on:click="$store.theme.toggleMode($event)"
            x-tooltip="$store.theme.resolvedMode === 'dark' ? 'Switch to light mode' : 'Switch to dark mode'"
            class="duro-btn duro-btn-ghost duro-btn-sm duro-btn-icon"
            aria-label="Toggle light or dark mode"
        >
            <x-duro.icon name="sun" x-show="$store.theme.resolvedMode === 'dark'" />
            <x-duro.icon name="moon" x-show="$store.theme.resolvedMode === 'light'" x-cloak />
        </button>

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
            <span class="sr-only">Change realm</span>
        </button>
    </div>

    <div
        x-cloak
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-end="opacity-0 scale-95"
        @class([
            'duro-panel absolute z-[60] mt-2 w-[min(23rem,calc(100vw-2rem))] p-2',
            'right-0 origin-top-right' => $align === 'right',
            'left-0 origin-top-left' => $align === 'left',
            'bottom-full mb-2 left-0 origin-bottom-left' => $align === 'top',
        ])
    >
        <div class="flex items-center justify-between gap-3 px-2 pb-2 pt-1">
            <p class="font-label text-[0.62rem] font-bold uppercase tracking-[0.24em] text-ink-subtle">Choose your realm</p>
            <div class="duro-tabs !p-0.5" role="radiogroup" aria-label="Colour mode">
                @foreach (['light' => 'sun', 'dark' => 'moon', 'system' => 'monitor'] as $mode => $icon)
                    <button
                        type="button"
                        role="radio"
                        class="duro-tab !px-2 !py-1"
                        x-on:click="$store.theme.setMode(@js($mode), $event)"
                        :aria-selected="($store.theme.mode === @js($mode)).toString()"
                        :aria-checked="($store.theme.mode === @js($mode)).toString()"
                        x-tooltip="@js(ucfirst($mode))"
                        aria-label="{{ ucfirst($mode) }} mode"
                    >
                        <x-duro.icon :name="$icon" class="size-3.5" />
                    </button>
                @endforeach
            </div>
        </div>

        <div class="max-h-[min(28rem,70vh)] space-y-0.5 overflow-y-auto">
            @foreach (config('duro.families') as $key => $family)
                @php
                    $light = $themes[$family['light']];
                    $dark = $themes[$family['dark']];
                @endphp
                <button
                    type="button"
                    x-on:click="$store.theme.setFamily(@js($key), $event); open = false"
                    class="duro-menu-item items-center gap-3 py-2"
                    :class="{ 'is-active': $store.theme.family === @js($key) }"
                >
                    <span class="relative grid size-10 shrink-0 overflow-hidden rounded-md border border-line" aria-hidden="true">
                        <span class="absolute inset-0" style="background: linear-gradient(135deg, {{ $light['swatches'][0] }} 50%, {{ $dark['swatches'][0] }} 50%)"></span>
                        <span class="absolute left-1.5 top-1.5 size-2.5 rounded-full" style="background: {{ $light['swatches'][2] }}"></span>
                        <span class="absolute bottom-1.5 right-1.5 size-2.5 rounded-full" style="background: {{ $dark['swatches'][2] }}"></span>
                    </span>
                    <span class="min-w-0 flex-1">
                        <span class="flex items-center gap-2">
                            <span class="truncate text-sm font-semibold text-ink">{{ $family['name'] }}</span>
                            @if ($trait = config('portfolio.traits.'.$family['trait'].'.title'))
                                <span class="shrink-0 text-[0.58rem] font-semibold uppercase tracking-wider text-primary-ink">{{ $trait }}</span>
                            @endif
                        </span>
                        <span class="block truncate text-[0.7rem] text-ink-subtle">
                            {{ $light['name'] }} · {{ $dark['name'] }}@if ($family['inspiration']) — {{ $family['inspiration'] }}@endif
                        </span>
                    </span>
                    <x-duro.icon name="check" class="text-primary-ink" x-show="$store.theme.family === {{ \Illuminate\Support\Js::from($key) }}" />
                </button>
            @endforeach
        </div>
    </div>
</div>
