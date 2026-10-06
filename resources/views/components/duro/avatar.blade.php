@props([
    'name' => '',
    'src' => null,
    'size' => 'md',
    'status' => null,
])

@php
    $dimensions = ['xs' => 'size-6 text-[0.55rem]', 'sm' => 'size-8 text-[0.65rem]', 'md' => 'size-10 text-xs', 'lg' => 'size-14 text-base', 'xl' => 'size-20 text-xl'][$size] ?? 'size-10 text-xs';
    $initials = collect(preg_split('/\s+/', trim($name)))->filter()->take(2)->map(fn ($part) => mb_strtoupper(mb_substr($part, 0, 1)))->join('');
    $statusColor = ['online' => 'bg-success', 'away' => 'bg-warning', 'busy' => 'bg-danger', 'offline' => 'bg-ink-subtle'][$status] ?? null;
@endphp

<span class="relative inline-flex shrink-0">
    <span {{ $attributes->class(['duro-avatar', $dimensions]) }} title="{{ $name }}">
        @if ($src)
            <img src="{{ $src }}" alt="{{ $name }}" class="size-full object-cover">
        @else
            {{ $initials ?: '?' }}
        @endif
    </span>
    @if ($statusColor)
        <span class="absolute -bottom-0.5 -right-0.5 size-3 rounded-full ring-2 ring-surface {{ $statusColor }}"></span>
    @endif
</span>
