<?php

namespace Tests\Feature;

use App\Livewire\Showcase\TableComponents;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ThemesAndComponentsTest extends TestCase
{
    use RefreshDatabase;

    public function test_every_theme_has_brand_assets(): void
    {
        foreach (config('duro.themes') as $key => $theme) {
            $this->assertContains($theme['mode'], ['light', 'dark'], "Theme [{$key}] needs a valid mode.");
            $this->assertFileExists(public_path($theme['mark']));
            $this->assertFileExists(public_path($theme['wordmark']));
            $this->assertCount(3, $theme['swatches']);
        }
    }

    public function test_every_family_pairs_a_light_and_a_dark_theme(): void
    {
        $themes = config('duro.themes');

        $this->assertArrayHasKey(config('duro.default_family'), config('duro.families'));

        foreach (config('duro.families') as $key => $family) {
            foreach (['light', 'dark'] as $mode) {
                $themeKey = $family[$mode];

                $this->assertArrayHasKey($themeKey, $themes, "Family [{$key}] references missing theme [{$themeKey}].");
                $this->assertSame($mode, $themes[$themeKey]['mode'], "Theme [{$themeKey}] should be a {$mode} theme.");
                $this->assertSame($key, $themes[$themeKey]['family'], "Theme [{$themeKey}] should belong to family [{$key}].");
            }
        }

        $this->assertSame('runic-bronze', config('duro.families.runic.light'));
        $this->assertSame('runic-steel', config('duro.families.runic.dark'));
    }

    public function test_every_realm_expresses_a_personality_trait(): void
    {
        $traits = config('duro.traits');

        foreach (config('duro.families') as $key => $family) {
            $this->assertArrayHasKey($family['trait'], $traits, "Family [{$key}] points at an unknown trait.");
            $this->assertNotEmpty($family['motto']);
        }

        $usedTraits = collect(config('duro.families'))->pluck('trait')->unique()->all();
        $this->assertEqualsCanonicalizing(array_keys($traits), $usedTraits, 'Every trait should have at least one realm.');
    }

    public function test_every_theme_has_styles(): void
    {
        $css = file_get_contents(resource_path('css/app.css'));

        foreach (array_keys(config('duro.themes')) as $key) {
            $this->assertStringContainsString("[data-theme=\"{$key}\"] {", $css, "Theme [{$key}] has no token block.");
        }
    }

    public function test_component_pages_render_with_the_theme_switcher(): void
    {
        foreach (['showcase', 'form-components', 'table-components', 'elements'] as $route) {
            $response = $this->get(route($route))->assertOk()->assertSee('window.__duro', false);

            foreach (config('duro.families') as $family) {
                $response->assertSee($family['name']);
            }
        }
    }

    public function test_original_pages_still_render_with_themes(): void
    {
        $this->get(route('home'))->assertOk()->assertSee('window.__duro', false)->assertSee('Choose your realm');
        $this->get(route('login'))->assertOk()->assertSee('window.__duro', false)->assertSee('Choose your realm');

        $this->actingAs(User::factory()->create())
            ->get(route('dashboard'))
            ->assertOk()
            ->assertSee('Choose your realm');
    }

    public function test_table_demo_filters_rows(): void
    {
        $component = Livewire::test(TableComponents::class)
            ->set('search', 'priya');

        $this->assertSame(['Priya Stone'], $component->instance()->filteredRows->pluck('name')->all());

        $component->set('search', '')->set('status', 'active');
        $this->assertSame(['active'], $component->instance()->filteredRows->pluck('status')->unique()->values()->all());

        $component->call('resetFilters');
        $this->assertCount(6, $component->instance()->filteredRows);
    }
}
