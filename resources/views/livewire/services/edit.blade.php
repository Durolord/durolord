<form wire:submit.prevent="save" class="space-y-6">
    @include('services.partials.form', ['mode' => $mode ?? 'edit'])

    @if (session('status'))
        <x-duro.alert variant="success">{{ session('status') }}</x-duro.alert>
    @endif
</form>
