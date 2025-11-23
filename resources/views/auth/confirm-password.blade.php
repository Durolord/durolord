<x-layouts.app title="Confirm Password — Durolord Realms">
    <div class="min-h-[calc(100vh-5rem)] flex items-center">
        <section class="container mx-auto px-6 py-16 max-w-md w-full">
            <x-duro.card class="space-y-6">
                <div class="space-y-2 text-center">
                    <x-duro.badge variant="silver">
                        SECURITY RITUAL • CONFIRM
                    </x-duro.badge>

                    <h1 class="text-2xl font-extrabold tracking-tight text-electric-700 dark:text-electric-300">
                        Confirm Your Secret Phrase
                    </h1>
                    <p class="text-xs text-neutral-700 dark:text-neutralfog-300">
                        This is a secure area of the realm. Please confirm your password before continuing.
                    </p>
                </div>

                <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
                    @csrf

                    <x-duro.input
                        name="password"
                        type="password"
                        label="Secret Phrase"
                        required
                        autofocus
                    />

                    <div class="pt-2 flex items-center justify-end">
                        <x-duro.button type="submit">
                            Confirm
                        </x-duro.button>
                    </div>
                </form>
            </x-duro.card>
        </section>
    </div>
</x-layouts.app>
