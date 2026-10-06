@props([
    'value' => 0,
    'max' => 100,
    'label' => null,
    'showValue' => true,
])

@php
    $percent = $max > 0 ? max(0, min(100, round(($value / $max) * 100))) : 0;
@endphp

<div {{ $attributes->class(['space-y-1.5']) }}>
    @if ($label || $showValue)
        <div class="flex items-center justify-between text-xs">
            @if ($label)
                <span class="font-medium text-ink-muted">{{ $label }}</span>
            @endif
            @if ($showValue)
                <span class="font-mono text-ink-subtle">{{ $percent }}%</span>
            @endif
        </div>
    @endif
    <div class="duro-progress" role="progressbar" aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100" @if ($label) aria-label="{{ $label }}" @endif>
        <div class="duro-progress-bar" x-data="{ w: 0 }" x-intersect.once="w = {{ $percent }}" :style="`width: ${w}%`" style="width: {{ $percent }}%"></div>
    </div>
</div>
