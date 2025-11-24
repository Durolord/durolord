<div class="flex flex-wrap items-center justify-between gap-3 px-3 py-2.5">
    <div class="flex flex-wrap items-center gap-2.5">
        {{ $slot }}
    </div>

    @if(isset($actions))
        <div class="flex items-center gap-2">
            {{ $actions }}
        </div>
    @endif
</div>