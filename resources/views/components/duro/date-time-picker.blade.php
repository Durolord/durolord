@props([
    'label' => null,
    'hint' => null,
    'name' => null,
    'model' => null,       // Livewire field name
    'placeholder' => 'Pick a date & time',
])

@php
    $fieldName = $name ?? $model;
@endphp

<div
    x-data="{
        open: false,
        date: '',
        time: '',
        displayLabel: '',
        init() {
            // Close on outside click
            document.addEventListener('click', (e) => {
                if (!this.$el.contains(e.target)) {
                    this.open = false;
                }
            });
        },
        formatDisplay() {
            if (!this.date || !this.time) {
                this.displayLabel = '';
                return;
            }
            // simple display for now
            this.displayLabel = `${this.date} • ${this.time}`;
        },
        apply() {
            if (!this.date || !this.time) return;

            const value = `${this.date}T${this.time}`;
            this.$refs.hidden.value = value;
            this.formatDisplay();
            this.open = false;
            this.$dispatch('input', value);

            @if($model)
                if (window.Livewire) {
                    Livewire.find(@js($attributes->get('wire:id') ?? null))?.set(@js($model), value);
                }
            @endif
        },
        clear() {
            this.date = '';
            this.time = '';
            this.displayLabel = '';
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

    {{-- Trigger --}}
    <div class="relative">
        <button
            type="button"
            x-on:click="open = !open"
            class="flex w-full items-center justify-between gap-2 rounded-xl border px-3 py-2 text-sm
                   bg-neutralfog-100 border-neutralfog-300 text-shadow-900
                   hover:border-electric-400 hover:ring-1 hover:ring-electric-400
                   dark:bg-shadow-950/70 dark:border-shadow-800 dark:text-neutralfog-100
                   transition"
        >
            <div class="flex items-center gap-2">
                {{-- Icon --}}
                <span class="inline-flex h-5 w-5 items-center justify-center rounded-full bg-electric-500/10 text-electric-700 dark:bg-electric-500/20 dark:text-electric-300 text-[11px]">
                    ⌛
                </span>

                <span
                    x-show="displayLabel"
                    x-text="displayLabel"
                    class="truncate"
                ></span>

                <span
                    x-show="!displayLabel"
                    class="truncate text-neutral-400 dark:text-neutralfog-400/80"
                >
                    {{ $placeholder }}
                </span>
            </div>

            <div class="flex items-center gap-2">
                <button
                    type="button"
                    x-show="displayLabel"
                    x-on:click.stop="clear()"
                    class="text-[11px] text-neutral-500 hover:text-red-500 dark:text-neutralfog-400"
                    aria-label="Clear datetime"
                >
                    ✕
                </button>

                <span class="text-xs text-neutral-500 dark:text-neutralfog-400" :class="open ? 'rotate-180' : ''">
                    ▼
                </span>
            </div>
        </button>

        {{-- Popover --}}
        <div
            x-show="open"
            x-transition.origin.top
            class="absolute right-0 z-40 mt-1 w-72 rounded-xl border bg-neutralfog-100 border-neutralfog-300 shadow-xl
                   dark:bg-shadow-950/95 dark:border-shadow-800 glow-arcane"
        >
            <div class="px-3 py-2 border-b border-neutralfog-300/80 dark:border-shadow-800/80 flex items-center justify-between">
                <span class="text-[11px] uppercase tracking-[0.16em] text-neutral-500 dark:text-neutralfog-400">
                    Select time window
                </span>
                <button
                    type="button"
                    class="text-[10px] text-electric-700 hover:text-electric-500 dark:text-electric-300"
                    x-on:click="const now = new Date(); date = now.toISOString().slice(0,10); time = now.toTimeString().slice(0,5); formatDisplay(); apply();"
                >
                    Now
                </button>
            </div>

            <div class="p-3 space-y-3 text-xs text-neutral-700 dark:text-neutralfog-200">
                <div class="space-y-1">
                    <label class="block text-[11px] text-neutral-600 dark:text-neutralfog-400">
                        Date
                    </label>
                    <input
                        type="date"
                        x-model="date"
                        class="w-full rounded-lg border px-2 py-1.5 text-xs
                               bg-neutralfog-100 border-neutralfog-300 text-shadow-900
                               focus:outline-none focus:ring-1 focus:ring-electric-400 focus:border-electric-400
                               dark:bg-shadow-950/70 dark:border-shadow-800 dark:text-neutralfog-100"
                    >
                </div>

                <div class="space-y-1">
                    <label class="block text-[11px] text-neutral-600 dark:text-neutralfog-400">
                        Time
                    </label>
                    <input
                        type="time"
                        x-model="time"
                        class="w-full rounded-lg border px-2 py-1.5 text-xs
                               bg-neutralfog-100 border-neutralfog-300 text-shadow-900
                               focus:outline-none focus:ring-1 focus:ring-electric-400 focus:border-electric-400
                               dark:bg-shadow-950/70 dark:border-shadow-800 dark:text-neutralfog-100"
                    >
                </div>

                <div class="flex items-center justify-between pt-1">
                    <button
                        type="button"
                        class="text-[11px] text-neutral-500 hover:text-red-500 dark:text-neutralfog-400"
                        x-on:click="clear(); open = false;"
                    >
                        Clear
                    </button>

                    <div class="flex gap-2">
                        <button
                            type="button"
                            class="px-2.5 py-1.5 rounded-full text-[11px] border border-neutralfog-300 text-neutral-600 hover:text-shadow-900 hover:border-shadow-700 dark:border-shadow-700 dark:text-neutralfog-300 dark:hover:text-neutralfog-100 dark:hover:border-neutralfog-400"
                            x-on:click="open = false"
                        >
                            Cancel
                        </button>
                        <button
                            type="button"
                            class="px-2.5 py-1.5 rounded-full text-[11px] border border-electric-500 bg-electric-500/10 text-electric-700 hover:bg-electric-500/20 dark:border-electric-500/80 dark:text-electric-300"
                            x-on:click="apply()"
                        >
                            Apply
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Hidden field --}}
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
