@props([
    'label' => null,
    'hint' => null,
    'placeholder' => 'Select an option',
    'options' => [],          // ['value' => 'Label']
    'name' => null,
    'model' => null,          // Livewire: field name, e.g. "role"
])

@php
    $fieldName = $name ?? $model;
@endphp

<div
    x-data="{
        open: false,
        search: '',
        selectedValue: @js(optional($attributes->get('value'))),
        selectedLabel: '',
        init() {
            // Set initial label based on initial value
            const initial = this.selectedValue;
            if (initial) {
                const found = this.options.find(o => o.value == initial);
                if (found) this.selectedLabel = found.label;
            }

            // Close on outside click
            document.addEventListener('click', (e) => {
                if (!this.$el.contains(e.target)) {
                    this.open = false;
                }
            });
        },
        options: @js(
            collect($options)->map(fn ($label, $value) => ['value' => $value, 'label' => $label])->values()
        ),
        filteredOptions() {
            if (!this.search) return this.options;
            const q = this.search.toLowerCase();
            return this.options.filter(o => o.label.toLowerCase().includes(q));
        },
        selectOption(option) {
            this.selectedValue = option.value;
            this.selectedLabel = option.label;
            this.open = false;
            this.search = '';

            // sync to hidden input
            this.$refs.hidden.value = option.value;
            this.$dispatch('input', option.value);

            @if($model)
                // Simple Livewire bridge
                if (window.Livewire) {
                    Livewire.find(@js($attributes->get('wire:id') ?? null))?.set(@js($model), option.value);
                }
            @endif
        },
        clear() {
            this.selectedValue = null;
            this.selectedLabel = '';
            this.$refs.hidden.value = '';
            this.$dispatch('input', '');
        }
    }"
    class="space-y-1.5"
>
    @if($label)
        <label class="block text-xs font-medium tracking-[0.14em] uppercase text-neutral-700 dark:text-neutralfog-300">
            {{ $label }}
        </label>
    @endif

    <div class="relative">
        {{-- Trigger --}}
        <button
            type="button"
            x-on:click="open = !open"
            class="flex w-full items-center justify-between gap-2 rounded-xl border px-3 py-2 text-sm
                   bg-neutralfog-100 border-neutralfog-300 text-shadow-900
                   hover:border-electric-400 hover:ring-1 hover:ring-electric-400
                   dark:bg-shadow-950/70 dark:border-shadow-800 dark:text-neutralfog-100
                   transition"
        >
            <div class="flex-1 text-left">
                <span
                    x-show="selectedLabel"
                    x-text="selectedLabel"
                    class="block truncate"
                ></span>
                <span
                    x-show="!selectedLabel"
                    class="block truncate text-neutral-400 dark:text-neutralfog-400/80"
                >
                    {{ $placeholder }}
                </span>
            </div>

            

        </button>

        {{-- Dropdown --}}
        <div
            x-show="open"
            x-transition.origin.top
            class="absolute z-40 mt-1 w-full rounded-xl border bg-neutralfog-100 border-neutralfog-300 shadow-xl
                   dark:bg-shadow-950/95 dark:border-shadow-800 glow-arcane"
        >
            {{-- Search --}}
            <div class="border-b border-neutralfog-300/80 dark:border-shadow-800/80 px-2 py-1.5">
                <input
                    type="text"
                    x-model="search"
                    placeholder="Search..."
                    class="w-full rounded-lg border-0 bg-neutralfog-100/80 px-2 py-1 text-xs text-shadow-900
                           placeholder:text-neutral-400 focus:outline-none focus:ring-0
                           dark:bg-shadow-900/80 dark:text-neutralfog-100 dark:placeholder:text-neutralfog-400"
                >
            </div>

            {{-- Options --}}
            <ul class="max-h-52 overflow-y-auto py-1 text-sm">
                <template x-for="option in filteredOptions()" :key="option.value">
                    <li>
                        <button
                            type="button"
                            x-on:click="selectOption(option)"
                            class="flex w-full items-center justify-between px-3 py-1.5 text-left
                                   hover:bg-electric-500/10 hover:text-electric-700
                                   dark:hover:bg-electric-500/15 dark:hover:text-electric-300"
                            :class="selectedValue === option.value ? 'text-electric-700 dark:text-electric-300 bg-electric-500/5' : 'text-neutral-700 dark:text-neutralfog-200'"
                        >
                            <span x-text="option.label" class="truncate"></span>
                            <span
                                x-show="selectedValue === option.value"
                                class="ml-2 text-[10px] text-electric-600 dark:text-electric-300"
                            >
                                ●
                            </span>
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

        {{-- Hidden input for forms / Livewire --}}
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
