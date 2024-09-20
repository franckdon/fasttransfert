<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Créer une question') }}
            </h2>
            <a href="{{ route('reglements.index') }}"
                class="px-3 py-2 mt-5 ml-auto font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Retour</a>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="mb-6 text-2xl">Créer une question</h2>
                    <form method="POST" action="{{ route('questions.store', $reglement->id) }}">
                        @csrf
                        <div class="mb-4">
                            <input type="hidden" name="reglement_id" value="{{ $reglement->id }}">

                            <label for="intitule" class="block text-sm font-medium text-gray-700">Libellé de la
                                question</label>
                            <input type="text" name="intitule" id="intitule"
                                class="block w-full mt-1 rounded-md shadow-sm form-input"
                                value="{{ old('intitule') }}" />
                            @error('intitule')
                                <p class="mt-1 text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Type de question</label>
                            <div class="mt-2">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="question_type" value="required" class="form-radio"
                                        {{ old('question_type') == 'required' ? 'checked' : '' }}
                                        onclick="toggleDocumentSelect()">
                                    <span class="ml-2 text-sm text-gray-700">Question obligatoire</span>
                                </label>
                            </div>
                            <div class="mt-2">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="question_type" value="complementary" class="form-radio"
                                        {{ old('question_type') == 'complementary' ? 'checked' : '' }}
                                        onclick="toggleDocumentSelect()">
                                    <span class="ml-2 text-sm text-gray-700">Question complémentaire</span>
                                </label>
                            </div>
                            @error('question_type')
                                <p class="mt-1 text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4" id="document_select" style="display: none;">
                            <label for="document_id" class="block text-sm font-medium text-gray-700">Document
                                associé à la question</label>
                            <select name="document_id" id="document_id"
                                class="block w-full mt-1 rounded-md shadow-sm form-select">
                                <option value="">-- Choisir un document --</option>
                                @foreach ($documents as $document)
                                    <option value="{{ $document->id }}"
                                        {{ old('document_id') == $document->id ? 'selected' : '' }}>
                                        {{ $document->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('document_id')
                                <p class="mt-1 text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <button
                            class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Ajouter</button>
                    </form>
                </div>
            </div>
            <x-slot name="script">
                <script type="text/javascript">
                    function toggleDocumentSelect() {
                        var selectedTypeElement = document.querySelector('input[name="question_type"]:checked');

                        if (selectedTypeElement) {
                            var selectedType = selectedTypeElement.value;
                            var documentSelect = document.getElementById('document_select');
                            documentSelect.style.display = (selectedType === 'complementary') ? 'block' : 'none';
                        }
                    }

                    // Vérifie que le document est sélectionné si la question est complémentaire
                    document.querySelector('form').addEventListener('submit', function(e) {
                        var selectedTypeElement = document.querySelector('input[name="question_type"]:checked');

                        if (selectedTypeElement) {
                            var selectedType = selectedTypeElement.value;
                            var documentId = document.getElementById('document_id').value;

                            if (selectedType === 'complementary' && documentId === '') {
                                e.preventDefault(); // Empêche la soumission du formulaire
                                alert('Veuillez sélectionner un document pour une question complémentaire.');
                            }
                        }
                    });

                    // Affiche le select document si la case complémentaire est cochée lors du chargement
                    document.addEventListener("DOMContentLoaded", function() {
                        toggleDocumentSelect();
                    });
                </script>
            </x-slot>

        </div>
    </div>
</x-app-layout>
