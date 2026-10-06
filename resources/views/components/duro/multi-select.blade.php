@props([
    'label' => null,
    'hint' => null,
    'placeholder' => 'Select options',
    'options' => [],
    'name' => null,
    'model' => null,
])

@php
    $wireModel = $attributes->wire('model');
    $boundModel = $model ?? $wireModel->value();
    $isLive = $wireModel->hasModifier('live');
    $fieldName = $name ?? $boundModel;
    $errorKey = $boundModel ?? ($fieldName ? rtrim($fieldName, '[]') : null);
    $hasError = $errorKey && ($errors->has($errorKey) || $errors->has($errorKey.'.*'));

    $initial = $attributes->get('value');
    $initial = is_array($initial) ? $initial : array_filter(explode(',', (string) $initial));
    $normalizedOptions = collect($options)
        ->map(fn ($optionLabel, $value) => ['value' => (string) $value, 'label' => (string) $optionLabel])
        ->values();
@endphp

<div
    x-data="{
        open: false,
        search: '',
        values: @if ($boundModel) $wire.$entangle(@js($boundModel), @js($isLive)) @else @js(array_values(array_map('strval', $initial))) @endif,
        options: @js($normalizedOptions),
        init() {
            if (! Array.isArray(this.values)) { this.values = this.values ? [this.values] : []; }
        },
        get filtered() {
            const q = this.search.toLowerCase();
            return q ? this.options.filter(o => o.label.toLowerCase().includes(q)) : this.options;
        },
        get selected() {
            const values = (this.values ?? []).map(String);
            return this.options.filter(o => values.includes(o.value));
        },
        isSelected(value) {
            return (this.values ?? []).map(String).includes(String(value));
        },
        toggleOption(option) {
            const current = (this.values ?? []).map(String);
            this.values = this.isSelected(option.value)
                ? current.filter(v => v !== option.value)
                : [...current, option.value];
            this.$dispatch('input', this.values);
        },
        clear() {
            this.values = [];
            this.$dispatch('input', this.values);
        },
    }"
    x-on:keydown.escape.stop="open = false"
    x-on:click.outside="open = false"
    class="w-full space-y-1.5"
>
    @if ($label)
        <label class="duro-label">{{ $label }}</label>
    @endif

    <div class="relative">
        <div
            role="button"
            tabindex="0"
            x-on:click="open = ! open; $nextTick(() => open && $refs.search.focus())"
            x-on:keydown.enter.prevent="open = ! open"
            :class="{ 'is-open': open }"
            @class(['duro-field min-h-[2.65rem] cursor-pointer px-2 py-1.5 text-sm', 'is-invalid' => $hasError])
        >
            <div class="flex min-w-0 flex-1 flex-wrap items-center gap-1.5">
                <template x-for="item in selected" :key="item.value">
                    <span class="duro-badge duro-badge-primary normal-case tracking-normal">
                        <span x-text="item.label" class="max-w-[9rem] truncate"></span>
                        <button type="button" x-on:click.stop="toggleOption(item)" class="opacity-70 hover:opacity-100" :aria-label="'Remove ' + item.label">
                            <x-duro.icon name="x" class="size-3" />
                        </button>
                    </span>
                </template>
                <span x-show="! selected.length" class="px-1 text-ink-subtle">{{ $placeholder }}</span>
            </div>
            <button type="button" x-show="selected.length" x-on:click.stop="clear()" class="text-ink-subtle hover:text-ink" aria-label="Clear selection">
                <x-duro.icon name="x-circle" />
            </button>
            <x-duro.icon name="chevron-down" class="mr-1 text-ink-subtle transition-transform" x-bind:class="open && 'rotate-180'" />
        </div>

        <div
            x-cloak
            x-show="open"
            x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0 -translate-y-1"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-end="opacity-0"
            class="duro-panel absolute z-50 mt-2 w-full overflow-hidden p-1.5"
        >
            <div class="mb-1.5 flex items-center gap-2 border-b border-line px-2 pb-2 pt-1 text-ink-subtle">
                <x-duro.icon name="search" class="size-3.5" />
                <input type="text" x-ref="search" x-model="search" placeholder="Search…" class="w-full border-0 bg-transparent p-0 text-sm text-ink placeholder:text-ink-subtle focus:outline-none focus:ring-0">
            </div>

            <ul class="max-h-60 overflow-y-auto">
                <template x-for="option in filtered" :key="option.value">
                    <li>
                        <button type="button" x-on:click="toggleOption(option)" class="duro-menu-item" :class="{ 'is-active': isSelected(option.value) }">
                            <span class="duro-check pointer-events-none" :class="isSelected(option.value) && '!bg-primary !border-primary'">
                                <x-duro.icon name="check" class="size-3 text-on-primary" x-show="isSelected(option.value)" stroke="3" />
                            </span>
                            <span x-text="option.label" class="truncate"></span>
                        </button>
                    </li>
                </template>
                <li x-show="filtered.length === 0" class="px-3 py-4 text-center text-xs text-ink-subtle">No results found.</li>
            </ul>
        </div>

        @if ($fieldName && ! $boundModel)
            <template x-for="value in values" :key="value">
                <input type="hidden" name="{{ rtrim($fieldName, '[]') }}[]" :value="value">
            </template>
        @endif
    </div>

    @if ($hasError)
        <p class="duro-error">{{ $errors->first($errorKey) ?: $errors->first($errorKey.'.*') }}</p>
    @elseif ($hint)
        <p class="duro-hint">{{ $hint }}</p>
    @endif
</div>
