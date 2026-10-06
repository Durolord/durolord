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
        <p class="duro-label">
            {{ $label }}
        </p>
    @endif

    <div class="flex flex-wrap gap-2 text-[11px]">
        @foreach($blocks as $type => $title)
            <button
                type="button"
                class="px-2 py-1 rounded-full border border-line text-ink-muted bg-surface-2 hover:border-primary hover:text-primary-ink "
                x-on:click="add('{{ $type }}')"
            >
                + {{ $title }}
            </button>
        @endforeach
    </div>

    <div class="space-y-3">
        <template x-for="(item, i) in items" :key="i">
            <div class="rounded-ui border bg-surface-2 border-line p-3 ">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-[11px] text-ink-subtle " x-text="item.type"></span>
                    <button type="button" class="text-[11px] text-danger" x-on:click="remove(i)">Remove</button>
                </div>

                <div class="space-y-2">
                    {{ $slot }}
                </div>
            </div>
        </template>
    </div>

    @if($hint)
        <p class="text-[11px] text-ink-subtle ">{{ $hint }}</p>
    @endif
</div>
