@props([
    'length' => 6,
    'label' => null,
])

<div
    x-data="{
        digits: Array({{ (int) $length }}).fill(''),
        value: '',
        sync() { this.value = this.digits.join(''); },
        input(index, event) {
            const char = event.target.value.replace(/\D/g, '').slice(-1);
            this.digits[index] = char;
            this.sync();
            if (char && index < this.digits.length - 1) { this.$refs['d' + (index + 1)].focus(); }
        },
        back(index, event) {
            if (! this.digits[index] && index > 0) { this.$refs['d' + (index - 1)].focus(); }
        },
        paste(event) {
            const text = (event.clipboardData.getData('text') || '').replace(/\D/g, '').slice(0, this.digits.length);
            text.split('').forEach((c, i) => this.digits[i] = c);
            this.sync();
            this.$refs['d' + Math.min(text.length, this.digits.length - 1)]?.focus();
        },
    }"
    x-modelable="value"
    {{ $attributes->whereStartsWith('wire:model') }}
    class="space-y-1.5"
>
    @if ($label)
        <p class="duro-label">{{ $label }}</p>
    @endif
    <div class="flex gap-2" x-on:paste.prevent="paste($event)">
        @for ($i = 0; $i < $length; $i++)
            <input
                type="text"
                inputmode="numeric"
                maxlength="1"
                autocomplete="one-time-code"
                x-ref="d{{ $i }}"
                :value="digits[{{ $i }}]"
                x-on:input="input({{ $i }}, $event)"
                x-on:keydown.backspace="back({{ $i }}, $event)"
                class="duro-control size-11 !p-0 text-center font-mono text-lg font-bold sm:size-12"
                aria-label="Digit {{ $i + 1 }}"
            >
        @endfor
    </div>
</div>
