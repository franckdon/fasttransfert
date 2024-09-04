<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Edit Reglement') }}
            </h2>
            <a href="{{ route('reglements.index') }}"
                class="px-3 py-2 mt-5 ml-auto font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Back</a>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="mb-6 text-2xl">Edit Reglement</h2>
                    <hr class="my-6">
                    <form method="POST" action="{{ route('reglements.update', $reglement->id) }}">
                        @csrf
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Titre</label>
                            <input type="text" name="title" id="title"
                                class="block w-full mt-1 rounded-md shadow-sm form-input"
                                value="{{ old('title', $reglement->title) }}" />
                            @error('title')
                                <p class="mt-1 text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" id="description" class="block w-full mt-1 rounded-md shadow-sm form-input">{{ old('description', $reglement->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-red-500">{{ $message }}</p>
                            @enderror
                        </div>



                        <button
                            class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
