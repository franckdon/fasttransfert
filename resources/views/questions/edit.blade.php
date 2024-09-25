<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Edit questions') }}
            </h2>
            {{-- <a href="{{ route('questions.index', $reglement->id) }}"
                class="px-3 py-2 mt-5 ml-auto font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Back</a> --}}
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <x-message> </x-message>

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900">
                    <h2 class="mb-6 text-2xl">Modifier la question {{ $question->intitule }} </h2>
                    <form method="POST" action="{{ route('questions.update', $question->id) }}">
                        @csrf
                        <div class="mb-4">

                            <label for="intitule" class="block text-sm font-medium text-gray-700">Label</label>
                            <input type="text" name="intitule" id="intitule"
                                class="block w-full mt-1 rounded-md shadow-sm form-input"
                                value="{{ old('intitule', $question->intitule) }}" />
                            @error('intitule')
                                <p class="mt-1 text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Type de question</label>

                            <div class="mt-2">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="question_type" value="required" class="form-radio"
                                        {{ old('question_type', $question->is_required) == 1 ? 'checked' : '' }}
                                        onclick="toggleDocumentSelect()">
                                    <span class="ml-2 text-sm text-gray-700">Question obligatoire</span>
                                </label>
                            </div>

                            <div class="mt-2">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="question_type" value="complementary" class="form-radio"
                                        {{ old('question_type', $question->is_complementary) == 1 ? 'checked' : '' }}
                                        onclick="toggleDocumentSelect()">
                                    <span class="ml-2 text-sm text-gray-700">Question complémentaire</span>
                                </label>
                            </div>

                            @error('question_type')
                                <p class="mt-1 text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="document_id" class="block text-sm font-medium text-gray-700">Document associé à
                                la question</label>
                            <select name="document_id" id="document_id"
                                class="block w-full mt-1 rounded-md shadow-sm form-select">
                                <option value="">-- Choisir un document --</option>
                                @foreach ($documents as $document)
                                    <option value="{{ $document->id }}"
                                        {{ (old('document_id') ?? $question->document_id) == $document->id ? 'selected' : '' }}>
                                        {{ $document->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('document_id')
                                <p class="mt-1 text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <button class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Mettre
                            à jour
                        </button>
                    </form>
                </div>
            </div>
            <x-slot name="script">

            </x-slot>
        </div>
    </div>
</x-app-layout>
