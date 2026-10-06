<x-layouts.app title="Dashboard — Digital Realms">
    <div class="min-h-[calc(100vh-5rem)] flex items-center">
        <section class="container mx-auto px-6 py-16 space-y-4">
            <x-duro.card class="space-y-3">
                <h1 class="text-2xl font-bold text-electric-700 dark:text-electric-300">
                    Welcome back, {{ auth()->user()->name ?? 'Traveler' }}
                </h1>
                <p class="text-sm text-neutral-700 dark:text-neutralfog-300">
                    This is your starting point for HRMS, CMS, and tracker realms.
                </p>
            </x-duro.card>
        </section>
    </div>
</x-layouts.app>
