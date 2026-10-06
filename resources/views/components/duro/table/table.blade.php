@props([
    'title' => null,
    'description' => null,
    'striped' => false,
])

<div {{ $attributes->class(['space-y-4']) }}>
    @if ($title || $description || isset($actions))
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div class="space-y-1">
                @if ($title)
                    <h2 class="duro-heading text-lg">{{ $title }}</h2>
                @endif
                @if ($description)
                    <p class="text-sm text-ink-muted">{{ $description }}</p>
                @endif
            </div>
            @isset($actions)
                <div class="flex flex-wrap gap-2">{{ $actions }}</div>
            @endisset
        </div>
    @endif

    <div class="duro-table-wrap">
        @isset($toolbar)
            <div class="border-b border-line bg-surface-2/50 p-3">{{ $toolbar }}</div>
        @endisset
        <div class="overflow-x-auto">
            <table @class(['duro-table', 'duro-table-striped' => $striped])>
                {{ $slot }}
            </table>
        </div>
        @isset($footer)
            <div class="border-t border-line px-4 py-3">{{ $footer }}</div>
        @endisset
    </div>
</div>
