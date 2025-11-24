<?php

namespace App\Livewire\Services;

use App\Models\Service;
use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
{
    public string $date;

    public ?string $title = null;

    public ?string $notes = null;

    /** @var array<int, array<string, string|array|null>> */
    public array $messages = [];

    /** @var array<int, array<string, string|null>> */
    public array $speakerActivities = [];

    /** @var array<int, array<string, string|null>> */
    public array $hymnUsages = [];

    /** @var array<string, string> */
    public array $sermonTagOptions = [];

    /** @var array<string, string> */
    public array $hymnTypeOptions = [];

    /** @var array<string, string> */
    public array $serviceTagOptions = [];

    /** @var array<int, string> */
    public array $serviceTags = [];

    public function mount(): void
    {
        $this->date = now()->toDateString();
        $this->sermonTagOptions = $this->sermonTags();
        $this->hymnTypeOptions = $this->hymnTags();
        $this->serviceTagOptions = $this->serviceTags();
        $this->serviceTags = [];
        $this->messages = [];
        $this->speakerActivities = [];
        $this->hymnUsages = [];
    }

    public function addMessage(): void
    {
        $this->messages[] = [
            'title' => '',
            'speaker_name' => '',
            'tags' => [],
        ];
    }

    public function removeMessage(int $index): void
    {
        unset($this->messages[$index]);
        $this->messages = array_values($this->messages);
    }

    public function addSpeakerActivity(): void
    {
        $this->speakerActivities[] = [
            'speaker_name' => '',
            'activity' => '',
        ];
    }

    public function removeSpeakerActivity(int $index): void
    {
        unset($this->speakerActivities[$index]);
        $this->speakerActivities = array_values($this->speakerActivities);
    }

    public function addHymnUsage(): void
    {
        $this->hymnUsages[] = [
            'hymn_number' => '',
            'hymn_type' => array_key_first($this->hymnTypeOptions) ?? '',
        ];
    }

    public function removeHymnUsage(int $index): void
    {
        unset($this->hymnUsages[$index]);
        $this->hymnUsages = array_values($this->hymnUsages);
    }

    public function save(): void
    {
        $validated = $this->validate($this->rules());

        DB::transaction(function () use ($validated) {
            /** @var Service $service */
            $service = Service::create([
                'date' => $validated['date'],
                'title' => $validated['title'] ?? null,
                'notes' => $validated['notes'] ?? null,
            ]);

            $service->tags()->sync($validated['serviceTags'] ?? []);

            if (! empty($validated['messages'])) {
                $service->messages()->createMany(
                    collect($validated['messages'])->map(function (array $message) {
                        return [
                            'title' => $message['title'],
                            'speaker_name' => $message['speaker_name'],
                            'tags' => $this->normalizeTags($message['tags'] ?? []),
                        ];
                    })->all()
                );
            }

            if (! empty($validated['speakerActivities'])) {
                $service->speakerActivities()->createMany($validated['speakerActivities']);
            }

            if (! empty($validated['hymnUsages'])) {
                $service->hymnUsages()->createMany($validated['hymnUsages']);
            }
        });

        session()->flash('status', 'Service created.');

        $this->redirectRoute('services.index');
    }

    public function cancel(): void
    {
        $this->redirectRoute('services.index');
    }

    public function render(): View
    {
        return view('livewire.services.create', [
            'mode' => 'create',
        ])->layout('layouts.duro', [
            'title' => 'Create Service',
        ]);
    }

    /**
     * @return array<string, array<int, string>>
     */
    protected function rules(): array
    {
        return [
            'date' => ['required', 'date'],
            'title' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
            'serviceTags' => ['array'],
            'serviceTags.*' => ['string', Rule::in(array_keys($this->serviceTagOptions))],
            'messages' => ['array'],
            'messages.*.title' => ['required', 'string', 'max:255'],
            'messages.*.speaker_name' => ['required', 'string', 'max:255'],
            'messages.*.tags' => ['array'],
            'messages.*.tags.*' => ['string', 'max:255', Rule::in(array_keys($this->sermonTagOptions))],
            'speakerActivities' => ['array'],
            'speakerActivities.*.speaker_name' => ['required', 'string', 'max:255'],
            'speakerActivities.*.activity' => ['required', 'string', 'max:255'],
            'hymnUsages' => ['array'],
            'hymnUsages.*.hymn_number' => ['required', 'string', 'max:255'],
            'hymnUsages.*.hymn_type' => ['required', 'string', 'max:255', Rule::in(array_keys($this->hymnTypeOptions))],
        ];
    }

    /**
     * @param  array<int, string>|string|null  $tags
     * @return array<int, string>
     */
    private function normalizeTags(array|string|null $tags): array
    {
        if (is_array($tags)) {
            return collect($tags)
                ->map(fn (string $tag) => trim($tag))
                ->filter()
                ->values()
                ->all();
        }

        return collect(explode(',', (string) $tags))
            ->map(fn (string $tag) => trim($tag))
            ->filter()
            ->values()
            ->all();
    }

    /**
     * @return array<string, string>
     */
    private function sermonTags(): array
    {
        return Tag::query()
            ->where('type', Tag::TYPE_SERMON)
            ->orderBy('name')
            ->pluck('name', 'name')
            ->toArray();
    }

    /**
     * @return array<string, string>
     */
    private function hymnTags(): array
    {
        return Tag::query()
            ->where('type', Tag::TYPE_HYMN)
            ->orderBy('name')
            ->pluck('name', 'name')
            ->toArray();
    }

    /**
     * @return array<string, string>
     */
    private function serviceTags(): array
    {
        return Tag::query()
            ->orderBy('type')
            ->orderBy('name')
            ->get()
            ->mapWithKeys(function (Tag $tag): array {
                $label = ucfirst($tag->type).' · '.$tag->name;

                return [(string) $tag->id => $label];
            })
            ->toArray();
    }
}
