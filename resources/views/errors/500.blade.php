<x-layouts.guest title="Server Error | {{ config('app.name') }}">
    <div class="text-center space-y-6">
        <div class="flex justify-center">
            <div class="w-20 h-20 rounded-2xl bg-red-400/10 border border-red-300/50 text-red-200 flex items-center justify-center shadow-lg shadow-red-500/30">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z" />
                    <path d="M12 9v4" />
                    <path d="M12 17h.01" />
                </svg>
            </div>
        </div>

        <div class="space-y-2">
            <p class="text-sm uppercase tracking-[0.28em] text-neutralfog-300">500</p>
            <h1 class="text-3xl font-bold text-neutralfog-50">Something went awry</h1>
            <p class="text-sm text-neutralfog-300 max-w-xl mx-auto">
                We hit an unexpected fault in the realm. Try again in a moment or return to the main gate.
            </p>
        </div>

        <div class="flex items-center justify-center gap-3">
            <a href="{{ route('home') }}" class="px-5 py-2.5 rounded-xl bg-electric-500 text-shadow-900 font-semibold shadow-md shadow-electric-500/40 hover:bg-electric-400 transition">
                Return home
            </a>
            <a href="javascript:history.back()" class="px-5 py-2.5 rounded-xl border border-neutralfog-400/40 text-neutralfog-100 hover:border-electric-400 hover:text-electric-200 transition">
                Go back
            </a>
        </div>
    </div>
</x-layouts.guest>
