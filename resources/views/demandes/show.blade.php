<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Détails de la Demande #{{ $demande->id }}
            </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 mb-6 bg-white rounded-lg shadow-md">
                    <h2 class="mb-4 text-2xl font-semibold">Informations de la Demande</h2>
                    <p class="text-gray-700"><strong>ID :</strong> {{ $demande->id }}</p>
                    <p class="text-gray-700"><strong>Créateur de la requête :</strong>
                        {{ $demande->user->name }}
                    </p>
                    <p class="text-gray-700"><strong>Date de Création :</strong>
                        {{ $demande->created_at->format('d M, Y H:i') }}
                    </p>
                    <p class="text-gray-700"><strong>Demandeur :</strong>
                        {{ $demande->demandeur->name }}
                    </p>
                    <p class="text-gray-700"><strong>Status :</strong>
                        <livewire:status-demande :demande="$demande" />
                    </p>
                    <p class="text-gray-700"><strong>Commentaire :</strong>
                        {{ $demande->historiques->last()->commentaire }}
                    </p>
                    @if (auth()->user()->hasRole(['superadmin', 'assistance']))
                        <div class="flex">
                            <div class="mt-4">
                                <livewire:update-status-popup :demande="$demande" />
                            </div>
                        </div>
                    @endif
                </div>


                <!-- Liste des fichiers associés -->
                <div class="p-6 bg-white rounded-lg shadow-md">
                    <h2 class="mb-4 text-2xl font-semibold">Fichiers Associés</h2>
                    @if ($demande->documents->isEmpty())
                        <p class="text-gray-600">Aucun fichier associé à cette demande.</p>
                    @else
                        <table class="w-full border-collapse">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="p-3 text-left">Nom du document</th>
                                    <th class="p-3 text-left">Action</th>
                                </tr>
                            </thead>
                            {{-- <tbody>
                                @foreach ($demande->documents as $document)
                                    <tr class="bg-gray-100">
                                        <td class="p-3 border-t">
                                            {{ $document->name }}
                                        </td>
                                        <td class="p-3 border-t">
                                            @if ($document->pivot->file_path)
                                                <a href="{{ asset('storage/' . $document->pivot->file_path) }}"
                                                    target="_blank"
                                                    class="inline-flex items-center text-red-500 hover:text-red-700">
                                                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                        stroke="currentColor" class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                                    </svg>

                                                    Télécharger
                                                </a>
                                            @else
                                                <span class="text-red-500">Non disponible</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody> --}}
                            <tbody>
                                @foreach ($demande->documents as $document)
                                    <tr class="bg-gray-100">
                                        <td class="p-3 border-t">
                                            {{ $document->name }}
                                        </td>
                                        <td class="p-3 border-t">
                                            @if ($document->pivot->file_path)
                                                @php
                                                    // Vérifier si le fichier existe physiquement
                                                    $filePath = 'storage/' . $document->pivot->file_path;
                                                @endphp
                                                @if (file_exists(public_path($filePath)))
                                                    <a href="{{ asset($filePath) }}" target="_blank"
                                                        class="inline-flex items-center text-red-500 hover:text-red-700">
                                                        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg"
                                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                            stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                                        </svg>
                                                        Télécharger
                                                    </a>
                                                @else
                                                    <span class="text-red-500">Fichier manquant</span>
                                                @endif
                                            @else
                                                <span class="text-red-500">Non disponible</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>


                        </table>
                    @endif
                </div>


                <!-- Bouton Retour -->
                <div class="mt-6">
                    <a href="{{ route('demandes.index') }}"
                        class="inline-block px-4 py-2 font-semibold text-white bg-blue-500 rounded hover:bg-blue-700">
                        Retour à la liste des demandes
                    </a>
                </div>
            </div>
            <x-slot name="script">
            </x-slot>
        </div>
    </div>
</x-app-layout>
