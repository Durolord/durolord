<div class="space-y-6">
    <x-duro.card class="space-y-4 bg-white/85 dark:bg-shadow-900/70">
        <div class="flex items-center justify-between gap-3">
            <div>
                <h2 class="text-lg font-semibold text-shadow-900 dark:text-neutralfog-50">Service info</h2>
                <p class="text-xs text-neutral-600 dark:text-neutralfog-400">Date, title, and notes for this service.</p>
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
    <x-duro.card class="space-y-4 bg-white/85 dark:bg-shadow-900/70">
        <div class="flex items-center justify-between gap-3">
            <div>
                <h3 class="text-sm font-semibold text-electric-700 dark:text-electric-300">Messages</h3>
                <p class="text-xs text-neutral-600 dark:text-neutralfog-400">Title, speaker, and tags per message.</p>
            </div>
            <x-duro.button type="button" size="sm" wire:click="addMessage">Add message</x-duro.button>
        </div>

        <div class="space-y-3">
            @forelse ($messages as $index => $message)
                <div class="rounded-xl border border-neutralfog-200 dark:border-shadow-800 p-4 space-y-3" wire:key="message-{{ $index }}">
                    <div class="flex items-center justify-between gap-3">
                        <x-duro.badge variant="electric">Message {{ $index + 1 }}</x-duro.badge>
                        <x-duro.button type="button" variant="ghost" size="sm" wire:click="removeMessage({{ $index }})" class="text-red-600 dark:text-red-300">
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
                <p class="text-xs text-neutral-600 dark:text-neutralfog-400">No messages yet. Add one to begin.</p>
            @endforelse
        </div>
    </x-duro.card>

    {{-- Speaker activities --}}
    <x-duro.card class="space-y-4 bg-white/85 dark:bg-shadow-900/70">
        <div class="flex items-center justify-between gap-3">
            <div>
                <h3 class="text-sm font-semibold text-electric-700 dark:text-electric-300">Speaker activities</h3>
                <p class="text-xs text-neutral-600 dark:text-neutralfog-400">Who did what in the service.</p>
            </div>
            <x-duro.button type="button" size="sm" wire:click="addSpeakerActivity">Add activity</x-duro.button>
        </div>

        <div class="space-y-3">
            @forelse ($speakerActivities as $index => $activity)
                <div class="rounded-xl border border-neutralfog-200 dark:border-shadow-800 p-4 space-y-3" wire:key="activity-{{ $index }}">
                    <div class="flex items-center justify-between gap-3">
                        <x-duro.badge variant="electric">Activity {{ $index + 1 }}</x-duro.badge>
                        <x-duro.button type="button" variant="ghost" size="sm" wire:click="removeSpeakerActivity({{ $index }})" class="text-red-600 dark:text-red-300">
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
                <p class="text-xs text-neutral-600 dark:text-neutralfog-400">No activities yet.</p>
            @endforelse
        </div>
    </x-duro.card>

    {{-- Hymns --}}
    <x-duro.card class="space-y-4 bg-white/85 dark:bg-shadow-900/70">
        <div class="flex items-center justify-between gap-3">
            <div>
                <h3 class="text-sm font-semibold text-electric-700 dark:text-electric-300">Hymns used</h3>
                <p class="text-xs text-neutral-600 dark:text-neutralfog-400">Track hymn number and type.</p>
            </div>
            <x-duro.button type="button" size="sm" wire:click="addHymnUsage">Add hymn</x-duro.button>
        </div>

        <div class="space-y-3">
            @forelse ($hymnUsages as $index => $hymn)
                <div class="rounded-xl border border-neutralfog-200 dark:border-shadow-800 p-4 space-y-3" wire:key="hymn-{{ $index }}">
                    <div class="flex items-center justify-between gap-3">
                        <x-duro.badge variant="electric">Hymn {{ $index + 1 }}</x-duro.badge>
                        <x-duro.button type="button" variant="ghost" size="sm" wire:click="removeHymnUsage({{ $index }})" class="text-red-600 dark:text-red-300">
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
                <p class="text-xs text-neutral-600 dark:text-neutralfog-400">No hymns recorded yet.</p>
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
