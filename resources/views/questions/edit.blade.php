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
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="mb-6 text-2xl">Modifier la question</h2>
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

                        <div id="document_select_container" style="display: none;"> {{-- Select caché par défaut --}}
                            <div class="mb-4">
                                <label for="document_select"
                                    class="block text-sm font-medium text-gray-700">Sélectionner un document</label>
                                <select name="document_id" id="document_id"
                                    class="block w-full mt-1 rounded-md shadow-sm form-select">
                                    <option value="">-- Choisir un document --</option>
                                    @foreach ($documents as $document)
                                        <option value="{{ $document->id }}"
                                            {{ old('document_id', $question->document_id) == $document->id ? 'selected' : '' }}>
                                            {{ $document->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('document_id')
                                    <p class="mt-1 text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <button class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Mettre
                            à jour
                        </button>
                    </form>
                </div>
            </div>
            <x-slot name="script">
                <script type="text/javascript">
                    // Fonction pour afficher ou cacher le select en fonction du type de question sélectionné
                    function toggleDocumentSelect() {
                        var selectedTypeElement = document.querySelector('input[name="question_type"]:checked');
                        var documentSelect = document.getElementById('document_select_container');

                        // Affiche le select si 'complementary' est sélectionné, sinon cache-le
                        if (selectedTypeElement && selectedTypeElement.value === 'complementary') {
                            documentSelect.style.display = 'block';
                        } else {
                            documentSelect.style.display = 'none';
                        }
                    }

                    // Vérifie si un document est sélectionné lorsque 'complementary' est choisi
                    document.querySelector('form').addEventListener('submit', function(e) {
                        var selectedTypeElement = document.querySelector('input[name="question_type"]:checked');
                        var documentId = document.getElementById('document_id').value;

                        if (selectedTypeElement && selectedTypeElement.value === 'complementary' && documentId === '') {
                            e.preventDefault(); // Empêche la soumission du formulaire
                            alert('Veuillez sélectionner un document pour une question complémentaire.');
                        }
                    });

                    // Lors du chargement de la page, affiche le select si 'complementary' est déjà sélectionné
                    document.addEventListener("DOMContentLoaded", function() {
                        toggleDocumentSelect();

                        // Ajoute un écouteur pour chaque changement de sélection de type de question
                        var questionTypeRadios = document.querySelectorAll('input[name="question_type"]');
                        questionTypeRadios.forEach(function(radio) {
                            radio.addEventListener('change', toggleDocumentSelect);
                        });
                    });
                </script>
            </x-slot>

        </div>
    </div>
</x-app-layout>
