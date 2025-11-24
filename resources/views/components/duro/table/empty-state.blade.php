@props([
    'title' => 'No results',
    'message' => 'Try adjusting your filters or creating a new record.',
    'colspan' => 1,
])

<tr>
    <td colspan="{{ $colspan }}" class="px-4 py-10">
        <div class="flex flex-col items-center justify-center gap-2 text-center">
            <x-duro.card class="inline-flex flex-col items-center gap-2 px-6 py-5 bg-neutralfog-100/80 dark:bg-shadow-900/80">
                <div class="h-10 w-10 rounded-full bg-neutralfog-200 dark:bg-shadow-900 flex items-center justify-center">
                    <span class="text-xl">👁‍🗨</span>
                </div>

                <p class="text-xs font-medium text-neutral-700 dark:text-neutralfog-200">
                    {{ $title }}
                </p>

                <p class="text-[11px] text-neutral-500 dark:text-neutralfog-400 max-w-xs mx-auto">
                    {{ $message }}
                </p>

                @if(isset($action))
                    <div class="mt-2">
                        {{ $action }}
                    </div>
                @endif
            </x-duro.card>
        </div>
    </td>
</tr>