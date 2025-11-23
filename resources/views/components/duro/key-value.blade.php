@props([
    'label' => null,
    'hint' => null,
])

<div
    x-data="{
        rows: [],
        add() { this.rows.push({ key: '', value: '' }); this.sync(); },
        remove(i) { this.rows.splice(i, 1); this.sync(); },
        sync() {
            const payload = this.rows
                .filter(r => r.key !== '')
                .reduce((acc, r) => { acc[r.key] = r.value; return acc; }, {});
            $refs.hidden.value = JSON.stringify(payload);
            $dispatch('input', $refs.hidden.value);
        }
    }"
    class="space-y-1.5"
>
    @if($label)
        <label class="block text-xs font-medium tracking-[0.14em] uppercase text-neutral-700 dark:text-neutralfog-300">
            {{ $label }}
        </label>
    @endif

    <div class="space-y-2">
        <template x-for="(row, i) in rows" :key="i">
            <div class="flex gap-2">
                <input
                    type="text"
                    x-model="row.key"
                    x-on:input="sync()"
                    placeholder="Key"
                    class="w-1/3 rounded-xl border px-2 py-1.5 text-xs bg-neutralfog-100 border-neutralfog-300 text-shadow-900 focus:outline-none focus:ring-1 focus:ring-electric-400 dark:bg-shadow-950/70 dark:border-shadow-800 dark:text-neutralfog-100"
                >
                <input
                    type="text"
                    x-model="row.value"
                    x-on:input="sync()"
                    placeholder="Value"
                    class="flex-1 rounded-xl border px-2 py-1.5 text-xs bg-neutralfog-100 border-neutralfog-300 text-shadow-900 focus:outline-none focus:ring-1 focus:ring-electric-400 dark:bg-shadow-950/70 dark:border-shadow-800 dark:text-neutralfog-100"
                >
                <button type="button" class="text-[11px] text-neutral-500 hover:text-red-500" x-on:click="remove(i)">✕</button>
            </div>
        </template>

        <button
            type="button"
            class="text-[11px] text-electric-700 hover:text-electric-500 dark:text-electric-300"
            x-on:click="add()"
        >
            + Add pair
        </button>
    </div>

    <input type="hidden" x-ref="hidden" {{ $attributes->whereDoesntStartWith('class') }}>

    @if($hint)
        <p class="text-[11px] text-neutral-500 dark:text-neutralfog-400">{{ $hint }}</p>
    @endif
</div>
