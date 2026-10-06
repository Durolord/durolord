<?php

namespace Tests\Feature;

use App\Livewire\Showcase\TableComponents;
use App\Models\ContactInquiry;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PortfolioPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_shows_portfolio_content(): void
    {
        $response = $this->get(route('home'));

        $response->assertOk()
            ->assertSee(config('portfolio.name'))
            ->assertSee(config('portfolio.headline'))
            ->assertSee('Selected work')
            ->assertSeeLivewire('landing.contact');

        foreach (config('duro.families') as $family) {
            $response->assertSee($family['name']);
        }

        foreach (config('duro.themes') as $theme) {
            $response->assertSee($theme['name']);
        }
    }

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

    public function test_every_theme_has_styles(): void
    {
        $css = file_get_contents(resource_path('css/app.css'));

        foreach (array_keys(config('duro.themes')) as $key) {
            $this->assertStringContainsString("[data-theme=\"{$key}\"] {", $css, "Theme [{$key}] has no token block.");
        }
    }

    public function test_ui_kit_pages_render(): void
    {
        foreach (['showcase', 'form-components', 'table-components', 'elements'] as $route) {
            $this->get(route($route))->assertOk();
        }
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

    public function test_dashboard_requires_authentication(): void
    {
        $this->get(route('dashboard'))->assertRedirect(route('login'));
    }

    public function test_dashboard_lists_recent_inquiries(): void
    {
        $user = User::factory()->create();
        $inquiry = ContactInquiry::factory()->create(['name' => 'Katherine Johnson']);

        $this->actingAs($user)
            ->get(route('dashboard'))
            ->assertOk()
            ->assertSee('Katherine Johnson')
            ->assertSee($inquiry->projectTypeLabel());
    }

    public function test_missing_pages_use_the_themed_error_page(): void
    {
        $this->get('/this-realm-does-not-exist')
            ->assertNotFound()
            ->assertSee('You wandered into the void');
    }
}
