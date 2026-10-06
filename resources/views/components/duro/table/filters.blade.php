<div {{ $attributes->class(['flex flex-wrap items-end justify-between gap-3']) }}>
    <div class="flex flex-1 flex-wrap items-end gap-3">
        {{ $slot }}
    </div>
    @isset($actions)
        <div class="flex items-center gap-2">{{ $actions }}</div>
    @endisset
</div>
