<x-layouts.app title="Two-Factor Challenge | Durolord Realms">
    <div class="min-h-[calc(100vh-5rem)] flex items-center">
        <section class="container mx-auto px-6 py-16 max-w-md w-full">
            <x-duro.card class="space-y-6">
                <div x-data="{ recovery: false }" x-cloak class="space-y-6">
                    <div class="space-y-2 text-center">
                        <x-duro.badge variant="electric">
                            TWO-FACTOR AUTHENTICATION
                        </x-duro.badge>

                        <h1 class="text-2xl font-extrabold tracking-tight text-primary-ink">
                            Verify your second factor
                        </h1>

                        <p
                            class="text-xs text-ink-muted"
                            x-show="! recovery"
                        >
                            {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
                        </p>

                        <p
                            class="text-xs text-ink-muted"
                            x-show="recovery"
                        >
                            {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
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
                        <input type="hidden" name="remember" value="{{ old('remember', session('login.remember') ? '1' : '') }}">

                        <div x-show="! recovery" class="space-y-2">
                            <x-duro.input
                                name="code"
                                label="Code"
                                inputmode="numeric"
                                autocomplete="one-time-code"
                                x-ref="code"
                                required
                                autofocus
                            />

                            <p class="text-[11px] text-ink-muted">
                                <button
                                    type="button"
                                    class="text-xs text-primary-ink underline cursor-pointer"
                                    x-on:click="
                                        recovery = true;
                                        $nextTick(() => { $refs.recovery_code.focus() })
"
                                >
                                    {{ __('Use a recovery code') }}
                                </button>
                            </p>
                        </div>

                        <div x-show="recovery" class="space-y-2">
                            <x-duro.input
                                name="recovery_code"
                                label="Recovery Code"
                                autocomplete="one-time-code"
                                x-ref="recovery_code"
                                required
                                autofocus
                            />

                            <p class="text-[11px] text-ink-muted">
                                <button
                                    type="button"
                                    class="text-xs text-primary-ink underline cursor-pointer"
                                    x-on:click="
                                        recovery = false;
                                        $nextTick(() => { $refs.code.focus() })
"
                                >
                                    {{ __('Use an authentication code') }}
                                </button>
                            </p>
                        </div>

                        <div class="pt-2 flex items-center justify-end">
                            <x-duro.button type="submit">
                                {{ __('Login') }}
                            </x-duro.button>
                        </div>
                    </form>
                </div>
            </x-duro.card>
        </section>
    </div>
</x-layouts.app>
