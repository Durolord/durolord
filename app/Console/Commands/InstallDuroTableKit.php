<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class InstallDuroTableKit extends Command
{
    protected $signature = 'duro:install-tables';

    protected $description = 'Generate Duro UI table Blade components';

    public function handle(Filesystem $files): int
    {
        $base = resource_path('views/components/duro/table');

        $this->info('Generating Duro table components...');

        $files->ensureDirectoryExists($base);

        $stubs = $this->getStubs();

        foreach ($stubs as $relativePath => $contents) {
            $path = $base . DIRECTORY_SEPARATOR . $relativePath;

            $dir = dirname($path);
            $files->ensureDirectoryExists($dir);

            if (! $files->exists($path)) {
                $files->put($path, $contents);
                $this->line("  • Created: {$relativePath}");
            } else {
                $this->warn("  • Skipped (exists): {$relativePath}");
            }
        }

        $this->info('Duro table kit installed.');

        return self::SUCCESS;
    }

    /**
     * Return an array of [relativePath => bladeStub].
     */
    protected function getStubs(): array
    {
        return [

            // Base table wrapper
            'table.blade.php' => <<<'BLADE'
@props([
    'title' => null,
    'description' => null,
    'actions' => null,
])

<div class="space-y-4">
    @if($title || $description || $actions)
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div class="space-y-1">
                @if($title)
                    <h2 class="text-sm font-semibold text-shadow-900 dark:text-neutralfog-50">
                        {{ $title }}
                    </h2>
                @endif
                @if($description)
                    <p class="text-xs text-neutral-600 dark:text-neutralfog-400">
                        {{ $description }}
                    </p>
                @endif
            </div>

            @if($actions)
                <div class="flex flex-wrap gap-2">
                    {{ $actions }}
                </div>
            @endif
        </div>
    @endif

    <div class="overflow-hidden rounded-2xl border border-neutralfog-300/80 bg-neutralfog-100/80
                dark:border-shadow-800 dark:bg-shadow-950/80">
        <div class="overflow-x-auto">
            <table class="min-w-full border-separate border-spacing-0 text-sm">
                {{ $slot }}
            </table>
        </div>
    </div>
</div>
BLADE
            ,

            // Head / headers / body / row / cell
            'head.blade.php' => <<<'BLADE'
<thead class="bg-neutralfog-200/70 dark:bg-shadow-900/80">
    <tr>
        {{ $slot }}
    </tr>
</thead>
BLADE
            ,

            'header-cell.blade.php' => <<<'BLADE'
@props(['align' => 'left'])

<th
    {{ $attributes->class([
        'px-4 py-2.5 text-[11px] font-semibold tracking-[0.16em] uppercase text-neutral-600 dark:text-neutralfog-400 border-b border-neutralfog-300/70 dark:border-shadow-800/80',
        'text-left' => $align === 'left',
        'text-center' => $align === 'center',
        'text-right' => $align === 'right',
    ]) }}
>
    {{ $slot }}
</th>
BLADE
            ,

            'body.blade.php' => <<<'BLADE'
<tbody class="divide-y divide-neutralfog-200/70 dark:divide-shadow-900">
    {{ $slot }}
</tbody>
BLADE
            ,

            'row.blade.php' => <<<'BLADE'
@props(['interactive' => true])

<tr
    {{ $attributes->class([
        'transition-colors',
        'hover:bg-neutralfog-100/90 dark:hover:bg-shadow-900/80' => $interactive,
    ]) }}
>
    {{ $slot }}
</tr>
BLADE
            ,

            'cell.blade.php' => <<<'BLADE'
@props(['align' => 'left'])

<td
    {{ $attributes->class([
        'px-4 py-3 text-xs text-neutral-800 dark:text-neutralfog-100 align-middle',
        'text-left' => $align === 'left',
        'text-center' => $align === 'center',
        'text-right' => $align === 'right',
    ]) }}
>
    {{ $slot }}
</td>
BLADE
            ,

            // Column types
            'text-column.blade.php' => <<<'BLADE'
@props(['value' => null, 'muted' => false])

<x-duro.table.cell {{ $attributes }}>
    <span @class([
        'truncate block',
        'text-neutral-600 dark:text-neutralfog-300' => $muted,
    ])>
        {{ $value ?? $slot }}
    </span>
</x-duro.table.cell>
BLADE
            ,

            'icon-column.blade.php' => <<<'BLADE'
@props([
    'icon' => null,
    'color' => 'text-electric-600 dark:text-electric-300',
    'label' => null,
])

<x-duro.table.cell {{ $attributes->class('w-12') }}>
    <div class="flex items-center gap-2">
        @if($icon)
            <x-dynamic-component :component="$icon" class="h-4 w-4 {{ $color }}" />
        @endif
        @if($label)
            <span class="text-xs text-neutral-700 dark:text-neutralfog-200">{{ $label }}</span>
        @else
            {{ $slot }}
        @endif
    </div>
</x-duro.table.cell>
BLADE
            ,

            'image-column.blade.php' => <<<'BLADE'
@props([
    'src' => null,
    'alt' => '',
    'rounded' => true,
])

<x-duro.table.cell {{ $attributes->class('w-14') }}>
    <div class="h-10 w-10 overflow-hidden bg-shadow-900/40 flex items-center justify-center
                @if($rounded) rounded-full @else rounded-lg @endif">
        @if($src)
            <img src="{{ $src }}" alt="{{ $alt }}" class="h-full w-full object-cover">
        @else
            <span class="text-[10px] uppercase tracking-[0.16em] text-neutralfog-400">N/A</span>
        @endif
    </div>
</x-duro.table.cell>
BLADE
            ,

            'color-column.blade.php' => <<<'BLADE'
@props([
    'label' => null,
    'value' => null,
])

<x-duro.table.cell>
    <div class="inline-flex items-center gap-2 rounded-full border border-neutralfog-300/80 px-2.5 py-1
                bg-neutralfog-100/70 dark:bg-shadow-900/70 dark:border-shadow-800">
        <span
            class="h-3 w-3 rounded-full border border-shadow-900/40"
            style="background: {{ $value ?? '#ffffff' }}"
        ></span>
        <span class="text-[11px] text-neutral-700 dark:text-neutralfog-200">
            {{ $label ?? $value ?? $slot }}
        </span>
    </div>
</x-duro.table.cell>
BLADE
            ,

            'select-column.blade.php' => <<<'BLADE'
@props([
    'options' => [],
])

<x-duro.table.cell>
    <select
        {{ $attributes->class(
            'block w-full rounded-lg border border-neutralfog-300 bg-neutralfog-100 px-2 py-1.5 text-[11px]
             text-neutral-800 shadow-sm focus:outline-none focus:ring-1 focus:ring-electric-400 focus:border-electric-400
             dark:border-shadow-700 dark:bg-shadow-950 dark:text-neutralfog-100'
        ) }}
    >
        @foreach($options as $value => $label)
            <option value="{{ $value }}">{{ $label }}</option>
        @endforeach
    </select>
</x-duro.table.cell>
BLADE
            ,

            'toggle-column.blade.php' => <<<'BLADE'
<x-duro.table.cell {{ $attributes->class('w-20') }}>
    <x-duro.switch {{ $attributes->whereStartsWith('wire:model') }} />
</x-duro.table.cell>
BLADE
            ,

            'input-column.blade.php' => <<<'BLADE'
<x-duro.table.cell>
    <input
        type="text"
        {{ $attributes->class(
            'w-full rounded-md border border-transparent bg-neutralfog-100 px-2 py-1 text-xs
             text-neutral-800 focus:border-electric-400 focus:ring-1 focus:ring-electric-400
             dark:bg-shadow-900 dark:text-neutralfog-100 dark:focus:border-electric-400/80'
        ) }}
    />
</x-duro.table.cell>
BLADE
            ,

            'checkbox-column.blade.php' => <<<'BLADE'
<x-duro.table.cell {{ $attributes->class('w-10 text-center') }}>
    <input
        type="checkbox"
        {{ $attributes->class(
            'h-4 w-4 rounded border-neutralfog-400 text-electric-500 focus:ring-electric-400
             dark:border-shadow-600 dark:bg-shadow-900'
        ) }}
    />
</x-duro.table.cell>
BLADE
            ,

            'actions-column.blade.php' => <<<'BLADE'
<x-duro.table.cell {{ $attributes->class('w-32 text-right') }}>
    <div class="inline-flex items-center gap-1.5">
        {{ $slot }}
    </div>
</x-duro.table.cell>
BLADE
            ,

            // Filters layout + basic filters
            'filters.blade.php' => <<<'BLADE'
<div class="flex flex-wrap items-center justify-between gap-3 rounded-xl border border-neutralfog-300/80 bg-neutralfog-100/70 px-3 py-2.5
            dark:border-shadow-800 dark:bg-shadow-950/80">
    <div class="flex flex-wrap items-center gap-2.5">
        {{ $slot }}
    </div>

    @if(isset($actions))
        <div class="flex items-center gap-2">
            {{ $actions }}
        </div>
    @endif
</div>
BLADE
            ,

            'filter-search.blade.php' => <<<'BLADE'
@props(['placeholder' => 'Search…'])

<div class="flex items-center gap-2 rounded-full border border-neutralfog-300 bg-neutralfog-100 px-3 py-1.5
            dark:border-shadow-700 dark:bg-shadow-900">
    {{-- Replace with your icon component if you have one --}}
    <span class="h-3.5 w-3.5 rounded-full bg-neutralfog-300 dark:bg-shadow-700"></span>
    <input
        type="text"
        placeholder="{{ $placeholder }}"
        {{ $attributes->class(
            'bg-transparent text-xs text-neutral-800 placeholder:text-neutral-400
             focus:outline-none dark:text-neutralfog-100 dark:placeholder:text-neutralfog-400'
        ) }}
    />
</div>
BLADE
            ,

            'filter-select.blade.php' => <<<'BLADE'
@props([
    'label' => null,
    'options' => [],
])

<div class="inline-flex items-center gap-1.5 text-[11px]">
    @if($label)
        <span class="text-neutral-600 dark:text-neutralfog-300">{{ $label }}</span>
    @endif

    <select
        {{ $attributes->class(
            'rounded-full border border-neutralfog-300 bg-neutralfog-100 px-2.5 py-1 text-[11px]
             text-neutral-800 focus:outline-none focus:border-electric-400 focus:ring-1 focus:ring-electric-400
             dark:border-shadow-700 dark:bg-shadow-900 dark:text-neutralfog-100'
        ) }}
    >
        <option value="">All</option>
        @foreach($options as $value => $text)
            <option value="{{ $value }}">{{ $text }}</option>
        @endforeach
    </select>
</div>
BLADE
            ,

            // Empty state / grouping / summary
            'empty-state.blade.php' => <<<'BLADE'
@props([
    'title' => 'No results',
    'message' => 'Try adjusting your filters or creating a new record.',
    'colspan' => 1,
])

<tr>
    <td colspan="{{ $colspan }}" class="px-4 py-10">
        <div class="flex flex-col items-center justify-center gap-2 text-center">
            <div class="h-10 w-10 rounded-full bg-neutralfog-200 dark:bg-shadow-900 flex items-center justify-center">
                <span class="text-xl">👁‍🗨</span>
            </div>
            <p class="text-xs font-medium text-neutral-700 dark:text-neutralfog-200">
                {{ $title }}
            </p>
            <p class="text-[11px] text-neutral-500 dark:text-neutralfog-400 max-w-xs mx-auto">
                {{ $message }}
            </p>
            @if(isset($action))
                <div class="mt-2">
                    {{ $action }}
                </div>
            @endif
        </div>
    </td>
</tr>
BLADE
            ,

            'group-row.blade.php' => <<<'BLADE'
@props([
    'label',
    'colspan' => 1,
])

<tr>
    <td colspan="{{ $colspan }}" class="bg-neutralfog-200/80 dark:bg-shadow-900/80 px-4 py-2">
        <div class="flex items-center gap-2 text-[11px] font-semibold tracking-[0.16em] uppercase text-neutral-600 dark:text-neutralfog-300">
            <span class="h-px flex-1 bg-neutralfog-300 dark:bg-shadow-700"></span>
            <span>{{ $label }}</span>
            <span class="h-px flex-1 bg-neutralfog-300 dark:bg-shadow-700"></span>
        </div>
    </td>
</tr>
BLADE
            ,

            'summary-row.blade.php' => <<<'BLADE'
<tr class="bg-neutralfog-200/70 dark:bg-shadow-900/70">
    {{ $slot }}
</tr>
BLADE
            ,
        ];
    }
}
