@props([
    'label' => null,
    'hint' => null,
])

<div
    x-data="markdownEditor(@js($attributes->get('value') ?? ''))"
    class="space-y-1.5 w-full"
>
    {{-- Label --}}
    @if($label)
        <label class="block text-xs font-medium tracking-[0.14em] uppercase text-neutral-700 dark:text-neutralfog-300">
            {{ $label }}
        </label>
    @endif

    {{-- Shell --}}
    <div class="rounded-xl border bg-neutralfog-100 border-neutralfog-300 
                dark:bg-shadow-950/70 dark:border-shadow-800 w-full">

        {{-- Tabs --}}
        <div
            class="flex flex-nowrap items-center text-[11px]
                   border-b border-neutralfog-300/80 dark:border-shadow-800/80
                   w-full whitespace-nowrap overflow-x-auto
                   scrollbar-thin scrollbar-thumb-shadow-800 scrollbar-track-shadow-900/40"
        >
            <button
                type="button"
                class="px-3 py-1.5 border-b -mb-px transition-colors shrink-0"
                :class="tab === 'write'
                    ? 'text-electric-700 dark:text-electric-300 border-electric-500'
                    : 'text-neutral-500 dark:text-neutralfog-400 border-transparent'"
                x-on:click="tab = 'write'"
            >
                Write
            </button>

            <button
                type="button"
                class="px-3 py-1.5 border-b -mb-px transition-colors shrink-0"
                :class="tab === 'preview'
                    ? 'text-electric-700 dark:text-electric-300 border-electric-500'
                    : 'text-neutral-500 dark:text-neutralfog-400 border-transparent'"
                x-on:click="tab = 'preview'"
            >
                Preview
            </button>
        </div>

        {{-- Body --}}
        <div class="p-2">
            {{-- Write tab --}}
            <textarea
                x-show="tab === 'write'"
                x-model="raw"
                x-ref="input"
                {{ $attributes->merge([
                    'class' =>
                        'block w-full rounded-lg border-0 px-3 py-2 text-sm
                         bg-transparent text-shadow-900 placeholder:text-neutral-400
                         focus:outline-none focus:ring-0
                         dark:text-neutralfog-100 dark:placeholder:text-neutralfog-300/70',
                ]) }}
            ></textarea>

            {{-- Preview tab --}}
            <div
                x-show="tab === 'preview'"
                x-cloak
                class="markdown-preview prose prose-sm max-w-none text-neutral-800 dark:prose-invert dark:text-neutralfog-100"
                x-html="html"
            ></div>
        </div>
    </div>

    {{-- Hint --}}
    @if($hint)
        <p class="text-[11px] text-neutral-500 dark:text-neutralfog-400">{{ $hint }}</p>
    @endif
</div>
