@props([
    'label' => null,
    'hint' => null,
    'placeholder' => 'Select options',
    'options' => [],          // ['value' => 'Label']
    'name' => null,
    'model' => null,          // Livewire model name
])

@php
    $fieldName = $name ?? $model;
@endphp

<div
    x-data="{
        open: false,
        search: '',
        values: @js(
            collect(explode(',', (string)($attributes->get('value') ?? '')))
                ->filter()
                ->values()
        ),
        options: @js(
            collect($options)->map(fn ($label, $value) => ['value' => $value, 'label' => $label])->values()
        ),

        init() {
            document.addEventListener('click', (e) => {
                if (!this.$el.contains(e.target)) this.open = false;
            });

            this.syncHidden();
        },

        filteredOptions() {
            const q = this.search.toLowerCase();
            if (!q) return this.options;
            return this.options.filter(o => o.label.toLowerCase().includes(q));
        },

        isSelected(value) {
            return this.values.includes(String(value));
        },

        toggleOption(option) {
            const v = String(option.value);
            if (this.isSelected(v)) {
                this.values = this.values.filter(x => x !== v);
            } else {
                this.values.push(v);
            }
            this.syncHidden();
        },

        removeValue(value) {
            this.values = this.values.filter(v => v !== String(value));
            this.syncHidden();
        },

        clearAll() {
            this.values = [];
            this.syncHidden();
        },

        syncHidden() {
            const payload = this.values.join(',');
            this.$refs.hidden.value = payload;
            this.$dispatch('input', payload);

            @if($model)
                if (window.Livewire) {
                    Livewire.find(@js($attributes->get('wire:id') ?? null))?.set(@js($model), this.values);
                }
            @endif
        },

        selectedLabels() {
            return this.options.filter(o => this.values.includes(String(o.value)));
        },
    }"
    class="space-y-1.5 w-full"
>
    @if($label)
        <label class="block text-xs font-medium tracking-[0.14em] uppercase text-neutral-700 dark:text-neutralfog-300">
            {{ $label }}
        </label>
    @endif

    <div class="relative w-full">
        {{-- Trigger --}}
        <button
            type="button"
            x-on:click="open = !open"
            class="flex w-full items-center gap-2 rounded-xl border px-3 py-2 text-sm
                   bg-neutralfog-100 border-neutralfog-300 text-shadow-900
                   hover:border-electric-400 hover:ring-1 hover:ring-electric-400
                   dark:bg-shadow-950/70 dark:border-shadow-800 dark:text-neutralfog-100 transition"
        >
            <div class="flex-1 min-w-0 flex flex-wrap gap-1 items-center">
                <template x-if="selectedLabels().length">
                    <template x-for="item in selectedLabels()" :key="item.value">
                        <span
                            class="inline-flex items-center gap-1 rounded-full px-2 py-0.5 text-[11px]
                                   bg-electric-500/10 text-electric-700 border border-electric-500/40
                                   dark:bg-electric-500/15 dark:text-electric-300 dark:border-electric-400/60"
                        >
                            <span x-text="item.label" class="truncate max-w-[7rem]"></span>
                            <button
                                type="button"
                                x-on:click.stop="removeValue(item.value)"
                                class="text-[10px] leading-none"
                            >
                                ✕
                            </button>
                        </span>
                    </template>
                </template>

                <span
                    x-show="!selectedLabels().length"
                    class="truncate text-neutral-400 dark:text-neutralfog-400/80"
                >
                    {{ $placeholder }}
                </span>
            </div>

            <div class="flex items-center gap-2 text-[11px] text-neutral-500 dark:text-neutralfog-400">
                <span x-show="selectedLabels().length" x-text="selectedLabels().length"></span>
                <span class="text-[10px]">▾</span>
            </div>
        </button>

        {{-- Dropdown --}}
        <div
            x-show="open"
            x-transition.origin.top
            x-cloak
            class="absolute z-40 mt-1 w-full rounded-xl border bg-neutralfog-100 border-neutralfog-300 shadow-xl
                   dark:bg-shadow-950/95 dark:border-shadow-800 glow-arcane"
        >
            {{-- Search + clear --}}
            <div class="flex items-center gap-2 border-b border-neutralfog-300/80 dark:border-shadow-800/80 px-2 py-1.5">
                <input
                    type="text"
                    x-model="search"
                    placeholder="Search..."
                    class="w-full rounded-lg border-0 bg-neutralfog-100/80 px-2 py-1 text-xs text-shadow-900
                           placeholder:text-neutral-400 focus:outline-none focus:ring-0
                           dark:bg-shadow-900/80 dark:text-neutralfog-100 dark:placeholder:text-neutralfog-400"
                >
                <button
                    type="button"
                    x-on:click="clearAll()"
                    class="text-[10px] text-neutral-500 hover:text-red-500 dark:text-neutralfog-400 whitespace-nowrap"
                >
                    Clear all
                </button>
            </div>

            {{-- Options --}}
            <ul class="max-h-56 overflow-y-auto py-1 text-sm">
                <template x-for="option in filteredOptions()" :key="option.value">
                    <li>
                        <button
                            type="button"
                            x-on:click="toggleOption(option)"
                            class="flex w-full items-center gap-2 px-3 py-1.5 text-left
                                   hover:bg-electric-500/10 hover:text-electric-700
                                   dark:hover:bg-electric-500/15 dark:hover:text-electric-300"
                            :class="isSelected(option.value)
                                ? 'bg-electric-500/5 text-electric-700 dark:text-electric-300'
                                : 'text-neutral-700 dark:text-neutralfog-200'"
                        >
                            {{-- Checkbox with ✔ only when selected --}}
                            <span
                                class="inline-flex h-4 w-4 items-center justify-center rounded border text-[10px] mr-1"
                                :class="isSelected(option.value)
                                    ? 'border-electric-500 bg-electric-500/80 text-white'
                                    : 'border-neutralfog-400 dark:border-shadow-600 bg-transparent'"
                            >
                                <span x-show="isSelected(option.value)" x-cloak>✔</span>
                            </span>

                            <span
                                x-text="option.label"
                                class="flex-1 whitespace-normal break-words"
                            ></span>
                        </button>
                    </li>
                </template>

                <li x-show="filteredOptions().length === 0">
                    <div class="px-3 py-2 text-xs text-neutral-500 dark:text-neutralfog-400">
                        No results found.
                    </div>
                </li>
            </ul>
        </div>

        {{-- Hidden --}}
        <input
            type="hidden"
            x-ref="hidden"
            @if($fieldName) name="{{ $fieldName }}" @endif
            {{ $attributes->whereDoesntStartWith('wire:')->whereDoesntStartWith('value') }}
        >
    </div>

    @if($hint)
        <p class="text-[11px] text-neutral-500 dark:text-neutralfog-400">{{ $hint }}</p>
    @endif
</div>
