@props([
    'label' => null,
    'hint' => null,
    'blocks' => [], // ['text' => 'Text Block', 'image' => 'Image Block']
])

<div
    x-data="{
        items: [],
        add(type) { this.items.push({ type }); },
        remove(i) { this.items.splice(i, 1); },
    }"
    class="space-y-1.5"
>
    @if($label)
        <p class="text-xs font-medium tracking-[0.14em] uppercase text-neutral-700 dark:text-neutralfog-300">
            {{ $label }}
        </p>
    @endif

    <div class="flex flex-wrap gap-2 text-[11px]">
        @foreach($blocks as $type => $title)
            <button
                type="button"
                class="px-2 py-1 rounded-full border border-neutralfog-300 text-neutral-700 bg-neutralfog-100 hover:border-electric-400 hover:text-electric-700 dark:border-shadow-700 dark:bg-shadow-950 dark:text-neutralfog-200 dark:hover:border-electric-400 dark:hover:text-electric-300"
                x-on:click="add('{{ $type }}')"
            >
                + {{ $title }}
            </button>
        @endforeach
    </div>

    <div class="space-y-3">
        <template x-for="(item, i) in items" :key="i">
            <div class="rounded-xl border bg-neutralfog-100 border-neutralfog-300 p-3 dark:bg-shadow-950/70 dark:border-shadow-800">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-[11px] text-neutral-500 dark:text-neutralfog-400" x-text="item.type"></span>
                    <button type="button" class="text-[11px] text-red-500" x-on:click="remove(i)">Remove</button>
                </div>

                <div class="space-y-2">
                    {{ $slot }}
                </div>
            </div>
        </template>
    </div>

    @if($hint)
        <p class="text-[11px] text-neutral-500 dark:text-neutralfog-400">{{ $hint }}</p>
    @endif
</div>
