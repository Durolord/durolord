<?php

namespace App\Livewire\Landing;

use App\Models\ContactInquiry;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Contact extends Component
{
    public string $name = '';

    public string $email = '';

    public string $company = '';

    public string $projectType = '';

    public string $budget = '';

    public string $message = '';

    /**
     * Honeypot field: humans never see or fill it.
     */
    public string $website = '';

    public bool $sent = false;

    /**
     * @return array<string, array<int, mixed>>
     */
    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:120'],
            'email' => ['required', 'email', 'max:190'],
            'company' => ['nullable', 'string', 'max:120'],
            'projectType' => ['required', Rule::in(array_keys(config('portfolio.project_types')))],
            'budget' => ['required', Rule::in(array_keys(config('portfolio.budgets')))],
            'message' => ['required', 'string', 'min:20', 'max:5000'],
        ];
    }

    /**
     * @return array<string, string>
     */
    protected function messages(): array
    {
        return [
            'name.required' => 'Please tell me your name.',
            'email.required' => 'I need an email address to reply to you.',
            'email.email' => 'That email address does not look right.',
            'projectType.required' => 'Pick the option that best describes your project.',
            'budget.required' => 'A rough budget helps me tailor the proposal.',
            'message.required' => 'Tell me a little about the project.',
            'message.min' => 'A couple of sentences (20+ characters) helps me understand the project.',
        ];
    }

    public function updated(string $property): void
    {
        if (array_key_exists($property, $this->rules()) && $this->getErrorBag()->has($property)) {
            $this->validateOnly($property);
        }
    }

    public function submit(): void
    {
        $limiterKey = 'contact:'.request()->ip();

        if (RateLimiter::tooManyAttempts($limiterKey, 3)) {
            $this->addError('message', 'You have sent several messages recently. Please try again in '.RateLimiter::availableIn($limiterKey).' seconds.');

            return;
        }

        $validated = $this->validate();

        if ($this->website !== '') {
            $this->markAsSent();

            return;
        }

        RateLimiter::hit($limiterKey, 600);

        ContactInquiry::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'company' => $validated['company'] ?: null,
            'project_type' => $validated['projectType'],
            'budget' => $validated['budget'],
            'message' => $validated['message'],
            'ip_address' => request()->ip(),
        ]);

        $this->markAsSent();
    }

    public function startOver(): void
    {
        $this->sent = false;
    }

    protected function markAsSent(): void
    {
        $this->reset(['name', 'email', 'company', 'projectType', 'budget', 'message', 'website']);
        $this->sent = true;

        $this->dispatch('duro-toast', title: 'Message sent', body: 'Thanks for reaching out — I will be in touch soon.', variant: 'success');
    }

    public function render(): View
    {
        return view('livewire.landing.contact', [
            'projectTypes' => config('portfolio.project_types'),
            'budgets' => config('portfolio.budgets'),
        ]);
    }
}
