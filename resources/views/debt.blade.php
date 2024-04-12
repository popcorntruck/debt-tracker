<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Debt Tracker') }}
            </h2>

            <div class="flex flex-col">
                <span class="text-gray-600 dark:text-gray-400">
                    Total debt:
                </span>

                <span class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight">
                    ${{ number_format($totalDebt, 2) }}
                </span>
            </div>
        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <livewire:create-debt />

            <h3 class="mt-6 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Current Debts:
                </h2>
                <div class="flex flex-col mt-2 space-y-2">
                    @foreach ($debts as $debt)
                        <div
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
                                $formatter = \Carbon\Carbon::parse($debt->created_at)->setTimeZone(
                                    'America/Los_Angeles',
                                );
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

                            <form method="POST" class="mt-2" action="/debt/{{ $debt->id }}/delete" x-data
                                x-on:submit="confirm('Are you sure you want to remove this entry?') ? null : $event.preventDefault()">
                                @csrf

                                <x-danger-button class="block" type="submit">Delete</x-danger-button>
                            </form>

                            <script></script>
                        </div>
                    @endforeach
                </div>
        </div>


    </div>
</x-app-layout>
