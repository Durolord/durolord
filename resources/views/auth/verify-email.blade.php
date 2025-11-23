<x-layouts.app title="Verify Email — Durolord Realms">
    <div class="min-h-[calc(100vh-5rem)] flex items-center">
        <section class="container mx-auto px-6 py-16 max-w-md w-full">
            <x-duro.card class="space-y-6">
                <div class="space-y-2 text-center">
                    <x-duro.badge variant="gold">
                        EMAIL RITE • VERIFICATION
                    </x-duro.badge>

                    <h1 class="text-2xl font-extrabold tracking-tight text-electric-700 dark:text-electric-300">
                        Confirm Your Sigil
                    </h1>
                    <p class="text-xs text-neutral-700 dark:text-neutralfog-300">
                        Before continuing, please verify your email address. We’ve sent you a link.
                    </p>
                </div>

                @if (session('status') == 'verification-link-sent')
                    <x-duro.alert variant="success">
                        A new verification link has been sent to your email address.
                    </x-duro.alert>
                @endif

                <form method="POST" action="{{ route('verification.send') }}" class="flex items-center justify-between gap-2 text-xs">
                    @csrf

                    <span class="text-neutral-600 dark:text-neutralfog-400">
                        Didn’t receive the email?
                    </span>

                    <x-duro.button type="submit">
                        Resend Link
                    </x-duro.button>
                </form>

                <form method="POST" action="{{ route('logout') }}" class="pt-2 text-center">
                    @csrf
                    <button
                        type="submit"
                        class="text-[11px] text-neutral-600 dark:text-neutralfog-400 hover:underline"
                    >
                        Log out
                    </button>
                </form>
            </x-duro.card>
        </section>
    </div>
</x-layouts.app>
