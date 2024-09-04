<div>
    @if ($step == 1)
        <!-- Étape 1: Paragraphe d'information avec H1 -->
        <div>
            <div class="p-6 text-gray-900">
                <h2 class="mb-6 text-2xl">Procédure de création de demande</h2>
                <p class="mb-6 text-lg">L’ordre de virement en français <b>SIGNE ET CACHETE PAR LES PERSONNES
                        HABILITEES</b>, contient les informations suivantes :</p>
                <ul class="mb-6">
                    <li>- DONNEUR D’ORDRE : Nom et prénom ou raison sociale, adresse, BP </li>
                    <li>- Compte à débiter </li>
                    <li>- Code devise ISO, montant en chiffre et en lettre </li>
                    <li>- BENEFICIARE : Nom et prénom ou raison sociale, adresse, BP Coordonnées bancaires Nom de la
                        banque, adresse BP, Numéro de l’IBAN, Swift ou BIC</li>
                </ul>
                <p class="mb-6 text-lg">Le montant en lettre correspond exactement au montant en chiffre</p>
                <p class="mb-6 text-lg">Les Frais et commissions (OUR SHA BEN) sont clairement mentionnés</p>

                <div class="mb-6">
                    <label for="reglement" class="block text-lg font-medium">Choisir un règlement</label>
                    <select wire:model="reglementId" id="reglement"
                        class="w-full px-4 py-2 mt-1 text-gray-700 bg-white border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Sélectionnez un règlement</option>
                        @foreach ($reglements as $reglement)
                            <option value="{{ $reglement->id }}">{{ $reglement->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="flex justify-end">
                <button wire:click="nextStep"
                    class="px-6 py-4 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                    Suivant
                </button>
            </div>
        </div>
    @elseif ($step == 2)
        <!-- Étape 2: Questions avec score dynamique -->
        <div class="p-6 bg-white rounded-lg shadow-md">
            @if (session()->has('error'))
                <div class="p-4 mb-4 text-red-700 bg-red-100 border border-red-400 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <div class="mb-6 text-lg font-semibold text-gray-700">
                <p>Les questions suivantes sont obligatoires pour la création de votre demande de transfert</p>
                {{-- <p>Score: {{ $score }} / {{ count($questions) }}</p> --}}
            </div>

            @if (auth()->user()->hasRole(['superadmin', 'assistance']))
                <div class="mb-6">
                    <label for="demandeur" class="block text-sm font-medium text-gray-700">Choisir le demandeur</label>
                    <select wire:model="demandeurId" id="demandeur"
                        class="w-full px-3 py-2 mt-1 text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Sélectionnez un demandeur</option>
                        @foreach ($demandeurs as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('demandeurId')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
            @endif

            @foreach ($questions as $index => $question)
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-700">{{ $question->intitule }}</label>
                    <div class="flex space-x-4">
                        <label class="inline-flex items-center">
                            <input type="radio" wire:model="responses.{{ $index }}" value="yes"
                                class="text-blue-600 border-gray-300 focus:ring-blue-500">
                            <span class="ml-2">Oui</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" wire:model="responses.{{ $index }}" value="no"
                                class="text-red-600 border-gray-300 focus:ring-red-500">
                            <span class="ml-2">Non</span>
                        </label>
                    </div>
                </div>
            @endforeach

            <div class="flex justify-between mt-6">
                <button wire:click="previousStep"
                    class="px-6 py-3 font-bold text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                    Précédent
                </button>
                <button wire:click="nextStep"
                    class="px-6 py-3 font-bold text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                    Suivant
                </button>
            </div>
        </div>
    @elseif ($step == 3)
        <!-- Étape 3: Téléversement des fichiers -->
        <div class="p-6 bg-white rounded-lg shadow-md">
            @foreach ($files as $file)
                <div class="mb-4">
                    <label for="file{{ $file->id }}" class="block mb-2 text-sm font-medium text-gray-700">
                        {{ $file->description }}
                    </label>
                    <input type="file" id="file{{ $file->id }}" wire:model="uploadedFiles.{{ $file->id }}"
                        class="block w-full text-sm text-gray-500 border border-gray-300 rounded-lg cursor-pointer focus:outline-none">
                    @error('filePaths.' . $file->id)
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            @endforeach

            <div class="flex justify-between mt-6">
                <button wire:click="previousStep"
                    class="px-6 py-3 font-bold text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                    Précédent
                </button>
                <button wire:click="submit"
                    class="px-6 py-3 font-bold text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                    Soumettre
                </button>
            </div>
        </div>
    @endif
</div>
