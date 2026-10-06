@php
    use Illuminate\Support\Str;
    use Laravel\Fortify\Features;
    use Laravel\Fortify\Fortify;

    $user = auth()->user();
    $status = session('status');
    $twoFactorEnabled = $user?->hasEnabledTwoFactorAuthentication();
    $twoFactorConfirmed = ! is_null($user?->two_factor_confirmed_at);
    $recoveryCodes = $user && $user->two_factor_recovery_codes ? $user->recoveryCodes() : [];
    $requiresConfirmation = Features::optionEnabled(Features::twoFactorAuthentication(), 'confirm');
    $sessions = $sessions ?? collect();

    $setupKey = null;

    if ($user && $user->two_factor_secret) {
        try {
            $setupKey = data_get(decrypt($user->two_factor_secret), 'secret');
        } catch (\Throwable) {
            $setupKey = null;
        }
    }
@endphp

<x-layouts.app title="Profile">
    <section class="space-y-6">
        <div class="flex flex-col gap-2">
            <x-duro.badge variant="electric" class="w-max">
                Profile
            </x-duro.badge>
            <h1 class="duro-heading text-3xl">
                Profile, password, and two-factor protection
            </h1>
            <p class="text-sm text-ink-muted">
                Keep your realm identity current, lock down your password, safeguard access with two-factor authentication, and manage your active sessions.
            </p>
        </div>

        <div class="grid gap-6 lg:grid-cols-2">
            {{-- Profile information --}}
            <x-duro.card class="space-y-4">
                <div class="flex items-center justify-between gap-2">
                    <div>
                        <h2 class="text-lg font-semibold text-ink">
                            Profile information
                        </h2>
                        <p class="text-sm text-ink-muted">
                            Update your display name and contact email.
                        </p>
                    </div>

                    @if ($status === Fortify::PROFILE_INFORMATION_UPDATED)
                        <x-duro.badge variant="electric">
                            Saved
                        </x-duro.badge>
                    @endif
                </div>

                @if ($errors->updateProfileInformation->any())
                    <x-duro.alert variant="danger">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->updateProfileInformation->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </x-duro.alert>
                @endif

                <form method="POST" action="{{ route('user-profile-information.update') }}" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <x-duro.input
                        name="name"
                        label="Name"
                        value="{{ old('name', $user?->name) }}"
                        required
                        autocomplete="name"
                    />

                    <x-duro.input
                        name="email"
                        type="email"
                        label="Email"
                        value="{{ old('email', $user?->email) }}"
                        required
                        autocomplete="email"
                    />

                    <div class="flex items-center justify-end gap-3">
                        <x-duro.button type="submit" class="px-5">
                            Save profile
                        </x-duro.button>
                    </div>
                </form>
            </x-duro.card>

            {{-- Password update --}}
            <x-duro.card class="space-y-4">
                <div class="flex items-center justify-between gap-2">
                    <div>
                        <h2 class="text-lg font-semibold text-ink">
                            Password
                        </h2>
                        <p class="text-sm text-ink-muted">
                            Choose a strong passphrase to protect your realm.
                        </p>
                    </div>

                    @if ($status === Fortify::PASSWORD_UPDATED)
                        <x-duro.badge variant="electric">
                            Updated
                        </x-duro.badge>
                    @endif
                </div>

                @if ($errors->updatePassword->any())
                    <x-duro.alert variant="danger">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->updatePassword->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </x-duro.alert>
                @endif

                <form method="POST" action="{{ route('user-password.update') }}" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <x-duro.input
                        name="current_password"
                        type="password"
                        label="Current password"
                        required
                        autocomplete="password"
                    />

                    <x-duro.input
                        name="password"
                        type="password"
                        label="New password"
                        required
                        autocomplete="new-password"
                    />

                    <x-duro.input
                        name="password_confirmation"
                        type="password"
                        label="Confirm new password"
                        required
                        autocomplete="new-password"
                    />

                    <div class="flex items-center justify-end gap-3">
                        <x-duro.button type="submit" class="px-5">
                            Update password
                        </x-duro.button>
                    </div>
                </form>
            </x-duro.card>
        </div>

        {{-- Sessions --}}
        <x-duro.card class="space-y-4">
            <div class="flex items-center justify-between gap-2">
                <div>
                    <h2 class="text-lg font-semibold text-ink">
                        Active sessions
                    </h2>
                    <p class="text-sm text-ink-muted">
                        View devices logged in to your account and sign out everywhere else.
                    </p>
                </div>

                @if ($status === 'sessions-terminated')
                    <x-duro.badge variant="electric">
                        Sessions cleared
                    </x-duro.badge>
                @endif
            </div>

            @if ($errors->logoutOtherSessions?->any())
                <x-duro.alert variant="danger">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->logoutOtherSessions->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </x-duro.alert>
            @endif

            @if ($status === 'sessions-terminated')
                <x-duro.alert variant="success">
                    Signed out from all other sessions.
                </x-duro.alert>
            @endif

            @if ($sessions->isNotEmpty())
                <div class="space-y-3 rounded-ui border border-line/70 bg-surface/60 p-4">
                    @foreach ($sessions as $session)
                        @php
                            $iconClasses = $session['is_current_device']
                                ? 'text-primary-ink '
                                : 'text-ink-subtle ';
                        @endphp
                        <div class="flex items-start justify-between gap-3 border-b border-line/60 pb-3 last:border-0 last:pb-0">
                            <div class="flex gap-3">
                                <div class="mt-0.5">
                                    <x-duro.icons.desktop class="h-5 w-5 {{ $iconClasses }}" />
                                </div>
                                <div class="space-y-1">
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm font-semibold text-ink">
                                            {{ $session['is_current_device'] ? 'This device' : 'Other device' }}
                                        </span>
                                        <span class="rounded-full bg-primary/10 px-2 py-0.5 text-[11px] font-semibold text-primary-ink">
                                            {{ $session['ip_address'] ?: 'Unknown IP' }}
                                        </span>
                                    </div>
                                    <p class="text-xs text-ink-muted">
                                        {{ Str::limit($session['user_agent'] ?: 'Browser unknown', 80) }}
                                    </p>
                                    <p class="text-[11px] text-ink-subtle">
                                        Last active {{ $session['last_active']->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <x-duro.alert variant="info">
                    Session details will appear here when using the database session driver.
                </x-duro.alert>
            @endif

            <form method="POST" action="{{ route('profile.sessions.destroy') }}" class="space-y-3">
                @csrf
                @method('DELETE')

                <p class="text-sm text-ink-muted">
                    Enter your password to end all other active sessions. Your current session stays signed in.
                </p>

                <x-duro.input
                    name="password"
                    type="password"
                    label="Current password"
                    autocomplete="current-password"
                    required
                />

                <div class="flex items-center justify-end gap-3">
                    <x-duro.button type="submit" class="px-5">
                        Sign out other sessions
                    </x-duro.button>
                </div>
            </form>
        </x-duro.card>

        {{-- Two-factor authentication --}}
        <x-duro.card class="space-y-6">
            <div class="flex items-center justify-between gap-2">
                <div>
                    <h2 class="text-lg font-semibold text-ink">
                        Two-factor authentication
                    </h2>
                    <p class="text-sm text-ink-muted">
                        Add a second layer using your authenticator app and recovery codes.
                    </p>
                </div>

                @if ($twoFactorEnabled)
                    <x-duro.badge variant="gold">
                        {{ $twoFactorConfirmed ? 'Active' : 'Pending confirmation' }}
                    </x-duro.badge>
                @else
                    <x-duro.badge variant="silver">
                        Disabled
                    </x-duro.badge>
                @endif
            </div>

            @if (in_array($status, [
                Fortify::TWO_FACTOR_AUTHENTICATION_ENABLED,
                Fortify::TWO_FACTOR_AUTHENTICATION_CONFIRMED,
                Fortify::TWO_FACTOR_AUTHENTICATION_DISABLED,
                Fortify::RECOVERY_CODES_GENERATED,
            ], true))
                <x-duro.alert variant="success">
                    @switch($status)
                        @case(Fortify::TWO_FACTOR_AUTHENTICATION_ENABLED)
                            Two-factor is now enabled. Scan the QR code and confirm with your authenticator.
                            @break
                        @case(Fortify::TWO_FACTOR_AUTHENTICATION_CONFIRMED)
                            Two-factor confirmed. Keep your recovery codes somewhere safe.
                            @break
                        @case(Fortify::TWO_FACTOR_AUTHENTICATION_DISABLED)
                            Two-factor disabled for this account.
                            @break
                        @case(Fortify::RECOVERY_CODES_GENERATED)
                            New recovery codes generated.
                            @break
                    @endswitch
                </x-duro.alert>
            @endif

            @if (! $twoFactorEnabled)
                <div class="flex items-center justify-between gap-3 flex-wrap">
                    <p class="text-sm text-ink-muted">
                        Use your authenticator app to scan a QR code and start protecting sign-ins.
                    </p>
                    <form method="POST" action="{{ route('two-factor.enable') }}">
                        @csrf
                        <x-duro.button type="submit" class="px-4">
                            Enable two-factor
                        </x-duro.button>
                    </form>
                </div>
            @else
                <div class="grid gap-6 lg:grid-cols-2">
                    <div class="space-y-4">
                        <h3 class="text-sm font-semibold uppercase tracking-[0.08em] text-ink-muted">
                            Authenticator setup
                        </h3>

                        @if ($user?->two_factor_secret)
                            @php
                                $qrCodeSvg = $user->twoFactorQrCodeSvg();
                            @endphp

                            <div class="rounded-ui border border-line/70 bg-surface p-4 shadow-sm">
                                <div
                                    class="flex justify-center"
                                    role="img"
                                    aria-label="Two-factor authentication QR code for {{ $user?->email }}"
                                >
                                    {!! $qrCodeSvg !!}
                                </div>
                                <p class="sr-only">
                                    Scan this QR code with your authenticator app to link your account.
                                </p>
                                <p class="mt-3 text-xs text-ink-muted">
                                    Scan this with your authenticator app. If you cannot scan, use the manual key shown in your app.
                                </p>
                            </div>

                            @if ($setupKey)
                                <div class="flex flex-col gap-2 rounded-ui border border-primary/30 bg-primary/5 p-3 text-xs font-mono text-ink">
                                    <span class="text-[11px] uppercase tracking-[0.08em] text-ink-muted">
                                        Setup key (Fortify TOTP)
                                    </span>
                                    <span class="text-base font-semibold">
                                        {{ $setupKey }}
                                    </span>
                                    <span class="text-[11px] text-ink-muted">
                                        Enter this key manually in your authenticator if scanning is unavailable.
                                    </span>
                                </div>
                            @endif
                        @endif

                        @if ($requiresConfirmation && ! $twoFactorConfirmed)
                            <div class="space-y-3">
                                <p class="text-sm text-ink-muted">
                                    Enter the 6-digit code from your authenticator to confirm.
                                </p>

                                <div class="flex flex-wrap items-center gap-3">
                                    <form method="POST" action="{{ route('two-factor.confirm') }}" class="space-y-3">
                                        @csrf

                                        <x-duro.input
                                            name="code"
                                            label="Authentication code"
                                            inputmode="numeric"
                                            autocomplete="one-time-code"
                                            required
                                        />

                                        <x-duro.button type="submit" class="px-4">
                                            Confirm two-factor
                                        </x-duro.button>
                                    </form>

                                    <form method="POST" action="{{ route('two-factor.disable') }}">
                                        @csrf
                                        @method('DELETE')
                                        <x-duro.button type="submit" variant="ghost" class="px-4">
                                            Cancel setup
                                        </x-duro.button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="space-y-4">
                        <h3 class="text-sm font-semibold uppercase tracking-[0.08em] text-ink-muted">
                            Recovery codes
                        </h3>

                        @if (! empty($recoveryCodes))
                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($recoveryCodes as $code)
                                    <div class="rounded-ui border border-line/70 bg-surface-2/70 px-3 py-2 text-xs font-semibold text-ink">
                                        {{ $code }}
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-sm text-ink-muted">
                                Generate recovery codes to keep access if you lose your device.
                            </p>
                        @endif

                        <div class="flex flex-wrap items-center gap-3">
                            <form method="POST" action="{{ route('two-factor.regenerate-recovery-codes') }}">
                                @csrf
                                <x-duro.button type="submit" class="px-4">
                                    Generate new codes
                                </x-duro.button>
                            </form>

                            <form method="POST" action="{{ route('two-factor.disable') }}">
                                @csrf
                                @method('DELETE')
                                <x-duro.button type="submit" variant="danger" class="px-4">
                                    Disable two-factor
                                </x-duro.button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </x-duro.card>
    </section>
</x-layouts.app>
