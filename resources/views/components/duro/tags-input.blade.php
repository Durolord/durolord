@props([
    'label' => null,
    'hint' => null,
    'placeholder' => 'Add tag and press Enter',
])

<div
    x-data="{
        tags: @js($attributes->get('value') ? explode(',', $attributes->get('value')) : []),
        input: '',
        addTag() {
            const val = this.input.trim();
            if (!val || this.tags.includes(val)) return;
            this.tags.push(val);
            this.input = '';
            this.updateHidden();
        },
        removeTag(i) {
            this.tags.splice(i, 1);
            this.updateHidden();
        },
        updateHidden() {
            $refs.hidden.value = this.tags.join(',');
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

    <div
        class="flex flex-wrap gap-1.5 rounded-ui border px-2 py-1.5 text-sm
 bg-surface-2 border-line
                "
    >
        <template x-for="(tag, i) in tags" :key="tag">
            <span class="inline-flex items-center gap-1 rounded-full bg-primary/10 text-primary-ink px-2 py-0.5 text-[11px] ">
                <span x-text="tag"></span>
                <button type="button" class="text-[10px]" x-on:click="removeTag(i)">✕</button>
            </span>
        </template>

        <input
            type="text"
            x-model="input"
            x-on:keydown.enter.prevent="addTag()"
            placeholder="{{ $placeholder }}"
            class="flex-1 min-w-[120px] bg-transparent border-none text-sm focus:outline-none text-ink placeholder:text-ink-subtle "
        >
    </div>

    <input
        type="hidden"
        x-ref="hidden"
        {{ $attributes->whereDoesntStartWith('class') }}
    >

    @if($hint)
        <p class="text-[11px] text-ink-subtle ">{{ $hint }}</p>
    @endif
</div>
