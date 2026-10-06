@props([
    'tabs' => [],
    'default' => null,
    'variant' => 'pills',
])

<div x-data="{ tab: @js($default ?? array_key_first($tabs)) }" {{ $attributes->class(['space-y-5']) }}>
    <div @class(['duro-tabs max-w-full overflow-x-auto no-scrollbar', 'duro-tabs-underline flex' => $variant === 'underline']) role="tablist">
        @foreach ($tabs as $key => $label)
            <button
                type="button"
                role="tab"
                class="duro-tab"
                x-on:click="tab = @js($key)"
                :aria-selected="(tab === @js($key)).toString()"
            >{{ $label }}</button>
        @endforeach
    </div>

    {{ $slot }}
</div>
