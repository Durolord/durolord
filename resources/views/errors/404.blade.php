<x-layouts.guest title="404 | {{ config('app.name') }}">
    <div class="text-center space-y-6">
        <div class="flex justify-center">
            <div class="w-20 h-20 rounded-2xl bg-electric-500/10 border border-electric-400/50 text-electric-400 flex items-center justify-center shadow-lg shadow-electric-500/30">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M5 12h14" />
                    <path d="M9 16 5 12l4-4" />
                    <path d="M15 8 19 12l-4 4" />
                </svg>
            </div>
        </div>

        <div class="space-y-2">
            <p class="text-sm uppercase tracking-[0.28em] text-neutralfog-300">404</p>
            <h1 class="text-3xl font-bold text-neutralfog-50">You wandered into the void</h1>
            <p class="text-sm text-neutralfog-300 max-w-xl mx-auto">
                This realm does not exist. Check the path or return to safer ground.
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
