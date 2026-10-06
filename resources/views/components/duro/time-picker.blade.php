@props([
    'label' => null,
    'hint' => null,
    'name' => null,
    'model' => null,
    'placeholder' => 'Pick a time',
])

@php
    $boundModel = $model ?? $attributes->wire('model')->value();
    $fieldName = $name ?? $boundModel;
@endphp

<div
    x-data="{
        open: false,

        // internal 24h time
        hour24: null,   // 0–23
        minute: null,   // 0–59

        // display / state
        selected: '',
        displayLabel: '',
        minutesStep: 5,
        meridiem: 'AM', // 'AM' | 'PM'
        hour12: null,   // 1–12

        init() {
            // Use initial value if present: HH:MM (24h)
            const initial = @if ($boundModel) ($wire.get(@js($boundModel)) ?? '') @else this.$refs.hidden.value @endif;
            if (initial) {
                const parts = initial.split(':').map(Number);
                if (parts.length === 2 && !parts.some(isNaN)) {
                    this.hour24 = parts[0];
                    this.minute = parts[1];

                    const { hour12, meridiem } = this.to12Hour(this.hour24);
                    this.hour12 = hour12;
                    this.meridiem = meridiem;

                    this.selected = initial;
                    this.displayLabel = this.formatDisplay();
                }
            }

            // Close on outside click
            document.addEventListener('click', (e) => {
                if (!this.$el.contains(e.target) && this.open) {
                    this.open = false;
                }
            });
        },

        pad(n) {
            return String(n).padStart(2, '0');
        },

        // 24h -> 12h + meridiem
        to12Hour(h24) {
            const meridiem = h24 >= 12 ? 'PM' : 'AM';
            let hour = h24 % 12;
            if (hour === 0) hour = 12;
            return { hour12: hour, meridiem };
        },

        // 12h + meridiem -> 24h
        to24Hour(hour12, meridiem) {
            let h = hour12 % 12;
            if (meridiem === 'PM') h += 12;
            return h;
        },

        // backend value: HH:MM (24h)
        formatValue() {
            if (this.hour24 === null || this.minute === null) return '';
            return `${this.pad(this.hour24)}:${this.pad(this.minute)}`;
        },

        // label: h:MM AM/PM
        formatDisplay() {
            if (this.hour24 === null || this.minute === null) return '';

            const { hour12, meridiem } = this.to12Hour(this.hour24);
            return `${hour12}:${this.pad(this.minute)} ${meridiem}`;
        },

        hours12() {
            return Array.from({ length: 12 }, (_, i) => i + 1); // 1–12
        },

        minutes() {
            const steps = [];
            for (let m = 0; m < 60; m += this.minutesStep) {
                steps.push(m);
            }
            return steps;
        },

        setHour12(h) {
            this.hour12 = h;

            if (this.meridiem && this.minute !== null) {
                this.hour24 = this.to24Hour(this.hour12, this.meridiem);
                this.displayLabel = this.formatDisplay();
            }
        },

        setMinute(m) {
            this.minute = m;

            if (this.hour12 !== null && this.meridiem) {
                this.hour24 = this.to24Hour(this.hour12, this.meridiem);
                this.displayLabel = this.formatDisplay();
            }
        },

        setMeridiem(value) {
            this.meridiem = value;

            if (this.hour12 !== null) {
                this.hour24 = this.to24Hour(this.hour12, this.meridiem);
                if (this.minute !== null) {
                    this.displayLabel = this.formatDisplay();
                }
            }
        },

        apply() {
            if (this.hour12 === null || this.minute === null || !this.meridiem) return;

            this.hour24 = this.to24Hour(this.hour12, this.meridiem);

            const value = this.formatValue();
            if (!value) return;

            this.selected = value;
            this.displayLabel = this.formatDisplay();
            this.$refs.hidden.value = value;
            this.open = false;
            this.$dispatch('input', value);
            this.$refs.hidden.dispatchEvent(new Event('input'));
        },

        clear() {
            this.selected = '';
            this.displayLabel = '';
            this.hour24 = null;
            this.hour12 = null;
            this.minute = null;
            this.meridiem = 'AM';
            this.$refs.hidden.value = '';
            this.$refs.hidden.dispatchEvent(new Event('input'));
            this.$dispatch('input', '');
        },

        setNow() {
            const now = new Date();
            this.hour24 = now.getHours();
            this.minute = now.getMinutes() - (now.getMinutes() % this.minutesStep);

            const { hour12, meridiem } = this.to12Hour(this.hour24);
            this.hour12 = hour12;
            this.meridiem = meridiem;

            const value = this.formatValue();
            this.selected = value;
            this.displayLabel = this.formatDisplay();
            this.$refs.hidden.value = value;
            this.open = false;
            this.$dispatch('input', value);
            this.$refs.hidden.dispatchEvent(new Event('input'));
        },
    }"
    class="space-y-1.5"
