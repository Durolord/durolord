@props([
    'label' => null,
    'hint' => null,
    'name' => null,
    'model' => null,
    'placeholder' => 'Pick a date',
])

@php
    $fieldName = $name ?? $model;
@endphp

<div
    x-data="{
        open: false,
        showYearPicker: false,

        selected: '',
        displayLabel: '',
        year: null,
        month: null, // 0-11
        today: new Date(),

        monthNames: [
            'January','February','March','April','May','June',
            'July','August','September','October','November','December'
        ],
        weekdayNames: ['Su','Mo','Tu','We','Th','Fr','Sa'],

        init() {
            const now = new Date();
            this.year = now.getFullYear();
            this.month = now.getMonth();

            // Initial value if present
            const initial = this.$refs.hidden.value;
            if (initial) {
                const parts = initial.split('-');
                if (parts.length === 3) {
                    const y = parseInt(parts[0],10);
                    const m = parseInt(parts[1],10)-1;
                    const d = parseInt(parts[2],10);
                    const dt = new Date(y,m,d);

                    if (!isNaN(dt.getTime())) {
                        this.year = y;
                        this.month = m;
                        this.selected = initial;
                        this.displayLabel = initial;
                    }
                }
            }

            // Click outside close
            document.addEventListener('click', (e) => {
                if (!this.$el.contains(e.target)) {
                    this.open = false;
                    this.showYearPicker = false;
                }
            });
        },

        // ---- Helpers ----
        formatISO(date) {
            const y = date.getFullYear();
            const m = String(date.getMonth()+1).padStart(2,'0');
            const d = String(date.getDate()).padStart(2,'0');
            return `${y}-${m}-${d}`;
        },

        isSameDate(a,b) {
            return a && b && a === b;
        },

        // ---- Calendar ----
        calendar() {
            const cells = [];
            const firstDay = new Date(this.year,this.month,1).getDay();
            const daysInMonth = new Date(this.year,this.month+1,0).getDate();
            const prevMonthDays = new Date(this.year,this.month,0).getDate();

            // prev tail
            for (let i = firstDay-1; i >= 0; i--) {
                const dayNum = prevMonthDays - i;
                const date = new Date(this.year, this.month-1, dayNum);
                cells.push({
                    date,
                    label: dayNum,
                    inMonth: false,
                    iso: this.formatISO(date),
                });
            }

            // current month
            for (let d=1; d <= daysInMonth; d++) {
                const date = new Date(this.year,this.month,d);
                cells.push({
                    date,
                    label: d,
                    inMonth: true,
                    iso: this.formatISO(date),
                });
            }

            // next head
            while (cells.length % 7 !== 0 || cells.length < 42) {
                const last = cells[cells.length - 1].date;
                const next = new Date(last);
                next.setDate(last.getDate()+1);
                cells.push({
                    date: next,
                    label: next.getDate(),
                    inMonth: false,
                    iso: this.formatISO(next),
                });
            }

            return cells;
        },

        prevMonth() {
            if (this.month === 0) {
                this.month = 11; this.year--;
            } else this.month--;
        },

        nextMonth() {
            if (this.month === 11) {
                this.month = 0; this.year++;
            } else this.month++;
        },

        goToday() {
            const now = new Date();
            this.year = now.getFullYear();
            this.month = now.getMonth();
            const iso = this.formatISO(now);

            this.selected = iso;
            this.displayLabel = iso;
            this.$refs.hidden.value = iso;
            this.open = false;
            this.$dispatch('input', iso);

            @if($model)
                Livewire.find(@js($attributes->get('wire:id') ?? null))?.set(@js($model), iso);
            @endif
        },

        select(day) {
            if (!day.inMonth) {
                this.year = day.date.getFullYear();
                this.month = day.date.getMonth();
            }

            const iso = day.iso;
            this.selected = iso;
            this.displayLabel = iso;
            this.$refs.hidden.value = iso;

            this.open = false;
            this.$dispatch('input', iso);

            @if($model)
                Livewire.find(@js($attributes->get('wire:id') ?? null))?.set(@js($model), iso);
            @endif
        },

        clear() {
            this.selected = '';
            this.displayLabel = '';
            this.$refs.hidden.value = '';
            this.$dispatch('input','');
        },

        // ---- YEAR PICKER ----
        yearWheelStart() {
            return this.year - 50;
        },

        yearWheelEnd() {
            return this.year + 50;
        },

        setYear(y) {
            this.year = y;
            this.showYearPicker = false;
        },
    }"
    class="space-y-1.5"
