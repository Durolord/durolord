@props([
    'name' => null,
    'label' => null,
    'hint' => null,
    'rows' => 4,
])

@php
    $errorKey = $name ?? $attributes->wire('model')->value();
    $id = $name ? 'field-'.\Illuminate\Support\Str::slug($name) : null;
    $hasError = $errorKey && $errors->has($errorKey);
@endphp

<div class="space-y-1.5">
    @if ($label)
        <label @if ($id) for="{{ $id }}" @endif class="duro-label">{{ $label }}</label>
    @endif

    <div @class(['duro-field', 'is-invalid' => $hasError])>
        <textarea
            @if ($id) id="{{ $id }}" @endif
            @if ($name) name="{{ $name }}" @endif
            rows="{{ $rows }}"
            {{ $attributes->class(['duro-field-input resize-y leading-relaxed']) }}
        >{{ $slot }}</textarea>
    </div>

    @if ($hasError)
        <p class="duro-error">{{ $errors->first($errorKey) }}</p>
    @elseif ($hint)
        <p class="duro-hint">{{ $hint }}</p>
    @endif
</div>
