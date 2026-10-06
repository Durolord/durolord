@props([
    'names' => [],
    'max' => 4,
    'size' => 'sm',
])

<div {{ $attributes->class(['flex items-center -space-x-2']) }}>
    @foreach (array_slice($names, 0, $max) as $name)
        <x-duro.avatar :name="$name" :size="$size" />
    @endforeach
    @if (count($names) > $max)
        <span class="duro-avatar size-8 text-[0.65rem]">+{{ count($names) - $max }}</span>
    @endif
</div>
