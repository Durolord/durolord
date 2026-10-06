@props([
    'label' => null,
    'hint' => null,
    'name' => null,
    'model' => null,
    'placeholder' => 'Pick a date',
])

@php
    $boundModel = $model ?? $attributes->wire('model')->value();
    $fieldName = $name ?? $boundModel;
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
            const initial = @if ($boundModel) ($wire.get(@js($boundModel)) ?? '') @else this.$refs.hidden.value @endif;
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
            this.$refs.hidden.dispatchEvent(new Event('input'));
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
            this.$refs.hidden.dispatchEvent(new Event('input'));
        },

        clear() {
            this.selected = '';
            this.displayLabel = '';
            this.$refs.hidden.value = '';
            this.$refs.hidden.dispatchEvent(new Event('input'));
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
                    📅
                </span>

                <span x-show="displayLabel" x-text="displayLabel" class="truncate"></span>

                <span x-show="!displayLabel" class="truncate text-ink-subtle ">
                    {{ $placeholder }}
                </span>
            </div>
        </button>

        {{-- Clear --}}
        <button
            x-show="displayLabel"
            x-on:click.stop="clear()"
            class="absolute inset-y-0 right-2 my-auto flex h-5 w-5 items-center justify-center
 text-[11px] text-ink-subtle hover:text-danger "
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
        <div class="w-full rounded-ui border bg-surface-2 border-line shadow-2xl
 glow-arcane">

            {{-- HEADER WITH CLICKABLE YEAR --}}
            <div class="px-3 py-2 border-b border-line/80 flex items-center justify-between">

                <div class="flex items-center gap-2">
                    <button
                        x-on:click="prevMonth()"
                        class="h-6 w-6 rounded-full text-[11px] text-ink-muted hover:bg-surface-2 "
                    >‹</button>

                    <div class="text-xs font-semibold text-ink ">
                        <span x-text="monthNames[month]"></span>

                        {{-- CLICK TO OPEN YEAR PICKER --}}
                        <span
                            class="ml-1 underline decoration-dotted cursor-pointer text-primary-ink "
                            x-text="year"
                            x-on:click.stop="showYearPicker = true"
                        ></span>
                    </div>

                    <button
                        x-on:click="nextMonth()"
                        class="h-6 w-6 rounded-full text-[11px] text-ink-muted hover:bg-surface-2 "
                    >›</button>
                </div>

                <button
                    class="text-[10px] px-2 py-1 rounded-full border border-primary/60
 bg-primary/5 text-primary-ink hover:bg-primary/15
                            "
                    x-on:click="goToday()"
                >
                    Today
                </button>
            </div>

            {{-- WEEKDAYS --}}
            <div class="grid grid-cols-7 gap-1 px-3 pt-2 text-[10px] uppercase tracking-[0.12em]
 text-ink-subtle ">
                <template x-for="day in weekdayNames" :key="day">
                    <div class="text-center" x-text="day"></div>
                </template>
            </div>

            {{-- DAYS GRID --}}
            <div class="grid grid-cols-7 gap-1 px-3 pb-3 pt-1 text-xs">
                <template x-for="day in calendar()" :key="day.iso">
                    <button
                        x-on:click="select(day)"
                        class="relative flex h-8 w-8 items-center justify-center rounded-ui transition border border-transparent
 focus:outline-none focus-visible:ring-1 focus-visible:ring-primary"
                        :class="[
 day.inMonth ? 'text-ink ' : 'text-ink-subtle ',
                            isSameDate(day.iso, selected)
                                ? 'bg-primary text-on-primary   shadow-sm'
                                : '',
                            !isSameDate(day.iso, selected) && day.iso === formatISO(today)
                                ? 'ring-1 ring-primary/60'
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
                    class="text-ink-subtle hover:text-danger "
                >Clear</button>

                <button
                    x-on:click="open = false"
                    class="px-2.5 py-1.5 rounded-full border border-line text-ink-muted
 hover:text-ink hover:border-line
                             "
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
        <div class="w-full rounded-ui border bg-surface-2 border-line shadow-2xl
 glow-arcane">

            {{-- HEADER --}}
            <div class="px-3 py-2 border-b border-line/80 flex items-center justify-between">

                <button
                    x-on:click="year -= 10"
                    class="text-[10px] px-1.5 py-1 rounded-full border border-line
 hover:border-primary hover:bg-primary/10

                           "
                >–10</button>

                <div class="text-xs font-semibold text-ink ">
                    Select Year
                </div>

                <button
                    x-on:click="year += 10"
                    class="text-[10px] px-1.5 py-1 rounded-full border border-line
 hover:border-primary hover:bg-primary/10

                           "
                >+10</button>
            </div>

            {{-- YEAR WHEEL --}}
            <div class="relative h-48 overflow-hidden">

                {{-- Highlight slot --}}
                <div class="pointer-events-none absolute inset-x-0 top-1/2 -translate-y-1/2
 h-10 rounded-ui border border-primary/50
                            bg-primary/5 "></div>

                {{-- Scrollable wheel --}}
                <div class="h-48 overflow-y-auto no-scrollbar py-8">

                    <template x-for="y in Array.from({length:101}, (_,i) => yearWheelStart()+i)" :key="y">
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

            {{-- FOOTER --}}
            <div class="flex items-center justify-between px-3 pb-3 text-[11px]">
                <button
                    x-on:click="showYearPicker = false"
                    class="text-ink-subtle hover:text-danger "
                >Cancel</button>

                <button
                    x-on:click="showYearPicker = false"
                    class="px-2.5 py-1.5 rounded-full border border-line text-ink-muted
 hover:text-ink hover:border-line
                             "
                >Done</button>
            </div>
        </div>
    </div>

    {{-- HIDDEN FIELD --}}
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
