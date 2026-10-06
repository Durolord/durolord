@props([
    'label' => null,
    'options' => [],
    'inline' => false,
])

<fieldset class="space-y-2">
    @if ($label)
        <legend class="duro-label mb-2">{{ $label }}</legend>
    @endif

    <div @class(['flex flex-wrap gap-x-5 gap-y-2' => $inline, 'space-y-2' => ! $inline])>
        @foreach ($options as $value => $text)
            <label class="flex cursor-pointer items-center gap-2.5 text-sm text-ink" wire:key="radio-{{ $value }}">
                <input type="radio" value="{{ $value }}" {{ $attributes->class(['duro-check']) }}>
                <span>{{ $text }}</span>
            </label>
        @endforeach
    </div>
</fieldset>
