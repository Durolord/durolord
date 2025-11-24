<x-layouts.guest :title="'Reset access to Durolord'" :subtitle="'Request a recovery link for your account.'">
    <x-duro.card class="space-y-6" hover="false">
        <div class="space-y-2 text-center">
            <x-duro.badge variant="electric">
                PASSWORD RITE
            </x-duro.badge>
            <h1 class="text-xl font-semibold tracking-tight text-shadow-900 dark:text-neutralfog-50">
                Send a recovery link
            </h1>
            <p class="text-sm text-neutral-600 dark:text-neutralfog-300">
                Enter your email and we will dispatch a reset link forged in light.
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

        <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
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

            <x-duro.button type="submit" class="w-full justify-center">
                Send reset link
            </x-duro.button>
        </form>

        <p class="text-xs text-center text-neutral-600 dark:text-neutralfog-400">
            Remembered your password?
            <a
                href="{{ route('login') }}"
                class="text-electric-700 hover:text-electric-500 dark:text-electric-300 dark:hover:text-electric-200 underline underline-offset-4"
            >
                Return to login
            </a>
        </p>
    </x-duro.card>
</x-layouts.guest>
