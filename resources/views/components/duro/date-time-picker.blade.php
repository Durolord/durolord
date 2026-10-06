@props([
    'label' => null,
    'hint' => null,
    'name' => null,
    'model' => null,
    'placeholder' => 'Pick date & time',
])

@php
    $boundModel = $model ?? $attributes->wire('model')->value();
    $fieldName = $name ?? $boundModel;
@endphp

<div
    x-data="{
        open: false,
        showYearPicker: false,

        // Date state
        selectedDate: '', // YYYY-MM-DD
        year: null,
        month: null, // 0-11
        today: new Date(),
        monthNames: [
            'January','February','March','April','May','June',
            'July','August','September','October','November','December'
        ],
        weekdayNames: ['Su','Mo','Tu','We','Th','Fr','Sa'],

        // Time state
        hour24: null,   // 0–23
        minute: null,   // 0–59
        minutesStep: 5,
        meridiem: 'AM', // 'AM' | 'PM'
        hour12: null,   // 1–12

        // Combined
        selected: '',       // YYYY-MM-DDTHH:MM
        displayLabel: '',   // YYYY-MM-DD • h:mm AM/PM

        init() {
            const now = new Date();
            this.year = now.getFullYear();
            this.month = now.getMonth();

            // Initial value if present: YYYY-MM-DDTHH:MM
            const initial = @if ($boundModel) ($wire.get(@js($boundModel)) ?? '') @else this.$refs.hidden.value @endif;
            if (initial) {
                const [datePart, timePart] = initial.split('T');

                if (datePart) {
                    this.selectedDate = datePart;
                    const [y, m, d] = datePart.split('-').map(Number);
                    if (!isNaN(y) && !isNaN(m) && !isNaN(d)) {
                        this.year = y;
                        this.month = m - 1;
                    }
                }

                if (timePart) {
                    const [h, min] = timePart.split(':').map(Number);
                    if (!isNaN(h) && !isNaN(min)) {
                        this.hour24 = h;
                        this.minute = min;
                        const { hour12, meridiem } = this.to12Hour(this.hour24);
                        this.hour12 = hour12;
                        this.meridiem = meridiem;
                    }
                }

                this.selected = initial;
                this.displayLabel = this.formatDisplay();
            }

            document.addEventListener('click', (e) => {
                if (!this.$el.contains(e.target)) {
                    this.open = false;
                    this.showYearPicker = false;
                }
            });
        },

        // ===== helpers =====
        pad(n) { return String(n).padStart(2, '0'); },

        formatISO(date) {
            const y = date.getFullYear();
            const m = this.pad(date.getMonth()+1);
            const d = this.pad(date.getDate());
            return `${y}-${m}-${d}`;
        },

        isSameDate(a, b) { return a && b && a === b; },

        to12Hour(h24) {
            const meridiem = h24 >= 12 ? 'PM' : 'AM';
            let hour = h24 % 12;
            if (hour === 0) hour = 12;
            return { hour12: hour, meridiem };
        },

        to24Hour(hour12, meridiem) {
            let h = hour12 % 12;
            if (meridiem === 'PM') h += 12;
            return h;
        },

        formatTimeValue24() {
            if (this.hour24 === null || this.minute === null) return '';
            return `${this.pad(this.hour24)}:${this.pad(this.minute)}`;
        },

        formatTimeDisplay() {
            if (this.hour24 === null || this.minute === null) return '';
            const { hour12, meridiem } = this.to12Hour(this.hour24);
            return `${hour12}:${this.pad(this.minute)} ${meridiem}`;
        },

        formatDisplay() {
            const d = this.selectedDate || '';
            const t = this.formatTimeDisplay();
            if (d && t) return `${d} • ${t}`;
            if (d) return d;
            if (t) return t;
            return '';
        },

        fullValue() {
            const d = this.selectedDate;
            const t = this.formatTimeValue24();
            if (!d || !t) return '';
            return `${d}T${t}`;
        },

        // ===== calendar =====
        calendar() {
            const cells = [];
            const firstDay = new Date(this.year, this.month, 1).getDay();
            const daysInMonth = new Date(this.year, this.month + 1, 0).getDate();
            const prevMonthDays = new Date(this.year, this.month, 0).getDate();

            // prev tail
            for (let i = firstDay - 1; i >= 0; i--) {
                const dayNum = prevMonthDays - i;
                const date = new Date(this.year, this.month - 1, dayNum);
                cells.push({ date, label: dayNum, inMonth: false, iso: this.formatISO(date) });
            }

            // current
            for (let d = 1; d <= daysInMonth; d++) {
                const date = new Date(this.year, this.month, d);
                cells.push({ date, label: d, inMonth: true, iso: this.formatISO(date) });
            }

            // next head
            while (cells.length % 7 !== 0 || cells.length < 42) {
                const last = cells[cells.length - 1].date;
                const next = new Date(last);
                next.setDate(last.getDate() + 1);
                cells.push({ date: next, label: next.getDate(), inMonth: false, iso: this.formatISO(next) });
            }

            return cells;
        },

        prevMonth() {
            if (this.month === 0) { this.month = 11; this.year--; }
            else this.month--;
        },
        nextMonth() {
            if (this.month === 11) { this.month = 0; this.year++; }
            else this.month++;
        },

        selectDate(day) {
            if (!day.inMonth) {
                this.year = day.date.getFullYear();
                this.month = day.date.getMonth();
            }
            this.selectedDate = day.iso;
            this.displayLabel = this.formatDisplay();
        },

        // ===== time wheels =====
        hours12() { return Array.from({ length: 12 }, (_, i) => i + 1); },
        minutes() {
            const s = [];
            for (let m = 0; m < 60; m += this.minutesStep) s.push(m);
            return s;
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
                if (this.minute !== null) this.displayLabel = this.formatDisplay();
            }
        },

        setNow() {
            const now = new Date();
            this.year = now.getFullYear();
            this.month = now.getMonth();
            this.selectedDate = this.formatISO(now);

            this.hour24 = now.getHours();
            this.minute = now.getMinutes() - (now.getMinutes() % this.minutesStep);
            const { hour12, meridiem } = this.to12Hour(this.hour24);
            this.hour12 = hour12;
            this.meridiem = meridiem;

            const value = this.fullValue();
            if (!value) return;

            this.selected = value;
            this.displayLabel = this.formatDisplay();
            this.$refs.hidden.value = value;
            this.open = false;
            this.$dispatch('input', value);
            this.$refs.hidden.dispatchEvent(new Event('input'));
        },

        // year wheel
        yearWheelStart() { return this.year - 50; },
        yearWheelEnd()   { return this.year + 50; },
        setYear(y) { this.year = y; this.showYearPicker = false; },

        apply() {
            const value = this.fullValue();
            if (!value) return;

            this.selected = value;
            this.displayLabel = this.formatDisplay();
            this.$refs.hidden.value = value;
            this.open = false;
            this.showYearPicker = false;
            this.$dispatch('input', value);
            this.$refs.hidden.dispatchEvent(new Event('input'));
        },

        clear() {
            this.selected = '';
            this.displayLabel = '';
            this.selectedDate = '';
            this.hour24 = null;
            this.hour12 = null;
            this.minute = null;
            this.meridiem = 'AM';
            this.$refs.hidden.value = '';
            this.$refs.hidden.dispatchEvent(new Event('input'));
            this.$dispatch('input', '');
        },
    }"
    class="space-y-1.5 w-full"
