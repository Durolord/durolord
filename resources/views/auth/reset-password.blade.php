<x-layouts.guest :title="'Forge a new password'" :subtitle="'Set a fresh key for the Durolord realm.'">
    <x-duro.card class="space-y-6" hover="false">
        <div class="space-y-2 text-center">
            <x-duro.badge variant="electric">
                RESET SIGIL
            </x-duro.badge>
            <h1 class="text-xl font-semibold tracking-tight text-shadow-900 dark:text-neutralfog-50">
                Choose a new password
            </h1>
            <p class="text-sm text-neutral-600 dark:text-neutralfog-300">
                Enter your email, the recovery token, and your new passphrase to regain access.
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

        <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <x-duro.input
                name="email"
                type="email"
                label="Email"
                required
                autocomplete="username"
                value="{{ old('email', $request->email) }}"
            />

            <x-duro.input
                name="password"
                type="password"
                label="New Password"
                required
                autocomplete="new-password"
            />

            <x-duro.input
                name="password_confirmation"
                type="password"
                label="Confirm New Password"
                required
                autocomplete="new-password"
            />

            <x-duro.button type="submit" class="w-full justify-center">
                Reset password
            </x-duro.button>
        </form>
    </x-duro.card>
</x-layouts.guest>
