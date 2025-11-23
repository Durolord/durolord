@props([
    'name' => $name,
    'label' => $label,
    'type' => $type ?? 'text',
])

<div class="space-y-1.5">
    @if($label)
        <label for="{{ $name }}" class="block text-xs font-medium tracking-[0.14em] uppercase text-neutral-600 dark:text-neutralfog-300">
            {{ $label }}
        </label>
    @endif

    <input
        id="{{ $name }}"
        name="{{ $name }}"
        type="{{ $type }}"
        {{ $attributes->merge([
            'class' => 'block w-full rounded-xl border px-3 py-2 text-sm placeholder:text-neutral-400
                        bg-neutralfog-100 border-neutralfog-300 text-shadow-900
                        focus:outline-none focus:ring-2 focus:ring-electric-400 focus:border-electric-400
                        dark:bg-shadow-950/70 dark:border-shadow-800 dark:text-neutralfog-100 dark:placeholder:text-neutralfog-300/70',
        ]) }}
    />

    @error($name)
        <p class="text-xs text-red-500 dark:text-red-400 mt-0.5">
            {{ $message }}
        </p>
    @enderror
</div>