>
    @if($label)
        <label class="duro-label">
            {{ $label }}
        </label>
    @endif

    {{-- Trigger --}}
    <div class="relative">
        <button
            type="button"
            x-on:click="open = true"
            class="flex w-full items-center gap-2 rounded-ui border px-3 py-2 text-sm
 bg-surface-2 border-line text-ink
                   hover:border-primary hover:ring-1 hover:ring-primary

                   transition pr-8"
        >
            <div class="flex items-center gap-2 min-w-0">
                <span class="inline-flex h-5 w-5 items-center justify-center rounded-full
 bg-primary/10 text-primary-ink
                               text-[11px]">
                    ⌛
                </span>

                <span x-show="displayLabel" x-text="displayLabel" class="truncate"></span>

                <span
                    x-show="!displayLabel"
                    class="truncate text-ink-subtle "
                >
                    {{ $placeholder }}
                </span>
            </div>
        </button>

        <button
            type="button"
            x-show="displayLabel"
            x-on:click.stop="clear()"
            class="absolute inset-y-0 right-2 my-auto flex h-5 w-5 items-center justify-center
 text-[11px] text-ink-subtle hover:text-danger "
        >
            ✕
        </button>
    </div>

    {{-- Main panel --}}
    <div
        x-show="open && !showYearPicker"
        x-transition
        x-cloak
        class="fixed z-50 top-16 left-1/2 -translate-x-1/2 w-full max-w-[22rem] px-4 sm:px-0"
    >
        <div class="w-full rounded-ui border bg-surface-2 border-line shadow-2xl
 glow-arcane">
            {{-- Header --}}
            <div class="px-3 py-2 border-b border-line/80 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <button
                        type="button"
                        x-on:click="prevMonth()"
                        class="h-6 w-6 inline-flex items-center justify-center rounded-full
 text-[11px] text-ink-muted hover:bg-surface-2
                                "
                    >‹</button>

                    <div class="text-xs font-semibold text-ink ">
                        <span x-text="monthNames[month]"></span>
                        <span
                            class="ml-1 underline decoration-dotted cursor-pointer text-primary-ink "
                            x-text="year"
                            x-on:click.stop="showYearPicker = true"
                        ></span>
                    </div>

                    <button
                        type="button"
                        x-on:click="nextMonth()"
                        class="h-6 w-6 inline-flex items-center justify-center rounded-full
 text-[11px] text-ink-muted hover:bg-surface-2
                                "
                    >›</button>
                </div>

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

            {{-- Body: date + time --}}
            <div class="p-3 grid grid-cols-2 gap-3 text-xs text-ink-muted ">
                {{-- Date --}}
                <div class="space-y-2">
                    <div class="grid grid-cols-7 gap-1 text-[10px] uppercase tracking-[0.12em]
 text-ink-subtle ">
                        <template x-for="day in weekdayNames" :key="day">
                            <div class="text-center" x-text="day"></div>
                        </template>
                    </div>

                    <div class="grid grid-cols-7 gap-1 pt-1">
                        <template x-for="day in calendar()" :key="day.iso">
                            <button
                                type="button"
                                x-on:click="selectDate(day)"
                                class="relative flex h-7 w-7 items-center justify-center rounded-ui
 transition border border-transparent
                                       focus:outline-none focus-visible:ring-1 focus-visible:ring-primary"
                                :class="[
 day.inMonth
                                        ? 'text-ink '
                                        : 'text-ink-subtle ',
                                    isSameDate(day.iso, selectedDate)
                                        ? 'bg-primary text-on-primary   shadow-sm'
                                        : '',
                                    !isSameDate(day.iso, selectedDate) && day.iso === formatISO(today)
                                        ? 'ring-1 ring-primary/60'
                                        : ''
                                ]"
                            >
                                <span x-text="day.label"></span>
                            </button>
                        </template>
                    </div>
                </div>

                {{-- Time --}}
                <div class="space-y-2">
                    <div class="text-[11px] text-ink-muted ">
                        Time
                    </div>

                    <div class="grid grid-cols-[1.4fr_1.4fr_auto] gap-2">
                        {{-- Hour wheel --}}
                        <div class="space-y-1">
                            <span class="text-[10px] text-ink-subtle ">Hour</span>
                            <div class="relative h-28">
                                <div class="pointer-events-none absolute inset-x-0 top-1/2 -translate-y-1/2 h-7 rounded-ui
 border border-primary/50 bg-primary/5 "></div>

                                <div class="pointer-events-none absolute inset-x-0 top-0 h-5
 bg-gradient-to-b from-surface-2  to-transparent"></div>
                                <div class="pointer-events-none absolute inset-x-0 bottom-0 h-5
 bg-gradient-to-t from-surface-2  to-transparent"></div>

                                <div class="h-28 overflow-y-autono-scrollbar py-3">
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

                        {{-- Minute wheel --}}
                        <div class="space-y-1">
                            <span class="text-[10px] text-ink-subtle ">Minute</span>
                            <div class="relative h-28">
                                <div class="pointer-events-none absolute inset-x-0 top-1/2 -translate-y-1/2 h-7 rounded-ui
 border border-primary/50 bg-primary/5 "></div>

                                <div class="pointer-events-none absolute inset-x-0 top-0 h-5
 bg-gradient-to-b from-surface-2  to-transparent"></div>
                                <div class="pointer-events-none absolute inset-x-0 bottom-0 h-5
 bg-gradient-to-t from-surface-2  to-transparent"></div>

                                <div class="h-28 overflow-y-auto no-scrollbar py-3">
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

                        {{-- AM/PM --}}
                        <div class="space-y-2">
                            <span class="text-[10px] text-ink-subtle ">Period</span>

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

                <div class="flex gap-2">
                    <button
                        type="button"
                        class="px-2.5 py-1.5 rounded-full border border-line text-ink-muted
 hover:text-ink hover:border-line
                                 "
                        x-on:click="open = false"
                    >
                        Cancel
                    </button>

                    <button
                        type="button"
                        class="px-2.5 py-1.5 rounded-full border border-primary bg-primary/10 text-primary-ink
 hover:bg-primary/20  "
                        x-on:click="apply()"
                    >
                        Apply
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Year picker --}}
    <div
        x-show="showYearPicker"
        x-transition
        x-cloak
        class="fixed z-50 top-24 left-1/2 -translate-x-1/2 w-full max-w-[16rem] px-4 sm:px-0"
    >
        <div class="w-full rounded-ui border bg-surface-2 border-line shadow-2xl
 glow-arcane">

            <div class="px-3 py-2 border-b border-line/80 flex items-center justify-between">
                <button
                    type="button"
                    x-on:click="year -= 10"
                    class="text-[10px] px-1.5 py-1 rounded-full border border-line
 hover:border-primary hover:bg-primary/10
                             "
                >–10</button>

                <div class="text-xs font-semibold text-ink ">
                    Select Year
                </div>

                <button
                    type="button"
                    x-on:click="year += 10"
                    class="text-[10px] px-1.5 py-1 rounded-full border border-line
 hover:border-primary hover:bg-primary/10
                             "
                >+10</button>
            </div>

            <div class="relative h-48 overflow-hidden">
                <div class="pointer-events-none absolute inset-x-0 top-1/2 -translate-y-1/2 h-10 rounded-ui
 border border-primary/50 bg-primary/5 "></div>

                <div class="h-48 overflow-y-auto no-scrollbar py-8">
                    <template x-for="y in Array.from({ length: 101 }, (_, i) => yearWheelStart() + i)" :key="y">
                        <button
                            type="button"
                            x-on:click="setYear(y)"
                            class="w-full h-10 flex items-center justify-center mb-1 rounded-ui text-sm
 border border-transparent transition"
                            :class="[
 y === year
                                    ? 'bg-primary text-on-primary   border-primary shadow-sm'
                                    : (y === today.getFullYear()
                                        ? 'text-primary-ink  font-semibold'
                                        : 'text-ink-muted  hover:bg-primary/5 hover:border-primary/70')
                            ]"
                            x-text="y"
                        ></button>
                    </template>
                </div>
            </div>

            <div class="flex items-center justify-between px-3 pb-3 text-[11px]">
                <button
                    type="button"
                    x-on:click="showYearPicker = false"
                    class="text-ink-subtle hover:text-danger "
                >
                    Cancel
                </button>

                <button
                    type="button"
                    x-on:click="showYearPicker = false"
                    class="px-2.5 py-1.5 rounded-full border border-line text-ink-muted
 hover:text-ink hover:border-line
                             "
                >
                    Done
                </button>
            </div>
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
