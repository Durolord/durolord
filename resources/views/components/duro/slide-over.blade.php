@props([
    'name',
    'title' => null,
    'description' => null,
    'side' => 'right',
])

<div
    x-data="{ show: false, name: @js($name) }"
    x-on:open-modal.window="if ($event.detail === name || $event.detail?.name === name) show = true"
    x-on:close-modal.window="if (! $event.detail || $event.detail === name) show = false"
    x-on:keydown.escape.window="show = false"
    x-show="show"
    x-cloak
    class="fixed inset-0 z-[70]"
    role="dialog"
    aria-modal="true"
>
    <div x-show="show" x-transition.opacity class="absolute inset-0 bg-black/60 backdrop-blur-sm" x-on:click="show = false"></div>

    <aside
        x-show="show"
        x-trap.inert.noscroll="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="{{ $side === 'left' ? '-translate-x-full' : 'translate-x-full' }}"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-end="{{ $side === 'left' ? '-translate-x-full' : 'translate-x-full' }}"
        {{ $attributes->class([
            'duro-panel absolute inset-y-0 flex w-full max-w-md flex-col !rounded-none',
            'right-0' => $side !== 'left',
            'left-0' => $side === 'left',
        ]) }}
    >
        <header class="flex items-start justify-between gap-4 border-b border-line p-6">
            <div class="space-y-1">
                @if ($title)
                    <h2 class="duro-heading text-xl">{{ $title }}</h2>
                @endif
                @if ($description)
                    <p class="text-sm text-ink-muted">{{ $description }}</p>
                @endif
            </div>
            <button type="button" x-on:click="show = false" class="rounded p-1 text-ink-subtle hover:text-ink" aria-label="Close">
                <x-duro.icon name="x" size="md" />
            </button>
        </header>

        <div class="flex-1 overflow-y-auto p-6">{{ $slot }}</div>

        @isset($footer)
            <footer class="flex items-center justify-end gap-3 border-t border-line p-4">{{ $footer }}</footer>
        @endisset
    </aside>
</div>
