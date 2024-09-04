<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Create questions') }}
            </h2>
            <a href="{{ route('reglements.index') }}"
                class="px-3 py-2 mt-5 ml-auto font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Back</a>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="mb-6 text-2xl">Create question</h2>
                    <form method="POST" action="{{ route('questions.store', $reglement->id) }}">
                        @csrf
                        <div class="mb-4">
                            <input type="hidden" name="reglement_id" value="{{ $reglement->id }}">

                            <label for="intitule" class="block text-sm font-medium text-gray-700">Label</label>
                            <input type="text" name="intitule" id="intitule"
                                class="block w-full mt-1 rounded-md shadow-sm form-input"
                                value="{{ old('intitule') }}" />
                            @error('intitule')
                                <p class="mt-1 text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <button
                            class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
