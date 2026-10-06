@props([
    'title',
    'open' => false,
])

<div x-data="{ id: $id('accordion'), expanded: @js((bool) $open) }" {{ $attributes }}>
    <h3>
        <button
            type="button"
            x-on:click="expanded = ! expanded"
            :aria-expanded="expanded.toString()"
            :aria-controls="id"
            class="group flex w-full items-center justify-between gap-4 px-5 py-4 text-left text-[0.95rem] font-semibold text-ink transition hover:bg-primary/5"
        >
            <span>{{ $title }}</span>
            <span class="grid size-7 shrink-0 place-items-center rounded-ui border border-line text-ink-subtle transition group-hover:border-primary group-hover:text-primary-ink" :class="expanded && 'rotate-45 !border-primary !text-primary-ink'">
                <x-duro.icon name="plus" class="size-3.5" />
            </span>
        </button>
    </h3>
    <div x-show="expanded" x-collapse x-cloak :id="id">
        <div class="px-5 pb-5 text-sm leading-relaxed text-ink-muted">{{ $slot }}</div>
    </div>
</div>
