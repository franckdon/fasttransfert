<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            {{-- <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Create Demande') }}
            </h2> --}}
            <a href="{{ route('demandes.index') }}"
                class="px-3 py-2 mt-5 ml-auto font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Back</a>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="mb-6 text-2xl">Creer une demande</h2>
                    <livewire:multi-step-form />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
