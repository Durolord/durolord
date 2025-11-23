<div class="min-h-[calc(100vh-5rem)]">

    <div class="space-y-8 p-6">

        {{-- Header --}}
        <div class="space-y-1">
            <h2 class="text-lg font-semibold text-shadow-900 dark:text-silver-50">
                Component Reference
            </h2>
            <p class="text-xs text-neutral-700 dark:text-neutralfog-300">
                Quick overview of each form component in the Duro kit.
            </p>
        </div>

        {{-- CTA Buttons --}}
        <div class="flex flex-col sm:flex-row gap-3 pt-2">
            <a href="/form-components"
               class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 rounded-xl
                      bg-electric-500 text-white text-xs font-semibold tracking-wide shadow-md
                      hover:bg-electric-600 transition dark:bg-electric-400 dark:hover:bg-electric-300">
                ⚡ Form Components
            </a>

            <a href="/table-components"
               class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 rounded-xl
                      bg-neutralfog-300 text-shadow-900 text-xs font-semibold tracking-wide shadow-md
                      hover:bg-neutralfog-400 transition dark:bg-shadow-700 dark:text-neutralfog-100 dark:hover:bg-shadow-800">
                📊 Table Components
            </a>
        </div>

        {{-- Grid of form categories --}}
        <div class="grid gap-3 text-xs md:grid-cols-2">

            {{-- Inputs --}}
            <x-duro.card class="space-y-1 text-xs bg-neutral-50/60 dark:bg-shadow-900/40">
                <h3 class="font-semibold text-electric-700 dark:text-electric-300">Inputs & Text</h3>
                <ul class="mt-1 space-y-1">
                    <li><code class="font-mono text-[11px]">&lt;x-duro.input&gt;</code></li>
                    <li><code class="font-mono text-[11px]">&lt;x-duro.textarea&gt;</code></li>
                    <li><code class="font-mono text-[11px]">&lt;x-duro.rich-editor&gt;</code></li>
                    <li><code class="font-mono text-[11px]">&lt;x-duro.markdown-editor&gt;</code></li>
                    <li><code class="font-mono text-[11px]">&lt;x-duro.code-editor&gt;</code></li>
                </ul>
            </x-duro.card>

            {{-- Choices --}}
            <x-duro.card class="space-y-1 text-xs bg-neutral-50/60 dark:bg-shadow-900/40">
                <h3 class="font-semibold text-electric-700 dark:text-electric-300">Choices & Toggles</h3>
                <ul class="mt-1 space-y-1">
                    <li><code class="font-mono text-[11px]">&lt;x-duro.select&gt;</code></li>
                    <li><code class="font-mono text-[11px]">&lt;x-duro.checkbox&gt;</code></li>
                    <li><code class="font-mono text-[11px]">&lt;x-duro.checkbox-list&gt;</code></li>
                    <li><code class="font-mono text-[11px]">&lt;x-duro.radio&gt;</code></li>
                    <li><code class="font-mono text-[11px]">&lt;x-duro.toggle&gt;</code></li>
                    <li><code class="font-mono text-[11px]">&lt;x-duro.toggle-buttons&gt;</code></li>
                    <li><code class="font-mono text-[11px]">&lt;x-duro.slider&gt;</code></li>
                </ul>
            </x-duro.card>

            {{-- Meta --}}
            <x-duro.card class="space-y-1 text-xs bg-neutral-50/60 dark:bg-shadow-900/40">
                <h3 class="font-semibold text-electric-700 dark:text-electric-300">Meta & Structure</h3>
                <ul class="mt-1 space-y-1">
                    <li><code class="font-mono text-[11px]">&lt;x-duro.date-time-picker&gt;</code></li>
                    <li><code class="font-mono text-[11px]">&lt>x-duro.tags-input&gt;</code></li>
                    <li><code class="font-mono text-[11px]">&lt>x-duro.key-value&gt;</code></li>
                    <li><code class="font-mono text-[11px]">&lt>x-duro.color-picker&gt;</code></li>
                    <li><code class="font-mono text-[11px]">&lt>x-duro.repeater&gt;</code></li>
                    <li><code class="font-mono text-[11px]">&lt>x-duro.builder&gt;</code></li>
                </ul>
            </x-duro.card>

            {{-- Chrome --}}
            <x-duro.card class="space-y-1 text-xs bg-neutral-50/60 dark:bg-shadow-900/40">
                <h3 class="font-semibold text-electric-700 dark:text-electric-300">Files & Chrome</h3>
                <ul class="mt-1 space-y-1">
                    <li><code class="font-mono text-[11px]">&lt;x-duro.file-upload&gt;</code></li>
                    <li><code class="font-mono text-[11px]">&lt;x-duro.button&gt;</code></li>
                    <li><code class="font-mono text-[11px]">&lt;x-duro.alert&gt;</code></li>
                    <li><code class="font-mono text-[11px]">&lt;x-duro.badge&gt;</code></li>
                    <li><code class="font-mono text-[11px]">&lt;x-duro.card&gt;</code></li>
                </ul>
            </x-duro.card>

        </div>
        <div class="grid gap-3 text-xs md:grid-cols-2 lg:grid-cols-3">

    {{-- Table Shell --}}
    <x-duro.card class="space-y-1 text-xs bg-neutral-50/60 dark:bg-shadow-900/40">
        <h3 class="font-semibold text-electric-700 dark:text-electric-300">Table Shell</h3>
        <ul class="mt-1 space-y-1">
            <li>
                <code class="font-mono text-[11px]">table.blade.php</code>
            </li>
            <li>
                <code class="font-mono text-[11px]">head.blade.php</code>
            </li>
            <li>
                <code class="font-mono text-[11px]">body.blade.php</code>
            </li>
            <li>
                <code class="font-mono text-[11px]">empty-state.blade.php</code>
            </li>
            <li>
                <code class="font-mono text-[11px]">filters.blade.php</code>
            </li>
        </ul>
    </x-duro.card>

    {{-- Rows & Cells (repeated -row / -cell) --}}
    <x-duro.card class="space-y-1 text-xs bg-neutral-50/60 dark:bg-shadow-900/40">
        <h3 class="font-semibold text-electric-700 dark:text-electric-300">Rows & Cells</h3>
        <ul class="mt-1 space-y-1">
            <li>
                <code class="font-mono text-[11px]">
                    <span class="opacity-70">group-</span>
                    <span class="text-electric-600 dark:text-electric-300 font-semibold">row</span>.blade.php
                </code>
            </li>
            <li>
                <code class="font-mono text-[11px]">
                    <span class="text-electric-600 dark:text-electric-300 font-semibold">row</span>.blade.php
                </code>
            </li>
            <li>
                <code class="font-mono text-[11px]">
                    <span class="opacity-70">header-</span>
                    <span class="text-electric-600 dark:text-electric-300 font-semibold">cell</span>.blade.php
                </code>
            </li>
            <li>
                <code class="font-mono text-[11px]">
                    <span class="text-electric-600 dark:text-electric-300 font-semibold">cell</span>.blade.php
                </code>
            </li>
            <li>
                <code class="font-mono text-[11px]">summary-row.blade.php</code>
            </li>
        </ul>
    </x-duro.card>

    {{-- Columns (repeated -column) --}}
    <x-duro.card class="space-y-1 text-xs bg-neutral-50/60 dark:bg-shadow-900/40">
        <h3 class="font-semibold text-electric-700 dark:text-electric-300">Columns</h3>
        <ul class="mt-1 space-y-1">
            <li>
                <code class="font-mono text-[11px]">
                    <span class="opacity-70">actions-</span>
                    <span class="text-electric-600 dark:text-electric-300 font-semibold">column</span>.blade.php
                </code>
            </li>
            <li>
                <code class="font-mono text-[11px]">
                    <span class="opacity-70">checkbox-</span>
                    <span class="text-electric-600 dark:text-electric-300 font-semibold">column</span>.blade.php
                </code>
            </li>
            <li>
                <code class="font-mono text-[11px]">
                    <span class="opacity-70">color-</span>
                    <span class="text-electric-600 dark:text-electric-300 font-semibold">column</span>.blade.php
                </code>
            </li>
            <li>
                <code class="font-mono text-[11px]">
                    <span class="opacity-70">icon-</span>
                    <span class="text-electric-600 dark:text-electric-300 font-semibold">column</span>.blade.php
                </code>
            </li>
            <li>
                <code class="font-mono text-[11px]">
                    <span class="opacity-70">image-</span>
                    <span class="text-electric-600 dark:text-electric-300 font-semibold">column</span>.blade.php
                </code>
            </li>
            <li>
                <code class="font-mono text-[11px]">
                    <span class="opacity-70">input-</span>
                    <span class="text-electric-600 dark:text-electric-300 font-semibold">column</span>.blade.php
                </code>
            </li>
            <li>
                <code class="font-mono text-[11px]">
                    <span class="opacity-70">select-</span>
                    <span class="text-electric-600 dark:text-electric-300 font-semibold">column</span>.blade.php
                </code>
            </li>
            <li>
                <code class="font-mono text-[11px]">
                    <span class="opacity-70">text-</span>
                    <span class="text-electric-600 dark:text-electric-300 font-semibold">column</span>.blade.php
                </code>
            </li>
            <li>
                <code class="font-mono text-[11px]">
                    <span class="opacity-70">toggle-</span>
                    <span class="text-electric-600 dark:text-electric-300 font-semibold">column</span>.blade.php
                </code>
            </li>
        </ul>
    </x-duro.card>

    {{-- Filters & Search --}}
    <x-duro.card class="space-y-1 text-xs bg-neutral-50/60 dark:bg-shadow-900/40">
        <h3 class="font-semibold text-electric-700 dark:text-electric-300">Filters & Search</h3>
        <ul class="mt-1 space-y-1">
            <li>
                <code class="font-mono text-[11px]">filter-search.blade.php</code>
            </li>
            <li>
                <code class="font-mono text-[11px]">filter-select.blade.php</code>
            </li>
            <li>
                <code class="font-mono text-[11px]">filter-checkbox.blade.php</code>
            </li>
            <li>
                <code class="font-mono text-[11px]">filter-input.blade.php</code>
            </li>
        </ul>
    </x-duro.card>

</div>

        {{-- Footer --}}
        <div class="pt-3 text-[11px] text-neutral-600 dark:text-neutralfog-400">
            Tune the styling on these components once, and every feature you ship —
            HRMS, CMS, church tracker, analytics — inherits the same mystical Duro aesthetic.
        </div>

</div>

</div>
