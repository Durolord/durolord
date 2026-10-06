<?php

namespace Tests\Feature;

use App\Livewire\Landing\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Livewire;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        RateLimiter::clear('contact:127.0.0.1');
    }

    public function test_a_valid_inquiry_is_stored(): void
    {
        Livewire::test(Contact::class)
            ->set('name', 'Grace Hopper')
            ->set('email', 'grace@example.com')
            ->set('company', 'Navy')
            ->set('projectType', 'admin-panel')
            ->set('budget', '5k-15k')
            ->set('message', 'We need an admin panel for our logistics team.')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertSet('sent', true)
            ->assertSet('name', '')
            ->assertDispatched('duro-toast');

        $this->assertDatabaseHas('contact_inquiries', [
            'email' => 'grace@example.com',
            'project_type' => 'admin-panel',
            'budget' => '5k-15k',
            'company' => 'Navy',
        ]);
    }

    public function test_required_fields_are_validated(): void
    {
        Livewire::test(Contact::class)
            ->call('submit')
            ->assertHasErrors(['name' => 'required', 'email' => 'required', 'projectType' => 'required', 'budget' => 'required', 'message' => 'required']);

        $this->assertDatabaseCount('contact_inquiries', 0);
    }

    public function test_invalid_values_are_rejected(): void
    {
        Livewire::test(Contact::class)
            ->set('name', 'G')
            ->set('email', 'not-an-email')
            ->set('projectType', 'spaceship')
            ->set('budget', 'a-billion')
            ->set('message', 'Too short')
            ->call('submit')
            ->assertHasErrors(['name' => 'min', 'email' => 'email', 'projectType' => 'in', 'budget' => 'in', 'message' => 'min']);

        $this->assertDatabaseCount('contact_inquiries', 0);
    }

    public function test_honeypot_submissions_are_silently_discarded(): void
    {
        Livewire::test(Contact::class)
            ->set('name', 'Spam Bot')
            ->set('email', 'bot@example.com')
            ->set('projectType', 'other')
            ->set('budget', 'unsure')
            ->set('message', 'Buy cheap things at my totally legitimate website.')
            ->set('website', 'https://spam.example')
            ->call('submit')
            ->assertSet('sent', true);

        $this->assertDatabaseCount('contact_inquiries', 0);
    }

    public function test_submissions_are_rate_limited(): void
    {
        $component = Livewire::test(Contact::class);

        foreach (range(1, 3) as $attempt) {
            $component
                ->set('name', 'Ada Lovelace')
                ->set('email', "ada{$attempt}@example.com")
                ->set('projectType', 'web-app')
                ->set('budget', 'unsure')
                ->set('message', 'An analytical engine, but as a web application.')
                ->call('submit')
                ->call('startOver');
        }

        $component
            ->set('name', 'Ada Lovelace')
            ->set('email', 'ada4@example.com')
            ->set('projectType', 'web-app')
            ->set('budget', 'unsure')
            ->set('message', 'An analytical engine, but as a web application.')
            ->call('submit')
            ->assertHasErrors('message')
            ->assertSet('sent', false);

        $this->assertDatabaseCount('contact_inquiries', 3);
    }
}
