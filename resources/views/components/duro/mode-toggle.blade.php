@props([
    'labels' => true,
    'system' => false,
])

@php
    $modes = ['light' => ['icon' => 'sun', 'label' => 'Light'], 'dark' => ['icon' => 'moon', 'label' => 'Dark']];

    if ($system) {
        $modes['system'] = ['icon' => 'monitor', 'label' => 'Auto'];
    }
@endphp

<div {{ $attributes->class(['duro-tabs !p-0.5']) }} role="radiogroup" aria-label="Colour mode">
    @foreach ($modes as $mode => $option)
        <button
            type="button"
            role="radio"
            class="duro-tab inline-flex items-center gap-1.5 !px-2.5 !py-1 !text-xs"
            x-on:click="$store.theme.setMode(@js($mode), $event)"
            @if ($mode === 'system')
                :aria-checked="($store.theme.mode === 'system').toString()"
                :aria-selected="($store.theme.mode === 'system').toString()"
            @else
                :aria-checked="({{ $system ? "\$store.theme.mode === '{$mode}'" : "\$store.theme.resolvedMode === '{$mode}'" }}).toString()"
                :aria-selected="({{ $system ? "\$store.theme.mode === '{$mode}'" : "\$store.theme.resolvedMode === '{$mode}'" }}).toString()"
            @endif
            aria-label="{{ $option['label'] }} mode"
            x-tooltip="@js($option['label'].' mode')"
        >
            <x-duro.icon :name="$option['icon']" class="size-3.5" />
            @if ($labels)
                <span class="hidden sm:inline">{{ $option['label'] }}</span>
            @endif
        </button>
    @endforeach
</div>
