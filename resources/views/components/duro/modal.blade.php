@props([
    'name',
    'title' => null,
    'description' => null,
    'maxWidth' => 'lg',
    'icon' => null,
])

@php
    $width = ['sm' => 'max-w-sm', 'md' => 'max-w-md', 'lg' => 'max-w-lg', 'xl' => 'max-w-xl', '2xl' => 'max-w-2xl', '4xl' => 'max-w-4xl'][$maxWidth] ?? 'max-w-lg';
@endphp

<div
    x-data="{ show: false, name: @js($name) }"
    x-on:open-modal.window="if ($event.detail === name || $event.detail?.name === name) show = true"
    x-on:close-modal.window="if (! $event.detail || $event.detail === name || $event.detail?.name === name) show = false"
    x-on:keydown.escape.window="show = false"
    x-show="show"
    x-cloak
    class="fixed inset-0 z-[70] flex items-end justify-center overflow-y-auto p-4 sm:items-center"
    role="dialog"
    aria-modal="true"
    @if ($title) aria-label="{{ $title }}" @endif
>
    <div x-show="show" x-transition.opacity.duration.250ms class="fixed inset-0 bg-black/60 backdrop-blur-sm" x-on:click="show = false"></div>

    <div
        x-show="show"
        x-trap.inert.noscroll="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-6 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-end="opacity-0 sm:scale-95"
        {{ $attributes->class(['duro-card relative w-full p-6', $width]) }}
    >
        <button type="button" x-on:click="show = false" class="absolute right-4 top-4 z-10 rounded p-1 text-ink-subtle transition hover:text-ink" aria-label="Close">
            <x-duro.icon name="x" size="md" />
        </button>

        @if ($title)
            <div class="mb-5 flex items-start gap-3 pr-8">
                @if ($icon)
                    <span class="duro-icon-tile size-10"><x-duro.icon :name="$icon" size="md" /></span>
                @endif
                <div class="space-y-1">
                    <h2 class="duro-heading text-xl">{{ $title }}</h2>
                    @if ($description)
                        <p class="text-sm text-ink-muted">{{ $description }}</p>
                    @endif
                </div>
            </div>
        @endif

        {{ $slot }}

        @isset($footer)
            <div class="mt-6 flex flex-wrap items-center justify-end gap-3">{{ $footer }}</div>
        @endisset
    </div>
</div>
