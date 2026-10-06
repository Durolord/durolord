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
        <label class="duro-label">
            {{ $label }}
        </label>
    @endif

    {{-- Shell --}}
    <div class="rounded-ui border bg-surface-2 border-line
 w-full">

        {{-- Tabs --}}
        <div
            class="flex flex-nowrap items-center text-[11px]
 border-b border-line/80
                   w-full whitespace-nowrap overflow-x-auto
                  "
        >
            <button
                type="button"
                class="px-3 py-1.5 border-b -mb-px transition-colors shrink-0"
                :class="tab === 'write'
 ? 'text-primary-ink  border-primary'
                    : 'text-ink-subtle  border-transparent'"
                x-on:click="tab = 'write'"
            >
                Write
            </button>

            <button
                type="button"
                class="px-3 py-1.5 border-b -mb-px transition-colors shrink-0"
                :class="tab === 'preview'
 ? 'text-primary-ink  border-primary'
                    : 'text-ink-subtle  border-transparent'"
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
                        'block w-full rounded-ui border-0 px-3 py-2 text-sm
                         bg-transparent text-ink placeholder:text-ink-subtle
                         focus:outline-none focus:ring-0
                          ',
                ]) }}
            ></textarea>

            {{-- Preview tab --}}
            <div
                x-show="tab === 'preview'"
                x-cloak
                class="markdown-preview prose prose-sm max-w-none text-ink dark:prose-invert "
                x-html="html"
            ></div>
        </div>
    </div>

    {{-- Hint --}}
    @if($hint)
        <p class="text-[11px] text-ink-subtle ">{{ $hint }}</p>
    @endif
</div>
