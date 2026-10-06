<x-layouts.app title="Verify Email | Durolord Realms">
    <div class="min-h-[calc(100vh-5rem)] flex items-center">
        <section class="container mx-auto px-6 py-16 max-w-md w-full">
            <x-duro.card class="space-y-6">
                <div class="space-y-2 text-center">
                    <x-duro.badge variant="gold">
                        EMAIL RITE · VERIFICATION
                    </x-duro.badge>

                    <h1 class="text-2xl font-extrabold tracking-tight text-primary-ink">
                        Confirm your sigil
                    </h1>
                    <p class="text-xs text-ink-muted">
                        Before continuing, please verify your email address. We have sent you a verification link.
                    </p>
                </div>

                @if (session('status') === 'verification-link-sent')
                    <x-duro.alert variant="success">
                        A new verification link has been dispatched to your email address.
                    </x-duro.alert>
                @endif

                <form method="POST" action="{{ route('verification.send') }}" class="flex items-center justify-between gap-2 text-xs">
                    @csrf

                    <span class="text-ink-muted">
                        Didn't receive the email?
                    </span>

                    <x-duro.button type="submit">
                        Resend link
                    </x-duro.button>
                </form>

                <form method="POST" action="{{ route('logout') }}" class="pt-2 text-center">
                    @csrf
                    <button
                        type="submit"
                        class="text-[11px] text-ink-muted hover:underline"
                    >
                        Log out
                    </button>
                </form>
            </x-duro.card>
        </section>
    </div>
</x-layouts.app>
