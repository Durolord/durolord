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
            $refs.hidden.dispatchEvent(new Event('input'));
        }
    }"
    class="space-y-1.5"
>
    @if($label)
        <label class="duro-label">
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
                    class="w-1/3 rounded-ui border px-2 py-1.5 text-xs bg-surface-2 border-line text-ink focus:outline-none focus:ring-1 focus:ring-primary "
                >
                <input
                    type="text"
                    x-model="row.value"
                    x-on:input="sync()"
                    placeholder="Value"
                    class="flex-1 rounded-ui border px-2 py-1.5 text-xs bg-surface-2 border-line text-ink focus:outline-none focus:ring-1 focus:ring-primary "
                >
                <button type="button" class="text-[11px] text-ink-subtle hover:text-danger" x-on:click="remove(i)">✕</button>
            </div>
        </template>

        <button
            type="button"
            class="text-[11px] text-primary-ink hover:text-primary-ink "
            x-on:click="add()"
        >
            + Add pair
        </button>
    </div>

    <input type="hidden" x-ref="hidden" {{ $attributes->whereDoesntStartWith('class') }}>

    @if($hint)
        <p class="text-[11px] text-ink-subtle ">{{ $hint }}</p>
    @endif
</div>
