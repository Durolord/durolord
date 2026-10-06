@props([
    'src' => null,
    'name' => '',
    'description' => null,
    'status' => null,
    'initials' => null,
])

<x-duro.table.cell {{ $attributes }}>
    <div class="flex items-center gap-3">
        <x-duro.avatar :name="$name ?: (string) $initials" :src="$src" size="sm" :status="$status" />
        <div class="min-w-0">
            <p class="truncate font-medium text-ink">{{ $name ?: $slot }}</p>
            @if ($description)
                <p class="truncate text-xs text-ink-subtle">{{ $description }}</p>
            @endif
        </div>
    </div>
</x-duro.table.cell>
