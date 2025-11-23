<?php

// This can stay empty for now; Volt will treat it as a Blade/Volt view.
// If you want Livewire behavior later, you can add state/actions here.

?>

<x-layouts.guest :title="'Sign in to Durolord'" :subtitle="'Enter the realms of code and destiny.'">
    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        {{-- Email --}}
        <div>
            <label class="block text-sm font-medium text-neutral-200">
                Email
            </label>
            <input type="email"
                   name="email"
                   required
                   autofocus
                   autocomplete="username"
                   class="mt-1 block w-full rounded-lg bg-shadow-900/80 border border-neutral-700
                          focus:border-electric-400 focus:ring-2 focus:ring-electric-400/60
                          text-neutral-100 placeholder-neutral-500 text-sm px-3 py-2" />
            @error('email')
                <p class="mt-1 text-xs text-crimson-300">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div>
            <label class="block text-sm font-medium text-neutral-200">
                Password
            </label>
            <input type="password"
                   name="password"
                   required
                   autocomplete="current-password"
                   class="mt-1 block w-full rounded-lg bg-shadow-900/80 border border-neutral-700
                          focus:border-electric-400 focus:ring-2 focus:ring-electric-400/60
                          text-neutral-100 placeholder-neutral-500 text-sm px-3 py-2" />
            @error('password')
                <p class="mt-1 text-xs text-crimson-300">{{ $message }}</p>
            @enderror
        </div>

        {{-- Remember + Forgot --}}
        <div class="flex items-center justify-between text-sm">
            <label class="inline-flex items-center gap-2 text-neutral-300">
                <input type="checkbox" name="remember" class="rounded border-neutral-700 bg-shadow-900/80
                       text-electric-400 focus:ring-electric-400/60">
                <span>Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                   class="text-electric-300 hover:text-electric-200 underline underline-offset-4 text-xs">
                    Forgot password?
                </a>
            @endif
        </div>

        {{-- Submit --}}
        <button type="submit"
                class="w-full inline-flex items-center justify-center px-4 py-2.5 rounded-xl
                       bg-electric-500 text-shadow-950 text-sm font-semibold tracking-wide
                       border border-electric-300 shadow-[0_0_28px_rgba(0,220,255,0.45)]
                       hover:bg-electric-400 hover:border-electric-200 transition">
            Enter the Realm
        </button>

        {{-- Register Link --}}
        @if (Route::has('register'))
            <p class="text-xs text-center text-neutral-300 mt-3">
                New here?
                <a href="{{ route('register') }}"
                   class="text-gold-300 hover:text-gold-200 underline underline-offset-4">
                    Forge your account
                </a>
            </p>
        @endif
    </form>
</x-layouts.guest>
