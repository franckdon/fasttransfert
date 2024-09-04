<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Create Demande') }}
            </h2>
            <a href="{{ route('demandes.index') }}"
                class="px-3 py-2 mt-5 ml-auto font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Back</a>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="mb-6 text-2xl">Creer une demande</h2>
                    {{-- <form method="POST" action="{{ route('permissions.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="user_id" class="block text-sm font-medium text-gray-700">Sélectionner une
                                entreprise</label>
                            <select name="user_id" id="user_id" class="block w-full mt-1 rounded-md shadow-sm">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="user_id" class="block text-sm font-medium text-gray-700">Sélectionner un
                                motif</label>
                            <select name="user_id" id="user_id" class="block w-full mt-1 rounded-md shadow-sm">
                                @foreach ($reglements as $reglement)
                                    <option value="{{ $reglement->id }}">{{ $reglement->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit"
                            class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Create</button>
                    </form> --}}
                    <livewire:multi-step-form />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
