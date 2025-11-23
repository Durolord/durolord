<!DOCTYPE html>
<html lang="en" class="h-full" x-data="{ darkMode: true }" x-bind:class="darkMode ? 'dark h-full' : 'h-full'">
<head>
    <meta charset="utf-8">
    <title>{{ $title ?? 'Durolord Auth' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-b from-shadow-950 via-shadow-900 to-shadow-950 
             text-neutral-100 antialiased flex items-center justify-center p-4">

    <div class="absolute inset-0 pointer-events-none mix-blend-screen opacity-70">
        {{-- mystical aurora using your oklch palette --}}
        <div class="w-full h-full bg-[radial-gradient(circle_at_top,_oklch(0.82_0.19_85/_0.25),_transparent_65%),_radial-gradient(circle_at_20%_80%,_oklch(0.70_0.15_215/_0.3),_transparent_60%),_radial-gradient(circle_at_80%_60%,_oklch(0.75_0.22_320/_0.25),_transparent_60%)]"></div>
    </div>

    <main class="relative z-10 w-full max-w-md">
        <div class="bg-shadow-950/80 border border-silver-500/20 shadow-xl shadow-black/60
                    rounded-2xl backdrop-blur-lg p-8 space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-xl font-semibold tracking-tight text-electric-300">
                        {{ $title ?? 'Welcome' }}
                    </h1>
                    @isset($subtitle)
                        <p class="mt-1 text-sm text-neutral-300">{{ $subtitle }}</p>
                    @endisset
                </div>

                <button type="button"
                        class="inline-flex items-center justify-center w-9 h-9 rounded-full border border-neutral-700
                               bg-shadow-900/80 text-xs text-neutral-300 hover:border-electric-400 hover:text-electric-200
                               transition"
                        x-on:click="darkMode = !darkMode">
                    <span x-show="darkMode">☾</span>
                    <span x-show="!darkMode">☀</span>
                </button>
            </div>

            {{ $slot }}
        </div>

        <p class="mt-6 text-xs text-center text-neutral-400">
            DUROLORD • Forged in Light and Darkness
        </p>
    </main>
</body>
</html>
