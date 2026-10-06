@props([
    'label' => null,
    'hint' => null,
    'language' => 'php',
])

<div class="space-y-1.5" x-data>
    @if($label)
        <label class="duro-label">
            {{ $label }}
        </label>
    @endif

    <div
        class="rounded-ui border bg-surface-3/90 border-line text-[11px] font-mono text-ink overflow-hidden"
    >
        <div class="flex items-center gap-2 px-3 py-1.5 border-b border-line/80 bg-surface-3/90">
            <span class="inline-flex gap-1">
                <span class="h-2 w-2 rounded-full bg-danger/80"></span>
                <span class="h-2 w-2 rounded-full bg-yellow-500/80"></span>
                <span class="h-2 w-2 rounded-full bg-green-500/80"></span>
            </span>
            <span class="text-[10px] uppercase tracking-[0.16em] text-ink/80">
                {{ strtoupper($language) }} • Code editor
            </span>
        </div>

        <textarea
            {{ $attributes->merge([
                'class' =>
                    'block w-full min-h-[180px] border-0 bg-transparent px-3 py-2 text-[11px] leading-relaxed
                     focus:outline-none focus:ring-0
                     text-ink font-mono',
            ]) }}
            data-duro-code-editor="{{ $language }}"
        ></textarea>
    </div>

    @if($hint)
        <p class="text-[11px] text-ink-subtle ">{{ $hint }}</p>
    @endif
</div>
