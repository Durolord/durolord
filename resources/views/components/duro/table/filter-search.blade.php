@props(['placeholder' => 'Search…'])

<div class="min-w-56 flex-1">
    <x-duro.input :label="false" icon="search" :placeholder="$placeholder" {{ $attributes }} />
</div>
