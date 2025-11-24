<x-layouts.guest :title="'Forge your Durolord account'" :subtitle="'Claim your sigil and join the realm.'">
    <x-duro.card class="space-y-6" hover="false">
        <div class="space-y-2 text-center">
            <x-duro.badge variant="gold">
                NEW SIGIL
            </x-duro.badge>
            <h1 class="text-xl font-semibold tracking-tight text-shadow-900 dark:text-neutralfog-50">
                Create your presence
            </h1>
            <p class="text-sm text-neutral-600 dark:text-neutralfog-300">
                Register to unlock dashboards, data vistas, and arcane utilities.
            </p>
        </div>

        @if ($errors->any())
            <x-duro.alert variant="danger">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </x-duro.alert>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <x-duro.input
                name="name"
                type="text"
                label="Display Name"
                required
                autofocus
                autocomplete="name"
                value="{{ old('name') }}"
            />

            <x-duro.input
                name="email"
                type="email"
                label="Email"
                required
                autocomplete="username"
                value="{{ old('email') }}"
            />

            <x-duro.input
                name="password"
                type="password"
                label="Password"
                required
                autocomplete="new-password"
            />

            <x-duro.input
                name="password_confirmation"
                type="password"
                label="Confirm Password"
                required
                autocomplete="new-password"
            />

            <x-duro.button type="submit" class="w-full justify-center">
                Forge account
            </x-duro.button>
        </form>

        <p class="text-xs text-center text-neutral-600 dark:text-neutralfog-400">
            Already aligned?
            <a
                href="{{ route('login') }}"
                class="text-electric-700 hover:text-electric-500 dark:text-electric-300 dark:hover:text-electric-200 underline underline-offset-4"
            >
                Return to login
            </a>
        </p>
    </x-duro.card>
</x-layouts.guest>
