<div class="min-h-[calc(100vh-5rem)]">
    <section class="container mx-auto px-6 py-16 lg:py-20 space-y-12">

        {{-- PAGE HEADING --}}
        <header class="max-w-xl space-y-4">
            <x-duro.badge variant="gold">
                Form System • Duro UI
            </x-duro.badge>

            <div class="space-y-2">
                <h1 class="text-3xl md:text-4xl font-extrabold leading-tight tracking-tight text-electric-700 dark:text-electric-300">
                    Structured, modern form layout
                </h1>

                <p class="text-sm md:text-base text-neutral-700 dark:text-neutralfog-300">
                    A clean, two-column form flow using Duro components.
                </p>
            </div>
        </header>

        {{-- MAIN CONTENT AREA --}}
        <div class="lg:grid lg:gap-12">

            {{-- LEFT COLUMN (two-column card grid) --}}
            <div class="space-y-12">

                {{-- FORM START --}}
                <form wire:submit.prevent="submit" class="space-y-12">

                    {{-- =============== TWO-COLUMN CARD GRID =============== --}}
                    <div class="grid gap-8 lg:gap-10 md:grid-cols-2">

                        {{-- CARD: BASIC IDENTITY --}}
                        <x-duro.card class="space-y-6 h-full flex flex-col justify-between">
                            <div class="space-y-2">
                                <h2 class="text-base md:text-lg font-semibold text-shadow-900 dark:text-silver-50">
                                    Profile & Basic Details
                                </h2>
                                <p class="text-xs md:text-sm text-neutral-700 dark:text-neutralfog-300">
                                    Capture essential data.
                                </p>
                            </div>

                            @if($submitted)
                                <x-duro.alert variant="success" title="Saved">
                                    Your details have been saved.
                                </x-duro.alert>
                            @endif

                            <div class="grid gap-4">
                                <x-duro.input
                                    name="name"
                                    label="Full name"
                                    wire:model.defer="name"
                                />

                                <x-duro.input
                                    name="email"
                                    type="email"
                                    label="Email"
                                    wire:model.defer="email"
                                />
                            </div>

                            <x-duro.multi-select
                                label="Primary role"
                                wire:model.defer="role"
                                name="role"
                                placeholder="Select..."
                                :options="[
                                    'developer' => 'Developer',
                                    'designer'  => 'Designer',
                                    'architect' => 'Architect',
                                    'overseer'  => 'Overseer',
                                ]"
                            />

                            <x-duro.textarea
                                label="Short bio"
                                name="about"
                                wire:model.defer="about"
                                rows="4"
                            />

                            <x-duro.markdown-editor
                                label="Extended description"
                                name="markdown"
                                wire:model.defer="markdown"
                            />

                            <x-duro.button type="submit" class="px-6 py-3 text-sm font-semibold">
                                {{ $submitted ? 'Retract form' : 'Submit form' }}
                            </x-duro.button>
                        </x-duro.card>

                        {{-- CARD: PREFERENCES --}}
                        <x-duro.card class="space-y-6 h-full">
                            <div class="space-y-2">
                                <h3 class="text-xs font-semibold tracking-[0.18em] uppercase text-neutral-600 dark:text-neutralfog-400">
                                    Preferences
                                </h3>
                                <p class="text-xs text-neutral-700 dark:text-neutralfog-300">
                                    Customize system behavior.
                                </p>
                            </div>

                            <div class="grid gap-4">
                                <x-duro.checkbox
                                    wire:model.defer="newsletter"
                                    name="newsletter"
                                    label="Receive updates"
                                />

                                <x-duro.toggle
                                    label="Enhanced visual mode"
                                    wire:model.defer="arcaneMode"
                                />
                            </div>

                            <div class="grid gap-4">
                                <x-duro.checkbox-list
                                    label="Focus areas"
                                    :options="[
                                        'hrms'      => 'HRMS',
                                        'cms'       => 'CMS',
                                        'church'    => 'Church systems',
                                        'analytics' => 'Analytics dashboards',
                                    ]"
                                />

                                <x-duro.radio
                                    label="Complexity preference"
                                    :options="[
                                        'casual'   => 'Casual',
                                        'standard' => 'Standard',
                                        'soulslike'=> 'Soulslike',
                                    ]"
                                    inline
                                    wire:model.defer="difficulty"
                                />
                            </div>
                        </x-duro.card>

                        {{-- CARD: META --}}
                        <x-duro.card class="space-y-6 h-full">
                            <div class="space-y-2">
                                <h3 class="text-xs font-semibold tracking-[0.18em] uppercase text-neutral-600 dark:text-neutralfog-400">
                                    Meta & Configuration
                                </h3>
                            </div>

                            <div class="grid gap-4">
                                <x-duro.date-time-picker
                                    label="Next event"
                                    wire:model.defer="deploy_at"
                                />

                                <x-duro.slider
                                    label="Complexity"
                                    wire:model.defer="complexity"
                                    :min="1"
                                    :max="10"
                                />
                            </div>

                            <div class="grid gap-4">
                                <x-duro.tags-input
                                    label="Tags"
                                    name="tags"
                                    value="{{ $tags ?? '' }}"
                                />

                                <x-duro.color-picker
                                    label="Accent color"
                                    wire:model.defer="accent_color"
                                />
                            </div>
                        </x-duro.card>

                        {{-- CARD: FILES --}}
                        <x-duro.card class="space-y-6 h-full">
                            <h3 class="text-xs font-semibold tracking-[0.18em] uppercase text-neutral-600 dark:text-neutralfog-400">
                                Files & Data
                            </h3>

                            <div class="grid gap-4">
                                <x-duro.file-upload
                                    label="Attachments"
                                    name="attachments"
                                    wire:model="attachments"
                                    multiple
                                />

                                <x-duro.key-value
                                    label="Environment variables"
                                    name="env"
                                />
                            </div>
                        </x-duro.card>

                        {{-- CARD: REPEATER + BUILDER --}}
                        <x-duro.card class="space-y-6 h-full">
                            <h3 class="text-xs font-semibold tracking-[0.18em] uppercase text-neutral-600 dark:text-neutralfog-400">
                                Repeater & Builder
                            </h3>

                            <div class="grid gap-4">
                                <x-duro.repeater label="Service slots">
                                    <x-duro.input name="service_name" label="Service name" />
                                    <x-duro.date-time-picker label="Start time" />
                                </x-duro.repeater>

                                <x-duro.builder
                                    label="Page builder"
                                    :blocks="[
                                        'text'  => 'Text',
                                        'image' => 'Image',
                                        'cta'   => 'CTA',
                                    ]"
                                />
                            </div>
                        </x-duro.card>

                        {{-- CARD: CODE EDITOR --}}
                        <x-duro.card class="space-y-6 h-full">
                            <h3 class="text-xs font-semibold tracking-[0.18em] uppercase text-neutral-600 dark:text-neutralfog-400">
                                Code Snippet
                            </h3>

                            <x-duro.code-editor
                                label="Initialization script"
                                name="init_script"
                                wire:model.defer="init_script"
                                language="php"
                            />
                        </x-duro.card>
                    </div>

                </form>
            </div>

        </div>

    </section>
</div>