>
    {{-- Label --}}
    @if($label)
        <label class="block text-xs font-medium tracking-[0.14em] uppercase text-neutral-700 dark:text-neutralfog-300">
            {{ $label }}
        </label>
    @endif

    {{-- Trigger --}}
    <div class="relative">
        <button
            type="button"
            x-on:click="open = true"
            class="flex w-full items-center gap-2 rounded-xl border px-3 py-2 text-sm
                   bg-neutralfog-100 border-neutralfog-300 text-shadow-900
                   hover:border-electric-400 hover:ring-1 hover:ring-electric-400
                   dark:bg-shadow-950/70 dark:border-shadow-800 dark:text-neutralfog-100 transition pr-8"
        >
            <div class="flex items-center gap-2 min-w-0">
                <span class="inline-flex h-5 w-5 items-center justify-center rounded-full
                             bg-electric-500/10 text-electric-700
                             dark:bg-electric-500/20 dark:text-electric-300 text-[11px]">
                    📅
                </span>

                <span x-show="displayLabel" x-text="displayLabel" class="truncate"></span>

                <span x-show="!displayLabel" class="truncate text-neutral-400 dark:text-neutralfog-400/80">
                    {{ $placeholder }}
                </span>
            </div>
        </button>

        {{-- Clear --}}
        <button
            x-show="displayLabel"
            x-on:click.stop="clear()"
            class="absolute inset-y-0 right-2 my-auto flex h-5 w-5 items-center justify-center
                   text-[11px] text-neutral-500 hover:text-red-500 dark:text-neutralfog-400"
        >
            ✕
        </button>
    </div>

    {{-- MAIN POPUP (floating, modal-like, no dimmed backdrop) --}}
    <div
        x-show="open && !showYearPicker"
        x-transition
        x-cloak
        class="fixed z-50 top-20 left-1/2 -translate-x-1/2 w-full max-w-xs sm:max-w-sm px-4 sm:px-0"
    >
        <div class="w-full rounded-xl border bg-neutralfog-100 border-neutralfog-300 shadow-2xl
                    dark:bg-shadow-950 dark:border-shadow-800 glow-arcane">

            {{-- HEADER WITH CLICKABLE YEAR --}}
            <div class="px-3 py-2 border-b border-neutralfog-300/80 dark:border-shadow-800/80 flex items-center justify-between">

                <div class="flex items-center gap-2">
                    <button
                        x-on:click="prevMonth()"
                        class="h-6 w-6 rounded-full text-[11px] text-neutral-600 hover:bg-neutralfog-200 dark:text-neutralfog-300 dark:hover:bg-shadow-800"
                    >‹</button>

                    <div class="text-xs font-semibold text-shadow-900 dark:text-neutralfog-100">
                        <span x-text="monthNames[month]"></span>

                        {{-- CLICK TO OPEN YEAR PICKER --}}
                        <span
                            class="ml-1 underline decoration-dotted cursor-pointer text-electric-700 dark:text-electric-300"
                            x-text="year"
                            x-on:click.stop="showYearPicker = true"
                        ></span>
                    </div>

                    <button
                        x-on:click="nextMonth()"
                        class="h-6 w-6 rounded-full text-[11px] text-neutral-600 hover:bg-neutralfog-200 dark:text-neutralfog-300 dark:hover:bg-shadow-800"
                    >›</button>
                </div>

                <button
                    class="text-[10px] px-2 py-1 rounded-full border border-electric-500/60
                           bg-electric-500/5 text-electric-700 hover:bg-electric-500/15
                           dark:text-electric-300 dark:border-electric-400/70"
                    x-on:click="goToday()"
                >
                    Today
                </button>
            </div>

            {{-- WEEKDAYS --}}
            <div class="grid grid-cols-7 gap-1 px-3 pt-2 text-[10px] uppercase tracking-[0.12em]
                        text-neutral-500 dark:text-neutralfog-400">
                <template x-for="day in weekdayNames" :key="day">
                    <div class="text-center" x-text="day"></div>
                </template>
            </div>

            {{-- DAYS GRID --}}
            <div class="grid grid-cols-7 gap-1 px-3 pb-3 pt-1 text-xs">
                <template x-for="day in calendar()" :key="day.iso">
                    <button
                        x-on:click="select(day)"
                        class="relative flex h-8 w-8 items-center justify-center rounded-lg transition border border-transparent
                               focus:outline-none focus-visible:ring-1 focus-visible:ring-electric-400"
                        :class="[
                            day.inMonth ? 'text-shadow-900 dark:text-neutralfog-100' : 'text-neutral-400 dark:text-neutralfog-500/80',
                            isSameDate(day.iso, selected)
                                ? 'bg-electric-500 text-white dark:bg-electric-400 dark:text-shadow-950 shadow-sm'
                                : '',
                            !isSameDate(day.iso, selected) && day.iso === formatISO(today)
                                ? 'ring-1 ring-electric-400/60'
                                : ''
                        ]"
                    >
                        <span x-text="day.label"></span>
                    </button>
                </template>
            </div>

            {{-- FOOTER --}}
            <div class="flex items-center justify-between px-3 pb-3 text-[11px]">
                <button
                    x-on:click="clear(); open = false;"
                    class="text-neutral-500 hover:text-red-500 dark:text-neutralfog-400"
                >Clear</button>

                <button
                    x-on:click="open = false"
                    class="px-2.5 py-1.5 rounded-full border border-neutralfog-300 text-neutral-600
                           hover:text-shadow-900 hover:border-shadow-700
                           dark:border-shadow-700 dark:text-neutralfog-300 dark:hover:text-neutralfog-100"
                >Close</button>
            </div>
        </div>
    </div>

    {{-- YEAR PICKER POPUP --}}
    <div
        x-show="showYearPicker"
        x-transition
        x-cloak
        class="fixed z-50 top-24 left-1/2 -translate-x-1/2 w-full max-w-[16rem] px-4 sm:px-0"
    >
        <div class="w-full rounded-xl border bg-neutralfog-100 border-neutralfog-300 shadow-2xl
                    dark:bg-shadow-950 dark:border-shadow-800 glow-arcane">

            {{-- HEADER --}}
            <div class="px-3 py-2 border-b border-neutralfog-300/80 dark:border-shadow-800/80 flex items-center justify-between">

                <button
                    x-on:click="year -= 10"
                    class="text-[10px] px-1.5 py-1 rounded-full border border-neutralfog-300
                           hover:border-electric-400 hover:bg-electric-500/10
                           dark:border-shadow-700 dark:hover:border-electric-400
                           dark:hover:bg-electric-400/20"
                >–10</button>

                <div class="text-xs font-semibold text-shadow-900 dark:text-neutralfog-100">
                    Select Year
                </div>

                <button
                    x-on:click="year += 10"
                    class="text-[10px] px-1.5 py-1 rounded-full border border-neutralfog-300
                           hover:border-electric-400 hover:bg-electric-500/10
                           dark:border-shadow-700 dark:hover:border-electric-400
                           dark:hover:bg-electric-400/20"
                >+10</button>
            </div>

            {{-- YEAR WHEEL --}}
            <div class="relative h-48 overflow-hidden">

                {{-- Highlight slot --}}
                <div class="pointer-events-none absolute inset-x-0 top-1/2 -translate-y-1/2
                            h-10 rounded-lg border border-electric-500/50
                            bg-electric-500/5 dark:bg-electric-500/10"></div>

                {{-- Scrollable wheel --}}
                <div class="h-48 overflow-y-auto no-scrollbar py-8">

                    <template x-for="y in Array.from({length:101}, (_,i) => yearWheelStart()+i)" :key="y">
                        <button
                            type="button"
                            x-on:click="setYear(y)"
                            class="w-full h-10 flex items-center justify-center mb-1 rounded-lg text-sm
                                   border border-transparent transition"
                            :class="[
                                y === year
                                    ? 'bg-electric-500 text-white dark:bg-electric-400 dark:text-shadow-950 border-electric-500 shadow-sm'
                                    : (y === today.getFullYear()
                                        ? 'text-electric-600 dark:text-electric-300 font-semibold'
                                        : 'text-neutral-700 dark:text-neutralfog-200 hover:bg-electric-500/5 hover:border-electric-400/70')
                            ]"
                            x-text="y"
                        ></button>
                    </template>
                </div>
            </div>

            {{-- FOOTER --}}
            <div class="flex items-center justify-between px-3 pb-3 text-[11px]">
                <button
                    x-on:click="showYearPicker = false"
                    class="text-neutral-500 hover:text-red-500 dark:text-neutralfog-400"
                >Cancel</button>

                <button
                    x-on:click="showYearPicker = false"
                    class="px-2.5 py-1.5 rounded-full border border-neutralfog-300 text-neutral-600
                           hover:text-shadow-900 hover:border-shadow-700
                           dark:border-shadow-700 dark:text-neutralfog-300 dark:hover:text-neutralfog-100"
                >Done</button>
            </div>
        </div>
    </div>

    {{-- HIDDEN FIELD --}}
    <input
        type="hidden"
        x-ref="hidden"
        @if($fieldName) name="{{ $fieldName }}" @endif
        {{ $attributes->whereDoesntStartWith('wire:')->whereDoesntStartWith('value') }}
    >

    @if($hint)
        <p class="text-[11px] text-neutral-500 dark:text-neutralfog-400">{{ $hint }}</p>
    @endif
</div>
