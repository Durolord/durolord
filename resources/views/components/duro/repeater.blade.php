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
        <p class="duro-label">
            {{ $label }}
        </p>
    @endif

    <div class="space-y-3">
        <template x-for="(item, i) in items" :key="i">
            <div class="rounded-ui border bg-surface-2 border-line p-3 ">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-[11px] text-ink-subtle ">Item <span x-text="i + 1"></span></span>
                    <button type="button" class="text-[11px] text-danger" x-on:click="remove(i)">Remove</button>
                </div>

                <div class="space-y-2">
                    {{ $slot }}
                </div>
            </div>
        </template>

        <button
            type="button"
            class="text-[11px] text-primary-ink hover:text-primary-ink "
            x-on:click="add()"
        >
            + Add item
        </button>
    </div>

    @if($hint)
        <p class="text-[11px] text-ink-subtle ">{{ $hint }}</p>
    @endif
</div>
