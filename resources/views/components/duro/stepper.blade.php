@props([
    'steps' => [],
    'current' => 1,
])

<ol {{ $attributes->class(['flex w-full items-start']) }}>
    @foreach (array_values($steps) as $index => $step)
        @php
            $number = $index + 1;
            $state = $number < $current ? 'done' : ($number === (int) $current ? 'current' : 'upcoming');
        @endphp
        <li @class(['relative flex flex-1 flex-col items-center gap-2 text-center', 'after:absolute after:left-[calc(50%+1.25rem)] after:right-[calc(-50%+1.25rem)] after:top-4 after:h-0.5 after:rounded-full' => ! $loop->last, 'after:bg-primary' => ! $loop->last && $state === 'done', 'after:bg-line' => ! $loop->last && $state !== 'done'])>
            <span @class([
                'relative z-10 grid size-8 place-items-center rounded-full border-2 text-xs font-bold transition',
                'border-primary bg-primary text-on-primary' => $state === 'done',
                'border-primary bg-surface text-primary-ink shadow-glow' => $state === 'current',
                'border-line bg-surface text-ink-subtle' => $state === 'upcoming',
            ])>
                @if ($state === 'done')
                    <x-duro.icon name="check" class="size-4" stroke="3" />
                @else
                    {{ $number }}
                @endif
            </span>
            <span @class(['text-xs font-semibold', 'text-ink' => $state !== 'upcoming', 'text-ink-subtle' => $state === 'upcoming'])>{{ $step }}</span>
        </li>
    @endforeach
</ol>
