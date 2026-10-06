<div class="space-y-6">
    <x-duro.card class="space-y-4">
        <div class="flex items-center justify-between gap-3">
            <div>
                <h2 class="text-lg font-semibold text-ink">Service info</h2>
                <p class="text-xs text-ink-muted">Date, title, and notes for this service.</p>
            </div>
            <x-duro.badge variant="electric" class="text-[10px]">{{ ucfirst($mode) }}</x-duro.badge>
        </div>

        <div class="grid gap-4 md:grid-cols-2">
            <x-duro.date-picker
                wire:model.live="date"
                name="date"
                label="Date"
            />
            <x-duro.input wire:model.live="title" name="title" label="Title" placeholder="Evening worship" />
        </div>

        <x-duro.multi-select
            wire:model.live="serviceTags"
            name="serviceTags[]"
            label="Service tags"
            placeholder="Select tags for this service"
            :options="$serviceTagOptions"
            hint="Apply sermon or hymn tags at the service level."
        />

        <x-duro.textarea wire:model.live="notes" name="notes" label="Notes" rows="3" placeholder="Outline, announcements, or special notes..." />

        @error('date') <x-duro.alert variant="danger">{{ $message }}</x-duro.alert> @enderror
        @error('title') <x-duro.alert variant="danger">{{ $message }}</x-duro.alert> @enderror
        @error('serviceTags.*') <x-duro.alert variant="danger">{{ $message }}</x-duro.alert> @enderror
        @error('notes') <x-duro.alert variant="danger">{{ $message }}</x-duro.alert> @enderror
    </x-duro.card>

    {{-- Messages --}}
    <x-duro.card class="space-y-4">
        <div class="flex items-center justify-between gap-3">
            <div>
                <h3 class="text-sm font-semibold text-primary-ink">Messages</h3>
                <p class="text-xs text-ink-muted">Title, speaker, and tags per message.</p>
            </div>
            <x-duro.button type="button" size="sm" wire:click="addMessage">Add message</x-duro.button>
        </div>

        <div class="space-y-3">
            @forelse ($messages as $index => $message)
                <div class="rounded-ui border border-line p-4 space-y-3" wire:key="message-{{ $index }}">
                    <div class="flex items-center justify-between gap-3">
                        <x-duro.badge variant="electric">Message {{ $index + 1 }}</x-duro.badge>
                        <x-duro.button type="button" variant="ghost" size="sm" wire:click="removeMessage({{ $index }})" class="text-danger">
                            Remove
                        </x-duro.button>
                    </div>
                    <div class="grid gap-3 md:grid-cols-2">
                        <x-duro.input wire:model.live="messages.{{ $index }}.title" name="messages[{{ $index }}][title]" label="Title" required />
                        <x-duro.input wire:model.live="messages.{{ $index }}.speaker_name" name="messages[{{ $index }}][speaker_name]" label="Speaker" required />
                    </div>
                    <x-duro.multi-select
                        wire:model.live="messages.{{ $index }}.tags"
                        :options="$sermonTagOptions"
                        label="Tags"
                        placeholder="Select sermon tags"
                        hint="Use curated sermon tags for consistency."
                    />

                    @error('messages.'.$index.'.title') <x-duro.alert variant="danger">{{ $message }}</x-duro.alert> @enderror
                    @error('messages.'.$index.'.speaker_name') <x-duro.alert variant="danger">{{ $message }}</x-duro.alert> @enderror
                    @error('messages.'.$index.'.tags.*') <x-duro.alert variant="danger">{{ $message }}</x-duro.alert> @enderror
                </div>
            @empty
                <p class="text-xs text-ink-muted">No messages yet. Add one to begin.</p>
            @endforelse
        </div>
    </x-duro.card>

    {{-- Speaker activities --}}
    <x-duro.card class="space-y-4">
        <div class="flex items-center justify-between gap-3">
            <div>
                <h3 class="text-sm font-semibold text-primary-ink">Speaker activities</h3>
                <p class="text-xs text-ink-muted">Who did what in the service.</p>
            </div>
            <x-duro.button type="button" size="sm" wire:click="addSpeakerActivity">Add activity</x-duro.button>
        </div>

        <div class="space-y-3">
            @forelse ($speakerActivities as $index => $activity)
                <div class="rounded-ui border border-line p-4 space-y-3" wire:key="activity-{{ $index }}">
                    <div class="flex items-center justify-between gap-3">
                        <x-duro.badge variant="electric">Activity {{ $index + 1 }}</x-duro.badge>
                        <x-duro.button type="button" variant="ghost" size="sm" wire:click="removeSpeakerActivity({{ $index }})" class="text-danger">
                            Remove
                        </x-duro.button>
                    </div>
                    <div class="grid gap-3 md:grid-cols-2">
                        <x-duro.input wire:model.live="speakerActivities.{{ $index }}.speaker_name" name="speakerActivities[{{ $index }}][speaker_name]" label="Speaker" required />
                        <x-duro.input wire:model.live="speakerActivities.{{ $index }}.activity" name="speakerActivities[{{ $index }}][activity]" label="Activity" required placeholder="Prayed, led worship, read scripture" />
                    </div>
                    @error('speakerActivities.'.$index.'.speaker_name') <x-duro.alert variant="danger">{{ $message }}</x-duro.alert> @enderror
                    @error('speakerActivities.'.$index.'.activity') <x-duro.alert variant="danger">{{ $message }}</x-duro.alert> @enderror
                </div>
            @empty
                <p class="text-xs text-ink-muted">No activities yet.</p>
            @endforelse
        </div>
    </x-duro.card>

    {{-- Hymns --}}
    <x-duro.card class="space-y-4">
        <div class="flex items-center justify-between gap-3">
            <div>
                <h3 class="text-sm font-semibold text-primary-ink">Hymns used</h3>
                <p class="text-xs text-ink-muted">Track hymn number and type.</p>
            </div>
            <x-duro.button type="button" size="sm" wire:click="addHymnUsage">Add hymn</x-duro.button>
        </div>

        <div class="space-y-3">
            @forelse ($hymnUsages as $index => $hymn)
                <div class="rounded-ui border border-line p-4 space-y-3" wire:key="hymn-{{ $index }}">
                    <div class="flex items-center justify-between gap-3">
                        <x-duro.badge variant="electric">Hymn {{ $index + 1 }}</x-duro.badge>
                        <x-duro.button type="button" variant="ghost" size="sm" wire:click="removeHymnUsage({{ $index }})" class="text-danger">
                            Remove
                        </x-duro.button>
                    </div>
                    <div class="grid gap-3 md:grid-cols-2">
                        <x-duro.input wire:model.live="hymnUsages.{{ $index }}.hymn_number" name="hymnUsages[{{ $index }}][hymn_number]" label="Hymn number" required />
                        <x-duro.select
                            wire:model.live="hymnUsages.{{ $index }}.hymn_type"
                            name="hymnUsages[{{ $index }}][hymn_type]"
                            label="Hymn type"
                            placeholder="Select hymn type"
                            :options="$hymnTypeOptions"
                        />
                    </div>
                    @error('hymnUsages.'.$index.'.hymn_number') <x-duro.alert variant="danger">{{ $message }}</x-duro.alert> @enderror
                    @error('hymnUsages.'.$index.'.hymn_type') <x-duro.alert variant="danger">{{ $message }}</x-duro.alert> @enderror
                </div>
            @empty
                <p class="text-xs text-ink-muted">No hymns recorded yet.</p>
            @endforelse
        </div>
    </x-duro.card>

    <div class="flex items-center justify-end gap-3">
        <x-duro.button type="button" variant="ghost" wire:click="cancel">Cancel</x-duro.button>
        <x-duro.button type="submit" class="px-5">
            {{ $mode === 'edit' ? 'Save changes' : 'Create service' }}
        </x-duro.button>
    </div>
</div>
