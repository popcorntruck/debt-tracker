<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Debt Tracker') }}
            </h2>

            <livewire:total-debt />
        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <livewire:create-debt />

            <livewire:debt-list />
        </div>
    </div>
</x-app-layout>
