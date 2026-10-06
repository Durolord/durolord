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
    <button
        type="button"
        x-on:click="open = ! open"
        :aria-expanded="open.toString()"
        aria-haspopup="true"
        @class(['duro-btn duro-btn-secondary duro-btn-sm', 'duro-btn-icon' => $compact])
    >
        <span class="duro-logo-mark size-5 shrink-0" aria-hidden="true"></span>
        @unless ($compact)
            <span class="hidden flex-col items-start leading-none sm:flex">
                <span class="text-[0.55rem] font-semibold uppercase tracking-wider opacity-60">Realm</span>
                <span x-text="$store.theme.familyMeta.name"></span>
            </span>
            <x-duro.icon name="chevron-down" class="size-3.5 opacity-60" />
        @endunless
        <span class="sr-only">Change realm</span>
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
            'duro-panel absolute z-[60] mt-2 w-[min(25rem,calc(100vw-2rem))] p-2',
            'right-0 origin-top-right' => $align === 'right',
            'left-0 origin-top-left' => $align === 'left',
            'bottom-full mb-2 left-0 origin-bottom-left' => $align === 'top',
        ])
    >
        <div class="flex items-center justify-between gap-3 px-2 pb-2 pt-1">
            <p class="font-label text-[0.62rem] font-bold uppercase tracking-[0.24em] text-ink-subtle">Choose your realm</p>
            <x-duro.mode-toggle :labels="false" system />
        </div>

        <ul class="max-h-[min(30rem,70vh)] space-y-1 overflow-y-auto">
            @foreach (config('duro.families') as $key => $family)
                @php
                    $light = $themes[$family['light']];
                    $dark = $themes[$family['dark']];
                    $trait = config('duro.traits.'.$family['trait']);
                @endphp
                <li
                    class="rounded-ui border border-transparent p-2 transition"
                    :class="$store.theme.family === @js($key) ? '!border-primary/50 bg-primary/10' : 'hover:bg-ink/5'"
                >
                    <button type="button" x-on:click="$store.theme.setFamily(@js($key), $event); open = false" class="flex w-full items-center gap-3 text-left">
                        <span class="relative size-10 shrink-0 overflow-hidden rounded-md border border-line" aria-hidden="true">
                            <span class="absolute inset-0" style="background: linear-gradient(135deg, {{ $light['swatches'][0] }} 50%, {{ $dark['swatches'][0] }} 50%)"></span>
                            <span class="absolute left-1.5 top-1.5 size-2.5 rounded-full" style="background: {{ $light['swatches'][2] }}"></span>
                            <span class="absolute bottom-1.5 right-1.5 size-2.5 rounded-full" style="background: {{ $dark['swatches'][2] }}"></span>
                        </span>
                        <span class="min-w-0 flex-1">
                            <span class="flex items-center gap-2">
                                <span class="truncate text-sm font-semibold text-ink">{{ $family['name'] }}</span>
                                @if ($trait)
                                    <span class="shrink-0 text-[0.58rem] font-semibold uppercase tracking-wider text-primary-ink">{{ $trait['title'] }}</span>
                                @endif
                            </span>
                            <span class="block truncate text-[0.7rem] text-ink-subtle">{{ $family['inspiration'] ? 'Inspired by '.$family['inspiration'] : $family['motto'] }}</span>
                        </span>
                        <x-duro.icon name="check" class="text-primary-ink" x-show="$store.theme.family === {{ \Illuminate\Support\Js::from($key) }}" />
                    </button>

                    <div class="mt-2 grid grid-cols-2 gap-1.5 pl-[3.25rem]">
                        @foreach (['light' => [$family['light'], $light, 'sun'], 'dark' => [$family['dark'], $dark, 'moon']] as $mode => [$themeKey, $theme, $icon])
                            <button
                                type="button"
                                x-on:click="$store.theme.set(@js($themeKey), $event); open = false"
                                class="inline-flex items-center gap-1.5 truncate rounded-ui border px-2 py-1 text-[0.68rem] transition"
                                :class="$store.theme.current === @js($themeKey) ? 'border-primary text-ink bg-surface' : 'border-line text-ink-muted hover:border-line-strong hover:text-ink'"
                                aria-label="{{ $theme['name'] }} ({{ $mode }} mode)"
                            >
                                <span class="size-2.5 shrink-0 rounded-full ring-1 ring-ink/20" style="background: {{ $theme['swatches'][0] }}"></span>
                                <x-duro.icon :name="$icon" class="size-3 shrink-0" />
                                <span class="truncate">{{ $theme['name'] }}</span>
                            </button>
                        @endforeach
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
