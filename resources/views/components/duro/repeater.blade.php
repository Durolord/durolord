@props([
    'label' => null,
    'hint' => null,
])

<div
    x-data="{
        items: [],
        add() { this.items.push({}); },
        remove(i) { this.items.splice(i, 1); },
    }"
    class="space-y-1.5"
>
    @if($label)
        <p class="text-xs font-medium tracking-[0.14em] uppercase text-neutral-700 dark:text-neutralfog-300">
            {{ $label }}
        </p>
    @endif

    <div class="space-y-3">
        <template x-for="(item, i) in items" :key="i">
            <div class="rounded-xl border bg-neutralfog-100 border-neutralfog-300 p-3 dark:bg-shadow-950/70 dark:border-shadow-800">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-[11px] text-neutral-500 dark:text-neutralfog-400">Item <span x-text="i + 1"></span></span>
                    <button type="button" class="text-[11px] text-red-500" x-on:click="remove(i)">Remove</button>
                </div>

                <div class="space-y-2">
                    {{ $slot }}
                </div>
            </div>
        </template>

        <button
            type="button"
            class="text-[11px] text-electric-700 hover:text-electric-500 dark:text-electric-300"
            x-on:click="add()"
        >
            + Add item
        </button>
    </div>

    @if($hint)
        <p class="text-[11px] text-neutral-500 dark:text-neutralfog-400">{{ $hint }}</p>
    @endif
</div>
