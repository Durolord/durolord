@props([
    'label' => null,
    'options' => [],
])

<div class="inline-flex items-center gap-1.5 text-[11px]">
    @if($label)
        <span class="text-neutral-600 dark:text-neutralfog-300">{{ $label }}</span>
    @endif

    <x-duro.select
        {{ $attributes }}
        :options="$options"
        :placeholder="'All'"
    />
</div>