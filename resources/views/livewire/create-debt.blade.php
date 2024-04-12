<div class="bg-white dark:bg-gray-800 dark:text-gray-200 overflow-hidden shadow-xl sm:rounded-lg">
    <h2
        class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight border-b border-gray-100 dark:border-gray-700 p-4">
        Add Debt
    </h2>

    <form wire:submit="create" class="p-4 space-y-2">
        <div class="flex gap-2">
            <div class="flex-1">
                <x-label for="whosInDebt" value="Who's in debt?" />
                <x-input type="text" name="whosInDebt" wire:model="whosInDebt" class="w-full" />
                <x-input-error for="whosInDebt" />
            </div>

            <div class="">
                <x-label for="amount" value="Amount" />
                <x-input type="number" placeholder="$" name="amount" wire:model="amount" class="w-full" />
                <x-input-error for="amount" />
            </div>
        </div>

        <div class="mb-4">
            <x-label for="comments" value="Comments" />
            <x-input type="text" name="comments" wire:model="comments" class="w-full" />
            <x-input-error for="comments" />
        </div>

        <x-button type="submit">
            <svg wire:loading class="animate-spin duration-500 w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
            </svg>

            Save
        </x-button>
    </form>
</div>
