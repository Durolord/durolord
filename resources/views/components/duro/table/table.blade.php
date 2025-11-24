@props([
    'title' => null,
    'description' => null,
    'actions' => null,
])

<div class="space-y-4">
    @if($title || $description || $actions)
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div class="space-y-1">
                @if($title)
                    <h2 class="text-sm font-semibold text-shadow-900 dark:text-neutralfog-50">
                        {{ $title }}
                    </h2>
                @endif
                @if($description)
                    <p class="text-xs text-neutral-600 dark:text-neutralfog-400">
                        {{ $description }}
                    </p>
                @endif
            </div>

            @if($actions)
                <div class="flex flex-wrap gap-2">
                    {{ $actions }}
                </div>
            @endif
        </div>
    @endif

    <div class="overflow-hidden rounded-2xl border border-neutralfog-300/80 bg-neutralfog-100/80
                dark:border-shadow-800 dark:bg-shadow-950/80">
        <div class="overflow-x-auto">
            <table class="min-w-full border-separate border-spacing-0 text-sm">
                {{ $slot }}
            </table>
        </div>
    </div>
</div>