@props([
    'name' => null,
    'label' => null,
    'type' => 'text',
    'hint' => null,
    'icon' => null,
    'prefix' => null,
    'suffix' => null,
    'id' => null,
])

@php
    $errorKey = $name ?? $attributes->wire('model')->value();
    $id ??= $name ? 'field-'.\Illuminate\Support\Str::slug($name) : null;
    $label = $label === false ? null : ($label ?? ($name ? \Illuminate\Support\Str::headline($name) : null));
    $hasError = $errorKey && $errors->has($errorKey);
    $isPassword = $type === 'password';
@endphp

<div class="space-y-1.5" @if ($isPassword) x-data="{ reveal: false }" @endif>
    @if ($label)
        <label @if ($id) for="{{ $id }}" @endif class="duro-label">{{ $label }}</label>
    @endif

    <div @class(['duro-field', 'is-invalid' => $hasError])>
        @if ($icon)
            <span class="duro-field-affix"><x-duro.icon :name="$icon" /></span>
        @elseif ($prefix)
            <span class="duro-field-affix">{{ $prefix }}</span>
        @endif

        <input
            @if ($id) id="{{ $id }}" @endif
            @if ($name) name="{{ $name }}" @endif
            type="{{ $type }}"
            @if ($isPassword) x-bind:type="reveal ? 'text' : 'password'" @endif
            @if ($hasError) aria-invalid="true" @endif
            {{ $attributes->class(['duro-field-input']) }}
        />

        @if ($isPassword)
            <button type="button" x-on:click="reveal = ! reveal" class="duro-field-affix transition hover:text-ink" :aria-label="reveal ? 'Hide password' : 'Show password'">
                <x-duro.icon name="eye" />
            </button>
        @elseif ($suffix)
            <span class="duro-field-affix">{{ $suffix }}</span>
        @endif
    </div>

    @if ($hasError)
        <p class="duro-error">{{ $errors->first($errorKey) }}</p>
    @elseif ($hint)
        <p class="duro-hint">{{ $hint }}</p>
    @endif
</div>
