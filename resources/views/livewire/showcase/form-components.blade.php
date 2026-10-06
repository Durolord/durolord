<div class="space-y-14">
    <x-duro.page-header
        title="Forms"
        description="Every field binds with wire:model, surfaces validation errors automatically and adapts to the active realm. Try the live form first — it validates as you type."
        :breadcrumbs="['UI Kit' => route('showcase'), 'Forms' => null]"
    >
        <x-slot:actions>
            <x-duro.button variant="secondary" icon="table" :href="route('table-components')">Tables</x-duro.button>
            <x-duro.button icon="layers" :href="route('elements')">Elements</x-duro.button>
        </x-slot:actions>
    </x-duro.page-header>

    {{-- LIVE FORM --}}
    <x-docs.example title="Live validated form" description="Real-time validation with Livewire: errors appear after you leave a field and clear as soon as the value is fixed.">
        <form wire:submit="submit" class="grid gap-8 lg:grid-cols-[1fr_18rem]" novalidate>
            <div class="space-y-5">
                @if ($submitted)
                    <x-duro.alert variant="success" title="All checks passed" dismissible>Your profile is valid and ready to save.</x-duro.alert>
                @endif

                <div class="grid gap-5 sm:grid-cols-2">
                    <x-duro.input name="name" label="Full name" icon="user" wire:model.blur="name" placeholder="Ada Lovelace" />
                    <x-duro.input name="email" type="email" label="Email" icon="mail" wire:model.blur="email" placeholder="ada@example.com" />
                </div>
                <x-duro.input name="password" type="password" label="Password" icon="lock" wire:model.blur="password" hint="At least 8 characters." />
                <div class="grid gap-5 sm:grid-cols-2">
                    <x-duro.select name="role" label="Primary role" wire:model.live="role" :options="$roles" />
                    <x-duro.multi-select label="Skills" wire:model.live="skills" :options="$skillOptions" placeholder="Pick skills" />
                </div>
                <x-duro.textarea name="about" label="Short bio" wire:model.blur="about" rows="3" placeholder="What do you love building?" hint="Up to 500 characters." />
            </div>

            <aside class="space-y-5 rounded-card border border-line bg-surface-2/60 p-5">
                <p class="duro-label">Live state</p>
                <dl class="space-y-2.5 text-xs">
                    @foreach (['name' => $name ?: '—', 'email' => $email ?: '—', 'role' => $role, 'skills' => implode(', ', $skills) ?: '—'] as $key => $value)
                        <div class="flex justify-between gap-3">
                            <dt class="font-mono text-ink-subtle">${{ $key }}</dt>
                            <dd class="truncate text-right text-ink">{{ $value }}</dd>
                        </div>
                    @endforeach
                </dl>
                <x-duro.button type="submit" class="w-full" icon="check" loading="submit">Validate & save</x-duro.button>
            </aside>
        </form>

        <x-slot:code>
            @verbatim
            <form wire:submit="submit">
                <x-duro.input name="email" type="email" label="Email" icon="mail" wire:model.blur="email" />
                <x-duro.input name="password" type="password" label="Password" wire:model.blur="password" />
                <x-duro.select name="role" label="Primary role" wire:model.live="role" :options="$roles" />
                <x-duro.multi-select label="Skills" wire:model.live="skills" :options="$skillOptions" />

                <x-duro.button type="submit" loading="submit">Validate & save</x-duro.button>
            </form>
            @endverbatim
        </x-slot:code>
    </x-docs.example>

    {{-- CHOICES --}}
    <x-docs.example title="Choices & toggles" description="Checkboxes, checkbox cards, radios, switches, segmented toggle buttons and a range slider.">
        <div class="grid gap-8 md:grid-cols-2">
            <div class="space-y-6">
                <x-duro.checkbox wire:model.live="newsletter" label="Receive product updates" hint="One email per month, no spam." />
                <x-duro.switch wire:model.live="arcaneMode" label="Enhanced visual mode" hint="Adds extra glow and motion." />
                <x-duro.radio label="Complexity preference" name="difficulty" wire:model.live="difficulty" :options="['casual' => 'Casual', 'standard' => 'Standard', 'soulslike' => 'Soulslike']" inline />
                <x-duro.toggle-buttons label="Layout" wire:model.live="layout" :options="['grid' => 'Grid', 'list' => 'List', 'board' => 'Board']" :icons="['grid' => 'grid', 'list' => 'menu', 'board' => 'layout']" />
            </div>
            <div class="space-y-6">
                <x-duro.checkbox-list label="Focus areas" wire:model.live="focusAreas" :options="['hrms' => 'HR systems', 'cms' => 'Content management', 'church' => 'Church systems', 'analytics' => 'Analytics']" />
                <x-duro.slider label="Complexity" wire:model.live="complexity" :min="1" :max="10" :value="$complexity" />
                <p class="rounded-ui border border-dashed border-line p-3 font-mono text-xs text-ink-subtle">
                    newsletter={{ $newsletter ? 'true' : 'false' }} · visual={{ $arcaneMode ? 'on' : 'off' }} · difficulty={{ $difficulty }} · layout={{ $layout }} · focus=[{{ implode(',', $focusAreas) }}] · complexity={{ $complexity }}
                </p>
            </div>
        </div>

        <x-slot:code>
            @verbatim
            <x-duro.switch wire:model.live="notifications" label="Email notifications" />
            <x-duro.checkbox-list label="Focus areas" wire:model.live="focusAreas" :options="$areas" />
            <x-duro.toggle-buttons wire:model.live="layout" :options="['grid' => 'Grid', 'list' => 'List']" />
            <x-duro.slider label="Complexity" wire:model.live="complexity" :min="1" :max="10" />
            @endverbatim
        </x-slot:code>
    </x-docs.example>

    {{-- DATE & TIME --}}
    <x-docs.example title="Date & time" description="Calendar, time and combined pickers with year jumping and quick actions.">
        <div class="grid gap-5 md:grid-cols-3">
            <x-duro.date-picker label="Launch date" wire:model.live="deployDate" />
            <x-duro.time-picker label="Daily stand-up" wire:model.live="standupTime" />
            <x-duro.date-time-picker label="Next deployment" wire:model.live="deployAt" />
        </div>
        <p class="mt-5 font-mono text-xs text-ink-subtle">date={{ $deployDate ?: '—' }} · time={{ $standupTime ?: '—' }} · datetime={{ $deployAt ?: '—' }}</p>

        <x-slot:code>
            @verbatim
            <x-duro.date-picker label="Launch date" wire:model.live="deployDate" />
            <x-duro.time-picker label="Daily stand-up" wire:model="standupTime" />
            <x-duro.date-time-picker label="Next deployment" wire:model="deployAt" />
            @endverbatim
        </x-slot:code>
    </x-docs.example>

    {{-- RICH CONTENT --}}
    <x-docs.example title="Rich content" description="Markdown with live preview, a WYSIWYG editor and a code editor.">
        <div class="grid gap-6 lg:grid-cols-2">
            <x-duro.markdown-editor label="Project brief (Markdown)" name="markdown" wire:model="markdown" :value="$markdown" />
            <x-duro.rich-editor label="Release notes" name="notes" />
            <div class="lg:col-span-2">
                <x-duro.code-editor label="Initialization script" name="init_script" wire:model="initScript" language="php" />
            </div>
        </div>
    </x-docs.example>

    {{-- STRUCTURED DATA --}}
    <x-docs.example title="Structured data & files" description="Tags, colour, key-value pairs, drag-and-drop uploads, repeaters and a block builder.">
        <div class="grid gap-8 lg:grid-cols-2">
            <div class="space-y-6">
                <x-duro.tags-input label="Tags" name="tags" wire:model="tags" :value="$tags" />
                <x-duro.color-picker label="Accent colour" wire:model.live="accentColor" :value="$accentColor" />
                <x-duro.key-value label="Environment variables" name="env" />
            </div>
            <div class="space-y-6">
                <x-duro.file-upload label="Attachments" name="attachments" wire:model="attachments" multiple />
                <x-duro.repeater label="Service slots">
                    <x-duro.input name="service_name" label="Service name" />
                </x-duro.repeater>
                <x-duro.builder label="Page builder" :blocks="['text' => 'Text', 'image' => 'Image', 'cta' => 'CTA']" />
            </div>
        </div>
    </x-docs.example>
</div>
