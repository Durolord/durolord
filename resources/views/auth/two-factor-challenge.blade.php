<x-layouts.app title="Two-Factor Challenge — Durolord Realms">
    <div class="min-h-[calc(100vh-5rem)] flex items-center">
        <section class="container mx-auto px-6 py-16 max-w-md w-full">
            <x-duro.card class="space-y-6">
                <div class="space-y-2 text-center">
                    <x-duro.badge variant="electric">
                        TWO-FACTOR • SECOND SIGIL
                    </x-duro.badge>

                    <h1 class="text-2xl font-extrabold tracking-tight text-electric-700 dark:text-electric-300">
                        Confirm Second Factor
                    </h1>
                    <p class="text-xs text-neutral-700 dark:text-neutralfog-300">
                        Enter the code from your authenticator app or one of your recovery codes.
                    </p>
                </div>

                @if ($errors->any())
                    <x-duro.alert variant="danger">
                        <ul class="list-disc list-inside text-xs space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </x-duro.alert>
                @endif

                <form method="POST" action="{{ url('/two-factor-challenge') }}" class="space-y-4">
                    @csrf

                    <div x-data="{ recovery: false }" class="space-y-4">
                        <div x-show="!recovery" class="space-y-2">
                            <x-duro.input
                                name="code"
                                inputmode="numeric"
                                label="Authentication Code"
                                autofocus
                            />
                            <p class="text-[11px] text-neutral-600 dark:text-neutralfog-400">
                                Or
                                <button
                                    type="button"
                                    class="underline text-electric-700 dark:text-electric-300"
                                    x-on:click="recovery = true"
                                >
                                    use a recovery code
                                </button>.
                            </p>
                        </div>

                        <div x-show="recovery" class="space-y-2">
                            <x-duro.input
                                name="recovery_code"
                                label="Recovery Code"
                                autofocus
                            />
                            <p class="text-[11px] text-neutral-600 dark:text-neutralfog-400">
                                Or
                                <button
                                    type="button"
                                    class="underline text-electric-700 dark:text-electric-300"
                                    x-on:click="recovery = false"
                                >
                                    use an authentication code
                                </button>.
                            </p>
                        </div>
                    </div>

                    <div class="pt-2 flex items-center justify-end">
                        <x-duro.button type="submit">
                            Confirm Access
                        </x-duro.button>
                    </div>
                </form>
            </x-duro.card>
        </section>
    </div>
</x-layouts.app>
