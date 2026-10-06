@props(['items' => []])

<nav aria-label="Breadcrumb" {{ $attributes }}>
    <ol class="flex flex-wrap items-center gap-1.5 text-xs text-ink-subtle">
        @foreach ($items as $label => $url)
            <li class="flex items-center gap-1.5">
                @if (! $loop->first)
                    <x-duro.icon name="chevron-right" class="size-3 opacity-60" />
                @endif
                @if ($url && ! $loop->last)
                    <a href="{{ $url }}" class="transition hover:text-primary-ink">{{ $label }}</a>
                @else
                    <span @class(['font-medium text-ink' => $loop->last]) @if ($loop->last) aria-current="page" @endif>{{ $label }}</span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
