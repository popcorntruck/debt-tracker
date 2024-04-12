<section class="mt-4">
    <div class="flex justify-between">
        <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Current Debts
        </h3>

        <x-input type="text" aria-label="Search" placeholder="Search" class="py-0 px-2" wire:model.live="search" />
    </div>
    <div class="flex flex-col mt-2 space-y-4">
        @foreach ($debts as $debt)
            <div wire:key="{{ $debt->id }}"
                class="bg-white dark:bg-gray-800 dark:text-gray-200 overflow-hidden shadow-xl sm:rounded-lg p-4">
                <div class="flex items-center gap-2 flex-wrap">
                    <span class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight">
                        {{ $debt->whos_in_debt }}
                    </span>

                    <span class="text-gray-600 dark:text-gray-400 leading-tight">
                        owes you
                    </span>

                    <span class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight">
                        ${{ number_format($debt->amount, 2) }}
                    </span>
                </div>

                @php
                    $formatter = \Carbon\Carbon::parse($debt->created_at)->setTimeZone('America/Los_Angeles');
                @endphp

                <span class="text-gray-600 dark:text-gray-400 border-gray-100 dark:border-gray-700">
                    added on {{ $formatter->format('d/m/Y') }} at {{ $formatter->format('h:i a') }}
                </span>

                @if ($debt->comment)
                    <div class="flex flex-col mt-2">
                        <x-label>Comments</x-label>

                        <p class="text-gray-600 dark:text-gray-400">{{ $debt->comment }}</p>
                    </div>
                @endif

                <div class="mt-2">
                    <x-danger-button class="block" wire:click="delete({{ $debt->id }})"
                        wire:confirm="Are you sure you want to remove this entry?">
                        Delete
                    </x-danger-button>
                </div>
            </div>
        @endforeach
    </div>
</section>
