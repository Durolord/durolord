@props([
    'title',
    'description' => null,
    'id' => null,
])

@php
    $id ??= \Illuminate\Support\Str::slug($title);
    $source = isset($code) ? trim(preg_replace('/^\R+|\R+$/', '', (string) $code)) : null;
    if ($source !== null) {
        $lines = preg_split('/\R/', $source);
        $indent = collect($lines)->filter(fn ($line) => trim($line) !== '')->map(fn ($line) => strlen($line) - strlen(ltrim($line)))->min() ?? 0;
        $source = collect($lines)->map(fn ($line) => substr($line, $indent))->join("\n");
    }
@endphp

<section id="{{ $id }}" class="scroll-mt-24 space-y-4" x-data="{ view: 'preview' }" data-reveal>
    <div class="flex flex-wrap items-end justify-between gap-3">
        <div class="space-y-1">
            <h2 class="duro-heading text-xl">
                <a href="#{{ $id }}" class="group inline-flex items-center gap-2">
                    {{ $title }}
                    <span class="text-ink-subtle opacity-0 transition group-hover:opacity-100">#</span>
                </a>
            </h2>
            @if ($description)
                <p class="max-w-2xl text-sm text-ink-muted">{{ $description }}</p>
            @endif
        </div>

        @if ($source)
            <div class="duro-tabs !p-0.5" role="tablist">
                <button type="button" class="duro-tab !px-3 !py-1 !text-xs" x-on:click="view = 'preview'" :aria-selected="(view === 'preview').toString()">Preview</button>
                <button type="button" class="duro-tab !px-3 !py-1 !text-xs" x-on:click="view = 'code'" :aria-selected="(view === 'code').toString()">Code</button>
            </div>
        @endif
    </div>

    <div x-show="view === 'preview'" {{ $attributes->class(['duro-card p-6 sm:p-8']) }}>
        {{ $slot }}
    </div>

    @if ($source)
        <div x-show="view === 'code'" x-cloak class="duro-code relative overflow-hidden">
            <button type="button" x-copy="@js($source)" class="absolute right-3 top-3 inline-flex items-center gap-1.5 rounded border border-white/15 bg-white/5 px-2 py-1 text-[0.68rem] text-white/80 transition hover:bg-white/10">
                <x-duro.icon name="copy" class="size-3" /> Copy
            </button>
            <pre class="overflow-x-auto p-5 pr-20"><code>{{ $source }}</code></pre>
        </div>
    @endif
</section>
