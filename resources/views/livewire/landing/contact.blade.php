<div>
    @if ($sent)
        <div class="duro-card flex flex-col items-center gap-4 p-10 text-center" wire:key="contact-sent">
            <span class="duro-icon-tile size-16"><x-duro.icon name="send" size="xl" /></span>
            <h3 class="duro-heading text-2xl">Message received</h3>
            <p class="max-w-sm text-sm text-ink-muted">Thank you for reaching out. I read every inquiry personally and will reply to your email soon.</p>
            <x-duro.button variant="secondary" wire:click="startOver" icon="refresh">Send another message</x-duro.button>
        </div>
    @else
        <form wire:submit="submit" class="duro-card space-y-6 p-6 sm:p-8" wire:key="contact-form" novalidate>
            <div class="grid gap-5 sm:grid-cols-2">
                <x-duro.input name="name" label="Your name" wire:model.blur="name" icon="user" placeholder="Ada Lovelace" autocomplete="name" required />
                <x-duro.input name="email" type="email" label="Email" wire:model.blur="email" icon="mail" placeholder="ada@company.com" autocomplete="email" required />
            </div>

            <x-duro.input name="company" label="Company (optional)" wire:model.blur="company" icon="briefcase" placeholder="Analytical Engines Ltd." autocomplete="organization" />

            <fieldset class="space-y-2">
                <legend class="duro-label mb-2">What are we building?</legend>
                <div class="grid gap-2 sm:grid-cols-2">
                    @foreach ($projectTypes as $value => $label)
                        <label class="flex cursor-pointer items-center gap-3 rounded-ui border border-line bg-surface-2 px-3.5 py-3 text-sm text-ink transition hover:border-primary/60 has-[:checked]:border-primary has-[:checked]:bg-primary/10 has-[:checked]:shadow-glow" wire:key="type-{{ $value }}">
                            <input type="radio" name="projectType" value="{{ $value }}" wire:model="projectType" class="duro-check">
                            {{ $label }}
                        </label>
                    @endforeach
                </div>
                @error('projectType') <p class="duro-error">{{ $message }}</p> @enderror
            </fieldset>

            <x-duro.select name="budget" label="Estimated budget" wire:model="budget" :options="$budgets" placeholder="Choose a range" :searchable="false" icon="briefcase" />

            <x-duro.textarea name="message" label="Project details" wire:model.blur="message" rows="5" placeholder="Goals, timeline, links to existing systems — anything that helps." />

            <div class="hidden" aria-hidden="true">
                <label for="website">Website</label>
                <input id="website" type="text" wire:model="website" tabindex="-1" autocomplete="off">
            </div>

            <div class="flex flex-col-reverse gap-4 sm:flex-row sm:items-center sm:justify-between">
                <p class="flex items-center gap-2 text-xs text-ink-subtle">
                    <x-duro.icon name="lock" class="size-3.5" /> Your details are only used to reply to you.
                </p>
                <x-duro.button type="submit" size="lg" icon="send" loading="submit">Send message</x-duro.button>
            </div>
        </form>
    @endif
</div>
