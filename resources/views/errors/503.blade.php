<x-layouts.guest title="Be Right Back | {{ config('app.name') }}">
    <div class="text-center space-y-6">
        <div class="flex justify-center">
            <div class="w-20 h-20 rounded-2xl bg-silver-400/10 border border-silver-300/50 text-silver-100 flex items-center justify-center shadow-lg shadow-silver-500/30">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M4 12h1" />
                    <path d="M9 12h1" />
                    <path d="M14 12h1" />
                    <path d="M19 12h1" />
                    <path d="M21 16H3c-1 0-1-1-1-2s0-2 1-2h18c1 0 1 1 1 2s0 2-1 2Z" />
                    <path d="m7 9 5-6 5 6" />
                    <path d="M7 15v4" />
                    <path d="M17 15v4" />
                </svg>
            </div>
        </div>

        <div class="space-y-2">
            <p class="text-sm uppercase tracking-[0.28em] text-neutralfog-300">503</p>
            <h1 class="text-3xl font-bold text-neutralfog-50">The forge is cooling down</h1>
            <p class="text-sm text-neutralfog-300 max-w-xl mx-auto">
                We are performing a quick ritual of maintenance. We will reopen the gate shortly.
            </p>
        </div>

        <div class="flex items-center justify-center gap-3">
            <a href="{{ route('home') }}" class="px-5 py-2.5 rounded-xl bg-electric-500 text-shadow-900 font-semibold shadow-md shadow-electric-500/40 hover:bg-electric-400 transition">
                Return home
            </a>
            <button type="button" onclick="window.location.reload()" class="px-5 py-2.5 rounded-xl border border-neutralfog-400/40 text-neutralfog-100 hover:border-electric-400 hover:text-electric-200 transition">
                Check again
            </button>
        </div>
    </div>
</x-layouts.guest>
