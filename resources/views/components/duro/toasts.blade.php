<div
    x-data
    class="pointer-events-none fixed inset-x-0 bottom-0 z-[90] flex flex-col items-center gap-3 p-4 sm:items-end sm:p-6"
    aria-live="polite"
>
    <template x-for="toast in $store.toasts.items" :key="toast.id">
        <div
            class="duro-alert pointer-events-auto w-full max-w-sm shadow-pop"
            :class="'duro-alert-' + toast.variant"
            style="animation: duro-toast-in 0.35s cubic-bezier(0.22, 1, 0.36, 1)"
            role="status"
        >
            <span class="duro-alert-icon mt-0.5">
                <x-duro.icon name="check-circle" size="md" x-show="toast.variant === 'success'" />
                <x-duro.icon name="info" size="md" x-show="toast.variant === 'info'" />
                <x-duro.icon name="alert-triangle" size="md" x-show="toast.variant === 'warning'" />
                <x-duro.icon name="x-circle" size="md" x-show="toast.variant === 'danger'" />
            </span>
            <div class="min-w-0 flex-1">
                <p class="font-semibold leading-snug" x-text="toast.title"></p>
                <p class="mt-0.5 text-[0.8rem] text-ink-muted" x-show="toast.body" x-text="toast.body"></p>
            </div>
            <button type="button" x-on:click="$store.toasts.dismiss(toast.id)" class="-m-1 rounded p-1 text-ink-subtle hover:text-ink" aria-label="Dismiss">
                <x-duro.icon name="x" />
            </button>
        </div>
    </template>
</div>