>
    @if($label)
        <label class="duro-label">
            {{ $label }}
        </label>
    @endif

    {{-- Trigger + Clear suffix --}}
    <div class="relative">
        <button
            type="button"
            x-on:click="open = !open"
            class="flex w-full items-center gap-2 rounded-ui border px-3 py-2 text-sm
 bg-surface-2 border-line text-ink
                   hover:border-primary hover:ring-1 hover:ring-primary

                   transition pr-8"
        >
            <div class="flex items-center gap-2 min-w-0">
                {{-- Icon --}}
                <span class="inline-flex h-5 w-5 items-center justify-center rounded-full
 bg-primary/10 text-primary-ink
                               text-[11px]">
                    ⏰
                </span>

            <span
                    x-show="displayLabel"
                    x-text="displayLabel"
                    class="truncate"
                ></span>

                <span
                    x-show="!displayLabel"
                    class="truncate text-ink-subtle "
                >
                    {{ $placeholder }}
                </span>
            </div>
        </button>

        {{-- Suffix X --}}
        <button
            type="button"
            x-show="displayLabel"
            x-on:click.stop="clear()"
            class="absolute inset-y-0 right-2 my-auto flex h-5 w-5 items-center justify-center
 text-[11px] text-ink-subtle hover:text-danger "
            aria-label="Clear time"
        >
            ✕
        </button>
    </div>

    {{-- Time Panel --}}
    <div
        x-show="open"
        x-transition
        x-cloak
        class="absolute z-40 mt-1 w-80 rounded-ui border bg-surface-2 border-line shadow-2xl
 glow-arcane"
    >
        {{-- Header --}}
        <div class="px-3 py-2 border-b border-line/80 flex items-center justify-between">
            <span class="text-[11px] uppercase tracking-[0.16em] text-ink-subtle ">
                Select time
            </span>

            <button
                type="button"
                class="text-[10px] px-2 py-1 rounded-full border border-primary/60
 bg-primary/5 text-primary-ink hover:bg-primary/15
                        "
                x-on:click="setNow()"
            >
                Now
            </button>
        </div>

        {{-- Body: wheel pickers --}}
        <div class="p-3 grid grid-cols-[1.5fr_1.5fr_auto] gap-3 text-xs text-ink-muted ">
            {{-- HOURS WHEEL --}}
            <div class="space-y-1">
                <div class="flex items-center justify-between">
                    <span class="text-[11px] text-ink-muted ">Hour</span>
                </div>

                <div class="relative h-32">
                    {{-- Center slot line --}}
                    <div class="pointer-events-none absolute inset-x-0 top-1/2 -translate-y-1/2 h-7 rounded-ui
 border border-primary/50 bg-primary/5 "></div>

                    {{-- Top/Bottom gradients --}}
                    <div class="pointer-events-none absolute inset-x-0 top-0 h-6
 bg-gradient-to-b from-surface-2  to-transparent"></div>
                    <div class="pointer-events-none absolute inset-x-0 bottom-0 h-6
 bg-gradient-to-t from-surface-2  to-transparent"></div>

                    <div class="h-32 overflow-y-auto no-scrollbar py-4">
                        <template x-for="h in hours12()" :key="h">
                            <button
                                type="button"
                                x-on:click="setHour12(h)"
                                class="w-full h-7 flex items-center justify-center rounded-ui mb-1
 transition border border-transparent"
                                :class="hour12 === h
 ? 'bg-primary text-on-primary   border-primary shadow-sm'
                                    : 'text-ink-muted  hover:bg-primary/5 hover:border-primary/70'"
                                x-text="h"
                            ></button>
                        </template>
                    </div>
                </div>
            </div>

            {{-- MINUTES WHEEL --}}
            <div class="space-y-1">
                <div class="flex items-center justify-between">
                    <span class="text-[11px] text-ink-muted ">Minute</span>
                </div>

                <div class="relative h-32">
                    {{-- Center slot line --}}
                    <div class="pointer-events-none absolute inset-x-0 top-1/2 -translate-y-1/2 h-7 rounded-ui
 border border-primary/50 bg-primary/5 "></div>

                    {{-- Top/Bottom gradients --}}
                    <div class="pointer-events-none absolute inset-x-0 top-0 h-6
 bg-gradient-to-b from-surface-2  to-transparent"></div>
                    <div class="pointer-events-none absolute inset-x-0 bottom-0 h-6
 bg-gradient-to-t from-surface-2  to-transparent"></div>

                    <div class="h-32 overflow-y-auto no-scrollbar py-4">
                        <template x-for="m in minutes()" :key="m">
                            <button
                                type="button"
                                x-on:click="setMinute(m)"
                                class="w-full h-7 flex items-center justify-center rounded-ui mb-1
 transition border border-transparent"
                                :class="minute === m
 ? 'bg-primary text-on-primary   border-primary shadow-sm'
                                    : 'text-ink-muted  hover:bg-primary/5 hover:border-primary/70'"
                                x-text="pad(m)"
                            ></button>
                        </template>
                    </div>
                </div>
            </div>

            {{-- AM/PM + Preview --}}
            <div class="space-y-2">
                <span class="text-[11px] text-ink-muted block">Period</span>

                <div class="flex flex-col gap-2">
                    <button
                        type="button"
                        x-on:click="setMeridiem('AM')"
                        class="h-8 rounded-ui text-[11px] flex items-center justify-center
 border border-line
                               hover:border-primary hover:bg-primary/5
                                 "
                        :class="meridiem === 'AM'
 ? 'bg-primary text-on-primary   border-primary'
                            : 'text-ink-muted '"
                    >
                        AM
                    </button>

                    <button
                        type="button"
                        x-on:click="setMeridiem('PM')"
                        class="h-8 rounded-ui text-[11px] flex items-center justify-center
 border border-line
                               hover:border-primary hover:bg-primary/5
                                 "
                        :class="meridiem === 'PM'
 ? 'bg-primary text-on-primary   border-primary'
                            : 'text-ink-muted '"
                    >
                        PM
                    </button>
                </div>

                <div class="mt-1 text-[11px] text-ink-muted ">
                    <span class="opacity-70">Selected:</span>
                    <span class="font-medium" x-text="formatDisplay() || '—'"></span>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <div class="flex items-center justify-between px-3 pb-3 text-[11px]">
            <button
                type="button"
                class="text-ink-subtle hover:text-danger "
                x-on:click="clear(); open = false;"
            >
                Clear
            </button>

            <button
                type="button"
                class="px-2.5 py-1.5 rounded-full border border-line text-ink-muted
 hover:text-ink hover:border-line
                         "
                x-on:click="apply()"
            >
                Apply
            </button>
        </div>
    </div>

    {{-- Hidden --}}
    <input
        type="hidden"
        x-ref="hidden"
        @if($fieldName) name="{{ $fieldName }}" @endif
        {{ $attributes->except(['class', 'value']) }}
        @if (! $boundModel && $attributes->get('value')) value="{{ $attributes->get('value') }}" @endif
    >

    @if($hint)
        <p class="text-[11px] text-ink-subtle ">{{ $hint }}</p>
    @endif
</div>
