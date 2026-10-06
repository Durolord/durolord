@props([
    'label' => null,
    'hint' => null,
    'placeholder' => 'Select an option',
    'options' => [],
    'name' => null,
    'model' => null,
    'searchable' => true,
    'icon' => null,
])

@php
    $wireModel = $attributes->wire('model');
    $boundModel = $model ?? $wireModel->value();
    $isLive = $wireModel->hasModifier('live');
    $fieldName = $name ?? $boundModel;
    $initialValue = $fieldName ? old($fieldName, $attributes->get('value')) : $attributes->get('value');
    $hasError = $fieldName && $errors->has($fieldName);
    $normalizedOptions = collect($options)
        ->map(fn ($optionLabel, $value) => ['value' => (string) $value, 'label' => (string) $optionLabel])
        ->values();
@endphp

<div
    x-data="{
        open: false,
        search: '',
        active: -1,
        value: @if ($boundModel) $wire.$entangle(@js($boundModel), @js($isLive)) @else @js((string) ($initialValue ?? '')) @endif,
        options: @js($normalizedOptions),
        get filtered() {
            const q = this.search.toLowerCase();
            return q ? this.options.filter(o => o.label.toLowerCase().includes(q)) : this.options;
        },
        get selectedLabel() {
            const found = this.options.find(o => o.value == this.value);
            return found ? found.label : '';
        },
        toggle() {
            this.open = ! this.open;
            if (this.open) {
                this.active = this.filtered.findIndex(o => o.value == this.value);
                this.$nextTick(() => this.$refs.search?.focus());
            }
        },
        choose(option) {
            this.value = option.value;
            this.open = false;
            this.search = '';
            this.$dispatch('input', option.value);
        },
        move(step) {
            if (! this.open) { this.toggle(); return; }
            const total = this.filtered.length;
            if (total) { this.active = (this.active + step + total) % total; }
        },
    }"
    x-on:keydown.escape.stop="open = false"
    x-on:click.outside="open = false"
    class="w-full space-y-1.5"
>
    @if ($label)
        <label class="duro-label" x-on:click="toggle()">{{ $label }}</label>
    @endif

    <div class="relative">
        <button
            type="button"
            x-on:click="toggle()"
            x-on:keydown.down.prevent="move(1)"
            x-on:keydown.up.prevent="move(-1)"
            x-on:keydown.enter.prevent="open && filtered[active] ? choose(filtered[active]) : toggle()"
            :class="{ 'is-open': open }"
            @class(['duro-field px-3 py-2.5 text-left text-sm', 'is-invalid' => $hasError])
            aria-haspopup="listbox"
            :aria-expanded="open.toString()"
        >
            @if ($icon)
                <x-duro.icon :name="$icon" class="text-ink-subtle" />
            @endif
            <span class="min-w-0 flex-1 truncate">
                <span x-show="selectedLabel" x-text="selectedLabel"></span>
                <span x-show="! selectedLabel" class="text-ink-subtle">{{ $placeholder }}</span>
            </span>
            <x-duro.icon name="chevron-down" class="text-ink-subtle transition-transform duration-200" x-bind:class="open && 'rotate-180'" />
        </button>

        <div
            x-cloak
            x-show="open"
            x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0 -translate-y-1 scale-[0.98]"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-end="opacity-0"
            class="duro-panel absolute z-50 mt-2 w-full min-w-48 overflow-hidden p-1.5"
        >
            @if ($searchable)
                <div class="mb-1.5 flex items-center gap-2 border-b border-line px-2 pb-2 pt-1 text-ink-subtle">
                    <x-duro.icon name="search" class="size-3.5" />
                    <input
                        type="text"
                        x-ref="search"
                        x-model="search"
                        x-on:keydown.down.prevent="move(1)"
                        x-on:keydown.up.prevent="move(-1)"
                        x-on:keydown.enter.prevent="filtered[active] && choose(filtered[active])"
                        placeholder="Search…"
                        class="w-full border-0 bg-transparent p-0 text-sm text-ink placeholder:text-ink-subtle focus:outline-none focus:ring-0"
                    >
                </div>
            @endif

            <ul class="max-h-60 overflow-y-auto" role="listbox">
                <template x-for="(option, index) in filtered" :key="option.value">
                    <li>
                        <button
                            type="button"
                            role="option"
                            x-on:click="choose(option)"
                            x-on:mouseenter="active = index"
                            :aria-selected="(value == option.value).toString()"
                            :class="{ 'is-active': active === index }"
                            class="duro-menu-item justify-between"
                        >
                            <span x-text="option.label" class="truncate"></span>
                            <x-duro.icon name="check" class="text-primary-ink" x-show="value == option.value" />
                        </button>
                    </li>
                </template>
                <li x-show="filtered.length === 0" class="px-3 py-4 text-center text-xs text-ink-subtle">No results found.</li>
            </ul>
        </div>

        <input type="hidden" x-model="value" @if ($fieldName) name="{{ $fieldName }}" @endif>
    </div>

    @if ($hasError)
        <p class="duro-error">{{ $errors->first($fieldName) }}</p>
    @elseif ($hint)
        <p class="duro-hint">{{ $hint }}</p>
    @endif
</div>
