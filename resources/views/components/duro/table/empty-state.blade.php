@props([
    'title' => 'No results',
    'description' => null,
    'message' => null,
    'icon' => 'search',
    'colspan' => 99,
])

<tr>
    <td colspan="{{ $colspan }}" class="!p-0">
        <x-duro.empty-state :icon="$icon" :title="$title" :description="$description ?? $message ?? 'Try adjusting your filters or creating a new record.'">
            @isset($action)
                <x-slot:action>{{ $action }}</x-slot:action>
            @endisset
        </x-duro.empty-state>
    </td>
</tr>
