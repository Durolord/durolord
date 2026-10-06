@props([
    'label' => null,
    'options' => [],
    'columns' => 2,
])

<fieldset class="space-y-2">
    @if ($label)
        <legend class="duro-label mb-2">{{ $label }}</legend>
    @endif

    <div @class(['grid gap-2', 'sm:grid-cols-2' => $columns >= 2, 'lg:grid-cols-3' => $columns >= 3])>
        @foreach ($options as $value => $text)
            <label class="flex cursor-pointer items-center gap-2.5 rounded-ui border border-line bg-surface-2 px-3 py-2 text-sm text-ink transition hover:border-primary/60 has-[:checked]:border-primary has-[:checked]:bg-primary/10" wire:key="checkbox-list-{{ $value }}">
                <input type="checkbox" value="{{ $value }}" {{ $attributes->class(['duro-check']) }}>
                <span>{{ $text }}</span>
            </label>
        @endforeach
    </div>
</fieldset>
