<?php

namespace App\Livewire\Showcase;

use Livewire\Component;
use Livewire\WithFileUploads;


class FormComponents extends Component
{
    use WithFileUploads;

    public string $name = '';
    public string $email = '';
    public string $role = 'developer';
    public string $about = '';
    public bool $submitted = false;
    public array $attachments = []; 

    protected $rules = [
        'name'  => ['required', 'string', 'min:2'],
        'email' => ['required', 'email'],
        'role'  => ['required', 'string'],
        'about' => ['nullable', 'string', 'max:500'],
        
    ];

    protected $messages = [
        'name.required'  => 'Please enter your name.',
        'email.required' => 'An email is required so the realms can reach you.',
        'email.email'    => 'That doesn’t look like a valid email.',
        'role.required'  => 'Pick at least one role for this demo.',
    ];

    public function updated($property): void
    {
        // Live validation as the user types/selects
        $this->validateOnly($property);
        $this->submitted = false; // clear success state if they edit again
    }

    public function submit(): void
    {
        $this->validate();

        // In a real app, you’d persist or send this somewhere.
        $this->submitted = ! $this->submitted;

    }

    public function render()
    {
        return view('livewire.showcase.form-components')
            ->layout('layouts.app', [
                'title' => 'Form Components — Durolord UI',
            ]);
    }
}

