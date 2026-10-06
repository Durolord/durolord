<div class="grid gap-10 xl:grid-cols-[1fr_13rem]">
    <div class="min-w-0 space-y-14">
        <x-duro.page-header
            title="Elements & Overlays"
            description="Actions, feedback, overlays, navigation and data display. Everything here is themeable and keyboard friendly — the toasts and stepper are wired to Livewire."
            :breadcrumbs="['UI Kit' => route('showcase'), 'Elements' => null]"
        />

        {{-- BUTTONS --}}
        <x-docs.example title="Buttons" description="Seven variants, four sizes, icons, icon-only squares and automatic Livewire loading states.">
            <div class="space-y-6">
                <div class="flex flex-wrap items-center gap-3">
                    <x-duro.button>Primary</x-duro.button>
                    <x-duro.button variant="accent">Accent</x-duro.button>
                    <x-duro.button variant="secondary">Secondary</x-duro.button>
                    <x-duro.button variant="outline">Outline</x-duro.button>
                    <x-duro.button variant="ghost">Ghost</x-duro.button>
                    <x-duro.button variant="danger">Danger</x-duro.button>
                    <x-duro.button variant="link">Link</x-duro.button>
                </div>
                <div class="flex flex-wrap items-center gap-3">
                    <x-duro.button size="sm" icon="plus">Small</x-duro.button>
                    <x-duro.button size="md" icon="rocket">Medium</x-duro.button>
                    <x-duro.button size="lg" icon-right="arrow-right">Large</x-duro.button>
                    <x-duro.button size="xl" icon="sparkles">Extra large</x-duro.button>
                </div>
                <div class="flex flex-wrap items-center gap-3">
                    <x-duro.button square icon="edit" variant="secondary" aria-label="Edit" x-tooltip="'Edit'" />
                    <x-duro.button square icon="trash" variant="danger" aria-label="Delete" x-tooltip="'Delete'" />
                    <x-duro.button square icon="settings" variant="ghost" aria-label="Settings" x-tooltip="'Settings'" />
                    <x-duro.button icon="refresh" wire:click="notify('info')" loading="notify">With loading state</x-duro.button>
                    <x-duro.button disabled>Disabled</x-duro.button>
                </div>
            </div>

            <x-slot:code>
                @verbatim
                <x-duro.button>Primary</x-duro.button>
                <x-duro.button variant="outline" size="lg" icon-right="arrow-right">Continue</x-duro.button>
                <x-duro.button square icon="edit" variant="secondary" aria-label="Edit" />
                <x-duro.button wire:click="save" loading="save" icon="check">Save</x-duro.button>
                <x-duro.button :href="route('home')" variant="link">Back home</x-duro.button>
                @endverbatim
            </x-slot:code>
        </x-docs.example>

        {{-- BADGES & ALERTS --}}
        <x-docs.example title="Badges & alerts" description="Status at a glance — with dots, icons, solid fills and dismissible alerts.">
            <div class="space-y-6">
                <div class="flex flex-wrap items-center gap-2.5">
                    @foreach (['primary', 'accent', 'neutral', 'success', 'warning', 'danger', 'info'] as $variant)
                        <x-duro.badge :variant="$variant">{{ $variant }}</x-duro.badge>
                    @endforeach
                </div>
                <div class="flex flex-wrap items-center gap-2.5">
                    <x-duro.badge variant="success" dot>Online</x-duro.badge>
                    <x-duro.badge variant="warning" icon="clock">Pending</x-duro.badge>
                    <x-duro.badge variant="primary" solid>Solid</x-duro.badge>
                    <x-duro.badge variant="danger" solid icon="alert-triangle">Critical</x-duro.badge>
                </div>
                <div class="grid gap-3 md:grid-cols-2">
                    <x-duro.alert variant="info" title="New version available">Duro UI 1.1 adds a timeline component.</x-duro.alert>
                    <x-duro.alert variant="success" title="Payment received" dismissible>Invoice #1042 has been paid in full.</x-duro.alert>
                    <x-duro.alert variant="warning" title="Trial ends soon">Your trial expires in 3 days.</x-duro.alert>
                    <x-duro.alert variant="danger" title="Deployment failed" dismissible>The build step exited with code 1.</x-duro.alert>
                </div>
            </div>

            <x-slot:code>
                @verbatim
                <x-duro.badge variant="success" dot>Online</x-duro.badge>
                <x-duro.badge variant="danger" solid icon="alert-triangle">Critical</x-duro.badge>

                <x-duro.alert variant="warning" title="Trial ends soon" dismissible>
                    Your trial expires in 3 days.
                </x-duro.alert>
                @endverbatim
            </x-slot:code>
        </x-docs.example>

        {{-- OVERLAYS --}}
        <x-docs.example title="Overlays" description="Modals and slide-overs with focus trapping, scroll locking and Escape to close. Open them from anywhere with a browser event.">
            <div class="flex flex-wrap gap-3">
                <x-duro.button icon="layout" x-on:click="$dispatch('open-modal', 'demo-modal')">Open modal</x-duro.button>
                <x-duro.button variant="danger" icon="trash" x-on:click="$dispatch('open-modal', 'confirm-delete')">Confirm dialog</x-duro.button>
                <x-duro.button variant="secondary" icon="settings" x-on:click="$dispatch('open-modal', 'demo-slide-over')">Open slide-over</x-duro.button>

                <x-duro.dropdown align="left">
                    <x-slot:trigger>
                        <x-duro.button variant="secondary" icon-right="chevron-down">Dropdown</x-duro.button>
                    </x-slot:trigger>
                    <x-duro.dropdown.item icon="eye" shortcut="V">View</x-duro.dropdown.item>
                    <x-duro.dropdown.item icon="edit" shortcut="E">Edit</x-duro.dropdown.item>
                    <x-duro.dropdown.item icon="copy" shortcut="D">Duplicate</x-duro.dropdown.item>
                    <x-duro.dropdown.divider />
                    <x-duro.dropdown.item icon="trash" danger>Delete</x-duro.dropdown.item>
                </x-duro.dropdown>

                <x-duro.button variant="ghost" icon="info" x-tooltip.top="'Tooltips work on any element'">Hover me</x-duro.button>
            </div>

            <x-duro.modal name="demo-modal" title="Invite your team" description="Collaborators get access to every realm you create." icon="users">
                <div class="space-y-4">
                    <x-duro.input name="invite_email" type="email" label="Email address" icon="mail" placeholder="teammate@company.com" />
                    <x-duro.select label="Role" :options="['viewer' => 'Viewer', 'editor' => 'Editor', 'admin' => 'Admin']" value="editor" :searchable="false" />
                </div>
                <x-slot:footer>
                    <x-duro.button variant="ghost" x-on:click="$dispatch('close-modal', 'demo-modal')">Cancel</x-duro.button>
                    <x-duro.button icon="send" x-on:click="$dispatch('close-modal', 'demo-modal'); duroToast({ title: 'Invitation sent', variant: 'success' })">Send invite</x-duro.button>
                </x-slot:footer>
            </x-duro.modal>

            <x-duro.modal name="confirm-delete" title="Delete this project?" description="This permanently removes the project and all of its data. This cannot be undone." icon="alert-triangle" max-width="md">
                <x-slot:footer>
                    <x-duro.button variant="secondary" x-on:click="$dispatch('close-modal', 'confirm-delete')">Keep it</x-duro.button>
                    <x-duro.button variant="danger" icon="trash" x-on:click="$dispatch('close-modal', 'confirm-delete'); duroToast({ title: 'Project deleted', variant: 'danger' })">Delete project</x-duro.button>
                </x-slot:footer>
            </x-duro.modal>

            <x-duro.slide-over name="demo-slide-over" title="Realm settings" description="Tune notifications and appearance.">
                <div class="space-y-6">
                    <x-duro.switch label="Email notifications" hint="Daily digest of activity" :checked="true" />
                    <x-duro.switch label="Push notifications" hint="Real-time alerts on mobile" />
                    <x-duro.divider />
                    <x-duro.radio label="Density" :options="['comfortable' => 'Comfortable', 'compact' => 'Compact']" name="density" />
                </div>
                <x-slot:footer>
                    <x-duro.button variant="ghost" x-on:click="$dispatch('close-modal', 'demo-slide-over')">Close</x-duro.button>
                    <x-duro.button icon="check" x-on:click="$dispatch('close-modal', 'demo-slide-over')">Save</x-duro.button>
                </x-slot:footer>
            </x-duro.slide-over>

            <x-slot:code>
                @verbatim
                <x-duro.button x-on:click="$dispatch('open-modal', 'invite')">Invite</x-duro.button>

                <x-duro.modal name="invite" title="Invite your team" icon="users">
                    <x-duro.input name="email" label="Email" wire:model="email" />
                    <x-slot:footer>
                        <x-duro.button wire:click="invite">Send invite</x-duro.button>
                    </x-slot:footer>
                </x-duro.modal>

                {{-- From Livewire: $this->dispatch('open-modal', 'invite'); --}}
                @endverbatim
            </x-slot:code>
        </x-docs.example>

        {{-- TOASTS --}}
        <x-docs.example title="Toast notifications" description="Fire toasts from Alpine with duroToast() or from any Livewire action with $this->dispatch('duro-toast', …).">
            <div class="flex flex-wrap gap-3">
                <x-duro.button variant="secondary" icon="check-circle" wire:click="notify('success')">Success</x-duro.button>
                <x-duro.button variant="secondary" icon="info" wire:click="notify('info')">Info</x-duro.button>
                <x-duro.button variant="secondary" icon="alert-triangle" wire:click="notify('warning')">Warning</x-duro.button>
                <x-duro.button variant="secondary" icon="x-circle" wire:click="notify('danger')">Danger</x-duro.button>
            </div>

            <x-slot:code>
                @verbatim
                // In a Livewire component
                $this->dispatch('duro-toast', title: 'Changes saved', body: 'All good.', variant: 'success');

                // In Alpine / plain JavaScript
                duroToast({ title: 'Copied!', variant: 'info' });
                @endverbatim
            </x-slot:code>
        </x-docs.example>

        {{-- NAVIGATION --}}
        <x-docs.example title="Navigation" description="Tabs (pills or underline), breadcrumbs, a Livewire-driven stepper and keyboard hints.">
            <div class="space-y-8">
                <x-duro.breadcrumbs :items="['Workspace' => '#', 'Projects' => '#', 'Realm Analytics' => null]" />

                <x-duro.tabs :tabs="['overview' => 'Overview', 'activity' => 'Activity', 'settings' => 'Settings']" variant="underline">
                    <x-duro.tabs.panel name="overview"><p class="text-sm text-ink-muted">A high-level summary of the project lives here.</p></x-duro.tabs.panel>
                    <x-duro.tabs.panel name="activity" x-cloak><p class="text-sm text-ink-muted">Recent commits, comments and deployments.</p></x-duro.tabs.panel>
                    <x-duro.tabs.panel name="settings" x-cloak><p class="text-sm text-ink-muted">Permissions, integrations and danger zone.</p></x-duro.tabs.panel>
                </x-duro.tabs>

                <div class="space-y-5">
                    <x-duro.stepper :steps="['Account', 'Project', 'Team', 'Launch']" :current="$step" />
                    <div class="flex justify-center">
                        <x-duro.button size="sm" variant="secondary" icon-right="arrow-right" wire:click="nextStep">{{ $step >= 4 ? 'Start over' : 'Next step' }}</x-duro.button>
                    </div>
                </div>

                <p class="flex flex-wrap items-center gap-2 text-sm text-ink-muted">
                    Open the command palette with <x-duro.kbd>⌘</x-duro.kbd><x-duro.kbd>K</x-duro.kbd> or <x-duro.kbd>Ctrl</x-duro.kbd><x-duro.kbd>K</x-duro.kbd>
                </p>
            </div>

            <x-slot:code>
                @verbatim
                <x-duro.tabs :tabs="['overview' => 'Overview', 'activity' => 'Activity']" variant="underline">
                    <x-duro.tabs.panel name="overview">…</x-duro.tabs.panel>
                    <x-duro.tabs.panel name="activity">…</x-duro.tabs.panel>
                </x-duro.tabs>

                <x-duro.stepper :steps="['Account', 'Project', 'Team', 'Launch']" :current="$step" />
                @endverbatim
            </x-slot:code>
        </x-docs.example>

        {{-- DATA DISPLAY --}}
        <x-docs.example title="Data display" description="Stats with animated counters, avatars, progress bars, skeleton loaders and a timeline.">
            <div class="space-y-8">
                <div class="grid gap-4 md:grid-cols-3">
                    <x-duro.stat label="Revenue" :value="48250" prefix="$" icon="trending-up" change="12.4%" description="vs last month" />
                    <x-duro.stat label="Active users" :value="1893" icon="users" change="4.1%" />
                    <x-duro.stat label="Churn" value="2.3%" icon="bar-chart" change="0.4%" trend="down" description="improved" />
                </div>

                <div class="grid gap-8 md:grid-cols-2">
                    <div class="space-y-5">
                        <div class="flex items-center gap-4">
                            <x-duro.avatar name="Ada Lovelace" size="lg" status="online" />
                            <x-duro.avatar name="Alan Turing" size="md" status="away" />
                            <x-duro.avatar name="Grace Hopper" size="sm" status="busy" />
                            <x-duro.avatar-group :names="['Ada Lovelace', 'Alan Turing', 'Grace Hopper', 'Linus Torvalds', 'Margaret Hamilton', 'Ken Thompson']" :max="4" />
                        </div>
                        <x-duro.progress label="Storage used" :value="64" />
                        <x-duro.progress label="Sprint completion" :value="88" />
                        <div class="space-y-2.5">
                            <x-duro.skeleton class="h-3 w-1/3" />
                            <x-duro.skeleton class="h-3 w-full" />
                            <x-duro.skeleton class="h-3 w-5/6" />
                        </div>
                    </div>

                    <x-duro.timeline>
                        <x-duro.timeline.item title="Deployed v2.4" time="2h ago" icon="rocket" active>Zero-downtime release to all regions.</x-duro.timeline.item>
                        <x-duro.timeline.item title="Review approved" time="5h ago" icon="check-circle">Ada approved the pull request.</x-duro.timeline.item>
                        <x-duro.timeline.item title="Project created" time="Yesterday" icon="sparkles">The realm was forged.</x-duro.timeline.item>
                    </x-duro.timeline>
                </div>
            </div>

            <x-slot:code>
                @verbatim
                <x-duro.stat label="Revenue" :value="48250" prefix="$" icon="trending-up" change="12.4%" />
                <x-duro.avatar name="Ada Lovelace" status="online" />
                <x-duro.progress label="Storage used" :value="64" />

                <x-duro.timeline>
                    <x-duro.timeline.item title="Deployed v2.4" time="2h ago" icon="rocket" active>…</x-duro.timeline.item>
                </x-duro.timeline>
                @endverbatim
            </x-slot:code>
        </x-docs.example>

        {{-- ACCORDION, RATING & OTP --}}
        <x-docs.example title="Accordion, rating & one-time code" description="Collapsible content plus two compact inputs that bind straight to Livewire with wire:model.">
            <div class="grid gap-8 lg:grid-cols-2">
                <x-duro.accordion>
                    <x-duro.accordion.item title="Is the kit accessible?" open>Yes — buttons, dialogs and menus ship with ARIA roles, focus management and keyboard support.</x-duro.accordion.item>
                    <x-duro.accordion.item title="Can I add my own theme?">Add a [data-theme] block of tokens to app.css and an entry to config/duro.php.</x-duro.accordion.item>
                    <x-duro.accordion.item title="Does it need a build step?">Only Tailwind via Vite — the components themselves are plain Blade.</x-duro.accordion.item>
                </x-duro.accordion>

                <div class="space-y-8">
                    <div class="space-y-2">
                        <p class="duro-label">Rate this kit</p>
                        <x-duro.rating wire:model.live="rating" />
                        <p class="text-xs text-ink-subtle">Livewire value: <span class="font-mono text-ink">{{ $rating }}</span></p>
                    </div>
                    <div class="space-y-2">
                        <x-duro.otp-input label="Verification code" wire:model.live="otp" />
                        <p class="text-xs text-ink-subtle">Livewire value: <span class="font-mono text-ink">{{ $otp ?: '—' }}</span></p>
                    </div>
                </div>
            </div>

            <x-slot:code>
                @verbatim
                <x-duro.accordion>
                    <x-duro.accordion.item title="Is the kit accessible?" open>…</x-duro.accordion.item>
                </x-duro.accordion>

                <x-duro.rating wire:model.live="rating" />
                <x-duro.otp-input label="Verification code" wire:model="code" :length="6" />
                @endverbatim
            </x-slot:code>
        </x-docs.example>

        {{-- EMPTY STATE --}}
        <x-docs.example title="Empty state & divider" description="Guide people forward when there is nothing to show yet.">
            <x-duro.empty-state icon="layers" title="No projects yet" description="Projects group your tables, forms and dashboards into a single realm.">
                <x-slot:action>
                    <x-duro.button icon="plus">Create your first project</x-duro.button>
                </x-slot:action>
            </x-duro.empty-state>
            <x-duro.divider class="my-6" />
            <p class="text-center text-xs text-ink-subtle">The divider ornament changes with every realm.</p>
        </x-docs.example>
    </div>

    {{-- On this page --}}
    <aside class="hidden xl:block">
        <nav class="sticky top-24 space-y-1 text-sm" aria-label="On this page">
            <p class="duro-label mb-3">On this page</p>
            @foreach (['Buttons', 'Badges & alerts', 'Overlays', 'Toast notifications', 'Navigation', 'Data display', 'Accordion, rating & one-time code', 'Empty state & divider'] as $section)
                <a href="#{{ \Illuminate\Support\Str::slug($section) }}" class="block border-l border-line py-1 pl-3 text-ink-muted transition hover:border-primary hover:text-ink">{{ $section }}</a>
            @endforeach
        </nav>
    </aside>
</div>
