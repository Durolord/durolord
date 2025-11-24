<x-layouts.guest title="Page Expired | {{ config('app.name') }}">
    <div class="text-center space-y-6">
        <div class="flex justify-center">
            <div class="w-20 h-20 rounded-2xl bg-gold-400/10 border border-gold-300/50 text-gold-200 flex items-center justify-center shadow-lg shadow-gold-400/30">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M12 8v4" />
                    <path d="M12 16h.01" />
                    <path d="M12 3a9 9 0 1 0 9 9" />
                </svg>
            </div>
        </div>

        <div class="space-y-2">
            <p class="text-sm uppercase tracking-[0.28em] text-neutralfog-300">419</p>
            <h1 class="text-3xl font-bold text-neutralfog-50">Your session drifted away</h1>
            <p class="text-sm text-neutralfog-300 max-w-xl mx-auto">
                The protective token for this action expired. Refresh to forge a new one and try again.
            </p>
        </div>

        <div class="flex items-center justify-center gap-3">
            <button type="button" onclick="window.location.reload()" class="px-5 py-2.5 rounded-xl bg-electric-500 text-shadow-900 font-semibold shadow-md shadow-electric-500/40 hover:bg-electric-400 transition">
                Refresh and retry
            </button>
            <a href="{{ route('login') }}" class="px-5 py-2.5 rounded-xl border border-neutralfog-400/40 text-neutralfog-100 hover:border-electric-400 hover:text-electric-200 transition">
                Back to sign in
            </a>
        </div>
    </div>
</x-layouts.guest>
