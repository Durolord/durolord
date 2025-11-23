@props([
    'label' => null,
    'options' => [], // ['value' => 'Label']
    'inline' => false,
])

<div class="space-y-2">
    @if($label)
        <p class="text-xs font-medium tracking-[0.14em] uppercase text-neutral-700 dark:text-neutralfog-300">
            {{ $label }}
        </p>
    @endif

    <div class="{{ $inline ? 'flex flex-wrap gap-3' : 'space-y-1.5' }}">
        @foreach($options as $value => $text)
            <label class="inline-flex items-center gap-2 text-sm cursor-pointer">
                <input
                    type="radio"
                    value="{{ $value }}"
                    {{ $attributes->merge([
                        'class' =>
                            'h-4 w-4 rounded-full border border-neutralfog-300 bg-neutralfog-100
                             text-electric-600 accent-electric-600
                             dark:bg-shadow-950 dark:border-shadow-700 dark:accent-electric-400',
                    ]) }}
                >
                <span class="text-neutral-800 dark:text-neutralfog-100">{{ $text }}</span>
            </label>
        @endforeach
    </div>
</div>
