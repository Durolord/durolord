<?php

namespace App\Livewire\Showcase;

use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;

class FormComponents extends Component
{
    use WithFileUploads;

    public string $name = '';

    public string $email = '';

    public string $password = '';

    public string $role = 'developer';

    /** @var array<int, string> */
    public array $skills = ['laravel', 'livewire'];

    public string $about = '';

    public string $markdown = "## Project brief\n\nBuild a **multi-theme** portfolio with Livewire.";

    public bool $newsletter = true;

    public bool $arcaneMode = false;

    /** @var array<int, string> */
    public array $focusAreas = ['hrms'];

    public string $difficulty = 'standard';

    public string $deployDate = '';

    public string $deployAt = '';

    public string $standupTime = '';

    public int $complexity = 6;

    public string $accentColor = '#3fa0ff';

    public string $tags = 'laravel,livewire';

    public string $layout = 'grid';

    public string $initScript = "<?php\n\nRoute::get('/', fn () => view('welcome'));";

    /** @var array<int, mixed> */
    public array $attachments = [];

    public bool $submitted = false;

    /**
     * @return array<string, array<int, string>>
     */
    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:120'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'string'],
            'skills' => ['array', 'min:1'],
            'about' => ['nullable', 'string', 'max:500'],
        ];
    }

    /**
     * @return array<string, string>
     */
    protected function messages(): array
    {
        return [
            'name.required' => 'Please enter your name.',
            'email.required' => 'An email is required so the realms can reach you.',
            'email.email' => 'That does not look like a valid email.',
            'password.min' => 'Use at least 8 characters for a strong password.',
            'skills.min' => 'Pick at least one skill.',
        ];
    }

    public function updated(string $property): void
    {
        if (array_key_exists($property, $this->rules())) {
            $this->validateOnly($property);
        }

        $this->submitted = false;
    }

    public function submit(): void
    {
        $this->validate();

        $this->submitted = true;

        $this->dispatch('duro-toast', title: 'Profile saved', body: 'Validation passed — in a real app this would persist.', variant: 'success');
    }

    public function render(): View
    {
        return view('livewire.showcase.form-components', [
            'roles' => ['developer' => 'Developer', 'designer' => 'Designer', 'architect' => 'Architect', 'overseer' => 'Overseer'],
            'skillOptions' => ['laravel' => 'Laravel', 'livewire' => 'Livewire', 'alpine' => 'Alpine.js', 'tailwind' => 'Tailwind CSS', 'vue' => 'Vue', 'mysql' => 'MySQL', 'redis' => 'Redis'],
        ])->layout('components.layouts.app', [
            'title' => 'Forms',
        ]);
    }
}
