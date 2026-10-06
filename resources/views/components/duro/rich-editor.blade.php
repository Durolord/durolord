@props([
    'label' => null,
    'hint' => null,
])

<div
    x-data="duroTipTapLite(@js($attributes->get('value') ?? ''))"
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

        {{-- Toolbar (fixed width, scrollable buttons) --}}
        <div
            class="flex flex-nowrap items-center gap-1 px-2 py-1.5
 border-b border-line/80
                   text-[11px] w-full whitespace-nowrap overflow-x-auto
                  "
        >
            {{-- Left group: marks --}}
            <button type="button"
                x-on:click="command('bold')"
                class="duro-editor-btn shrink-0"
                :class="isActive('bold') && 'duro-editor-btn-active'"
                x-tooltip="'Bold (**text**)'"
            >B</button>

            <button type="button"
                x-on:click="command('italic')"
                class="duro-editor-btn shrink-0"
                :class="isActive('italic') && 'duro-editor-btn-active'"
                x-tooltip="'Italic (*text*)'"
            ><span class="italic">I</span></button>

            <button type="button"
                x-on:click="command('underline')"
                class="duro-editor-btn shrink-0"
                :class="isActive('underline') && 'duro-editor-btn-active'"
                x-tooltip="'Underline (__text__)'"
            ><span class="underline">U</span></button>

            {{-- Middle divider --}}
            <div class="h-4 w-px mx-1 bg-surface-3 shrink-0"></div>

            {{-- Headings --}}
            <button type="button"
                x-on:click="setBlock('h1')"
                class="duro-editor-btn shrink-0"
                x-tooltip="'Heading 1'"
            >H1</button>

            <button type="button"
                x-on:click="setBlock('h2')"
                class="duro-editor-btn shrink-0"
                x-tooltip="'Heading 2'"
            >H2</button>

            <button type="button"
                x-on:click="setBlock('p')"
                class="duro-editor-btn shrink-0"
                x-tooltip="'Paragraph'"
            >P</button>

            {{-- Lists --}}
            <button type="button"
                x-on:click="toggleList('unordered')"
                class="duro-editor-btn shrink-0"
                x-tooltip="'Bullet list'"
            >••</button>

            <button type="button"
                x-on:click="toggleList('ordered')"
                class="duro-editor-btn shrink-0"
                x-tooltip="'Numbered list'"
            >1.</button>

            {{-- Quote --}}
            <button type="button"
                x-on:click="setBlock('blockquote')"
                class="duro-editor-btn shrink-0"
                x-tooltip="'Quote block'"
            >“”</button>

            {{-- Code --}}
            <button type="button"
                x-on:click="setBlock('pre')"
                class="duro-editor-btn shrink-0"
                x-tooltip="'Code block'"
            >&lt;/&gt;</button>

            {{-- Right side label --}}
            <span class="ml-auto text-[10px] opacity-60 text-ink-subtle shrink-0">
                Duro TipTap-style
            </span>
        </div>

        {{-- Editor body --}}
        <div class="p-2">
            <div
                x-ref="editor"
                contenteditable="true"
                class="duro-editor-content w-full"
                data-placeholder="{{ $attributes->get('placeholder') ?? 'Start writing…' }}"
                x-on:input="sync()"
                x-on:blur="sync()"
                x-on:keydown.meta.s.prevent="sync()"
            ></div>

            {{-- Hidden Livewire binding --}}
            <textarea
                x-ref="hidden"
                x-model="raw"
                class="hidden"
                {{ $attributes->merge(['class' => '']) }}
            ></textarea>
        </div>
    </div>

    {{-- Hint --}}
    @if($hint)
        <p class="text-[11px] text-ink-subtle ">{{ $hint }}</p>
    @endif
</div>
