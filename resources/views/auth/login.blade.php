<x-layouts.guest :title="'Enter the Durolord Realm'" :subtitle="'Authenticate with your sigil to continue forging worlds.'">
    <x-duro.card class="space-y-6" hover="false">
        <div class="space-y-2 text-center">
            <x-duro.badge variant="electric">
                REALM GATEWAY
            </x-duro.badge>
            <h1 class="text-xl font-semibold tracking-tight text-shadow-900 dark:text-neutralfog-50">
                Welcome back, creator
            </h1>
            <p class="text-sm text-neutral-600 dark:text-neutralfog-300">
                Sign in to access your dashboards, artefacts, and arcane utilities.
            </p>
        </div>

        @if (session('status'))
            <x-duro.alert variant="success">
                {{ session('status') }}
            </x-duro.alert>
        @endif

        @if ($errors->any())
            <x-duro.alert variant="danger">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </x-duro.alert>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <x-duro.input
                name="email"
                type="email"
                label="Email"
                required
                autofocus
                autocomplete="username"
                value="{{ old('email') }}"
            />

            <x-duro.input
                name="password"
                type="password"
                label="Password"
                required
                autocomplete="current-password"
            />

            <div class="flex items-center justify-between text-sm">
                <x-duro.checkbox name="remember" label="Remember me" />

                @if (Route::has('password.request'))
                    <a
                        href="{{ route('password.request') }}"
                        class="text-electric-700 hover:text-electric-500 dark:text-electric-300 dark:hover:text-electric-200 underline underline-offset-4 text-xs"
                    >
                        Forgot access?
                    </a>
                @endif
            </div>

            <x-duro.button type="submit" class="w-full justify-center">
                Enter the realm
            </x-duro.button>
        </form>

        @if (Route::has('register'))
            <p class="text-xs text-center text-neutral-600 dark:text-neutralfog-400">
                New to Durolord?
                <a
                    href="{{ route('register') }}"
                    class="text-gold-600 hover:text-gold-500 dark:text-gold-300 dark:hover:text-gold-200 underline underline-offset-4"
                >
                    Forge your account
                </a>
            </p>
        @endif
    </x-duro.card>
</x-layouts.guest>
