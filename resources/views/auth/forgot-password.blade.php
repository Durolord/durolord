<x-layouts.guest :title="'Reset access to Durolord'" :subtitle="'Request a recovery link for your account.'">
    <x-duro.card class="space-y-6" hover="false">
        <div class="space-y-2 text-center">
            <x-duro.badge variant="electric">
                PASSWORD RITE
            </x-duro.badge>
            <h1 class="duro-heading text-2xl">
                Send a recovery link
            </h1>
            <p class="text-sm text-ink-muted">
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

        <p class="text-xs text-center text-ink-muted">
            Remembered your password?
            <a
                href="{{ route('login') }}"
                class="text-primary-ink hover:text-primary-ink underline underline-offset-4"
            >
                Return to login
            </a>
        </p>
    </x-duro.card>
</x-layouts.guest>
