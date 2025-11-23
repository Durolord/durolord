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

    <div
        class="flex flex-wrap gap-1.5 rounded-xl border px-2 py-1.5 text-sm
               bg-neutralfog-100 border-neutralfog-300
               dark:bg-shadow-950/70 dark:border-shadow-800"
    >
        <template x-for="(tag, i) in tags" :key="tag">
            <span class="inline-flex items-center gap-1 rounded-full bg-electric-500/10 text-electric-700 px-2 py-0.5 text-[11px] dark:bg-electric-500/20 dark:text-electric-300">
                <span x-text="tag"></span>
                <button type="button" class="text-[10px]" x-on:click="removeTag(i)">✕</button>
            </span>
        </template>

        <input
            type="text"
            x-model="input"
            x-on:keydown.enter.prevent="addTag()"
            placeholder="{{ $placeholder }}"
            class="flex-1 min-w-[120px] bg-transparent border-none text-sm focus:outline-none text-neutral-800 dark:text-neutralfog-100 placeholder:text-neutral-400 dark:placeholder:text-neutralfog-400"
        >
    </div>

    <input
        type="hidden"
        x-ref="hidden"
        {{ $attributes->whereDoesntStartWith('class') }}
    >

    @if($hint)
        <p class="text-[11px] text-neutral-500 dark:text-neutralfog-400">{{ $hint }}</p>
    @endif
</div>
