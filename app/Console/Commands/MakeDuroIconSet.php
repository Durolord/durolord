<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeDuroIconSet extends Command
{
    protected $signature = 'duro:icons {--force : Overwrite existing icon files}';

    protected $description = 'Generate Duro Code style Blade icon components for the portfolio';

    /**
     * Core icon set for your portfolio.
     *
     * @var array<string, string>
     */
    protected array $icons = [
        'orb' => 'M9 12.25a3 3 0 0 1 3-3 3 3 0 0 1 2.7 1.72M7 17.5c1.4-1.7 2.9-2.5 5-2.5s3.6.8 5 2.5',
        'bolt' => 'M10 3.5 7 13h4l-1 7.5L17 11h-4l1-7.5z',
        'user' => 'M12 12a3.25 3.25 0 1 0 0-6.5 3.25 3.25 0 0 0 0 6.5z M6.5 18.5c1-2.8 3-4.25 5.5-4.25s4.5 1.45 5.5 4.25',
        'mail' => 'M4 7.5h16v9H4z M4 7.5 12 13l8-5.5',
        'shield' => 'M12 4.25 6.5 6.5v5.25c0 3.4 2.3 5.7 5.5 7 3.2-1.3 5.5-3.6 5.5-7V6.5z M10.25 12.25 12 14l2.75-3.5',
        'code' => 'M9 6.75 5.75 12 9 17.25M15 6.75 18.25 12 15 17.25M11 18.5l2-13',
        'grid' => 'M5.75 6.75h5.5v5.5h-5.5z M12.75 6.75h5.5v5.5h-5.5z M5.75 13.75h5.5v5.5h-5.5z M12.75 13.75h5.5v5.5h-5.5z',
        'spark' => 'M12 3.5 13.1 8l4.4 1.1-4.4 1.1L12 15.75 10.9 10.2 6.5 9.1l4.4-1.1z',
    ];

    public function handle(): int
    {
        $basePath = resource_path('views/components');

        File::ensureDirectoryExists($basePath);

        $force = $this->option('force');

        foreach ($this->icons as $name => $glyph) {
            $fileName = $name.'.blade.php';
            $path = $basePath.DIRECTORY_SEPARATOR.$fileName;

            if (File::exists($path) && ! $force) {
                $this->line("⏭  Skipping {$fileName} (already exists, use --force to overwrite)");

                continue;
            }

            File::put($path, $this->buildIconStub($name, $glyph));

            $this->info("✨ Generated icon: {$fileName}");
        }

        $this->newLine();
        $this->info('✅ Duro icon set generated.');

        return self::SUCCESS;
    }

    protected function buildIconStub(string $name, string $glyph): string
    {
        $label = Str::of($name)->replace('-', ' ')->title();

        $glyphPath = trim($glyph);

        return <<<BLADE
{{-- {$label} icon (Duro Code style) --}}
<svg
    {{ \$attributes->merge([
        'class' => 'h-4 w-4',
        'viewBox' => '0 0 24 24',
        'xmlns' => 'http://www.w3.org/2000/svg',
        'aria-hidden' => 'true',
    ]) }}
    fill="none"
    stroke="currentColor"
    stroke-width="1.7"
    stroke-linecap="round"
    stroke-linejoin="round"
>
    {{-- Outer arcane ring --}}
    <circle cx="12" cy="12" r="9" stroke-opacity="0.45" />

    {{-- Inner focus orb --}}
    <circle cx="12" cy="12" r="4.25" stroke-opacity="0.85" />

    {{-- Glyph specific to this icon --}}
    <path d="{$glyphPath}" />

    {{-- Mystic crosshair accent --}}
    <path d="M12 4.25v1.75M12 18v1.75M5.25 12H7M17 12h1.75" stroke-opacity="0.5" />
</svg>

BLADE;
    }
}
