@props(['name'])

<div
    x-show="tab === @js($name)"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 translate-y-1"
    x-transition:enter-end="opacity-100 translate-y-0"
    role="tabpanel"
    {{ $attributes }}
>
    {{ $slot }}
</div>
