<x-layouts.app title="Dashboard">
    <div class="space-y-8">
        <x-duro.page-header
            eyebrow="Overview"
            title="Welcome back, {{ auth()->user()->name }}"
            description="Your command centre for inquiries, services and the Duro UI kit."
        >
            <x-slot:actions>
                <x-duro.button :href="route('services.create')" variant="secondary" icon="plus">New service</x-duro.button>
                <x-duro.button :href="route('home')" icon="globe">View portfolio</x-duro.button>
            </x-slot:actions>
        </x-duro.page-header>

        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <x-duro.stat label="Inquiries" :value="$inquiryCount" icon="mail" />
            <x-duro.stat label="Unread" :value="$unreadInquiryCount" icon="bell" />
            <x-duro.stat label="Services" :value="$serviceCount" icon="calendar" />
            <x-duro.stat label="Realms" :value="count(config('duro.themes'))" icon="palette" />
        </div>

        <div class="grid gap-6 lg:grid-cols-[1.6fr_1fr]">
            <x-duro.table.table title="Latest inquiries" description="Messages sent through the portfolio contact form.">
                <x-duro.table.head>
                    <x-duro.table.header-cell>From</x-duro.table.header-cell>
                    <x-duro.table.header-cell>Project</x-duro.table.header-cell>
                    <x-duro.table.header-cell>Budget</x-duro.table.header-cell>
                    <x-duro.table.header-cell align="right">Received</x-duro.table.header-cell>
                </x-duro.table.head>
                <x-duro.table.body>
                    @forelse ($recentInquiries as $inquiry)
                        <x-duro.table.row>
                            <x-duro.table.image-column :name="$inquiry->name" :description="$inquiry->email" :status="$inquiry->read_at ? null : 'online'" />
                            <x-duro.table.text-column :value="$inquiry->projectTypeLabel()" :description="\Illuminate\Support\Str::limit($inquiry->message, 48)" />
                            <x-duro.table.cell><x-duro.badge variant="accent">{{ $inquiry->budgetLabel() }}</x-duro.badge></x-duro.table.cell>
                            <x-duro.table.cell align="right" class="whitespace-nowrap text-xs text-ink-subtle">{{ $inquiry->created_at->diffForHumans() }}</x-duro.table.cell>
                        </x-duro.table.row>
                    @empty
                        <x-duro.table.empty-state icon="mail" title="No inquiries yet" description="When someone uses the contact form on your portfolio, it will show up here." />
                    @endforelse
                </x-duro.table.body>
            </x-duro.table.table>

            <div class="space-y-4">
                <h2 class="duro-heading text-lg">Quick links</h2>
                @foreach ([
                    ['route' => 'services.index', 'icon' => 'calendar', 'title' => 'Services', 'body' => 'Plan services, messages and hymns.'],
                    ['route' => 'showcase', 'icon' => 'sparkles', 'title' => 'UI kit', 'body' => 'Browse every Duro component.'],
                    ['route' => 'profile', 'icon' => 'shield', 'title' => 'Profile & security', 'body' => 'Password, 2FA and sessions.'],
                ] as $link)
                    <a href="{{ route($link['route']) }}" class="duro-card duro-card-interactive flex items-center gap-4 p-4">
                        <span class="duro-icon-tile size-10"><x-duro.icon :name="$link['icon']" size="md" /></span>
                        <span class="min-w-0 flex-1">
                            <span class="block font-semibold text-ink">{{ $link['title'] }}</span>
                            <span class="block text-xs text-ink-muted">{{ $link['body'] }}</span>
                        </span>
                        <x-duro.icon name="arrow-right" class="text-ink-subtle" />
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-layouts.app>
