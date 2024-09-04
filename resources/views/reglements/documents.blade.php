<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Liste des documents demandés pour ') }} {{ $reglement->title }}
            </h2>
            @can('create reglements')
                <button onclick="toggleModal()"
                    class="px-3 py-2 mt-5 ml-auto font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                    Ajouter
                </button>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            <x-message> </x-message>
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="mb-6 text-2xl">Liste des documents</h2>
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr class="border-b">
                                <th class="px-6 py-3 text-left" width="60">#</th>
                                <th class="px-6 py-3 text-left">
                                    Titre
                                </th>
                                <th class="px-6 py-3 text-left">
                                    Requis
                                </th>
                                <th class="px-6 py-3 text-center" width="280">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @if ($documents->isNotEmpty())
                                @foreach ($documents as $document)
                                    <tr class="border-b">
                                        <td class="px-6 py-3 text-left">
                                            <div class="text-sm font-medium leading-5 text-gray-900">
                                                {{ $loop->iteration }}
                                            </div>
                                        <td class="px-6 py-3 text-left">
                                            <div class="text-sm font-medium leading-5 text-gray-900">
                                                <span class="mr-10">{{ $document->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 text-left">
                                            <div class="text-sm font-medium leading-5 text-gray-900">
                                                <span class="mr-10">
                                                    @if ($document->pivot->is_required)
                                                        <span
                                                            class="px-2 py-1 text-xs font-medium text-white bg-red-500 rounded-md">Requis</span>
                                                    @else
                                                        <span
                                                            class="px-2 py-1 text-xs font-medium text-white bg-green-500 rounded-md">Non
                                                            requis</span>
                                                    @endif
                                                </span>
                                            </div>
                                        </td>
                                        <td
                                            class="px-6 py-3 text-sm font-medium leading-5 text-center whitespace-no-wrap">





                                            <a href="javascript:void(0);"
                                                class="px-3 py-2 text-white bg-red-600 rounded-md hover:bg-red-700"
                                                onclick="deleteDocument({{ $document->id }})">Delete</a>


                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="my-3">
                        {{-- {{ $documents->links() }} --}}
                    </div>
                </div>
            </div>


            <!-- Modal -->
            <div id="addDocumentModal"
                class="fixed inset-0 flex items-center justify-center hidden bg-black bg-opacity-50">
                <div class="w-1/3 p-8 bg-white rounded-lg">
                    <h2 class="mb-4 text-xl font-semibold">Ajouter un document</h2>
                    <form action="{{ route('reglements.documents.attach', $reglement->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="reglement_id" value="{{ $reglement->id }}">
                        <div class="mb-4">
                            <label for="document_id" class="block text-sm font-medium text-gray-700">Sélectionner un
                                document</label>
                            <select name="document_id" id="document_id" class="block w-full mt-1 rounded-md shadow-sm">
                                @foreach ($allDocuments as $document)
                                    <option value="{{ $document->id }}">{{ $document->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="is_required" class="form-checkbox">
                                <span class="ml-2">Requis</span>
                            </label>
                        </div>
                        <div class="flex justify-end">
                            <button type="button" onclick="toggleModal()"
                                class="px-4 py-2 mr-2 text-white bg-gray-500 rounded-md hover:bg-gray-700">Annuler</button>
                            <button type="submit"
                                class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-700">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>




            <x-slot name="script">
                <script type="text/javascript">
                    function toggleModal() {
                        document.getElementById('addDocumentModal').classList.toggle('hidden');
                    }

                    function deleteDocument(id) {
                        if (confirm('Are you sure you want to delete this reglement?')) {
                            $.ajax({
                                url: '{{ route('reglements.documents.detach', $document->id) }}',
                                type: 'DELETE',
                                data: {
                                    id: id,
                                },
                                headers: {
                                    'x-csrf-token': '{{ csrf_token() }}'
                                },
                                dataType: 'json',
                                success: function(response) {
                                    window.location.href = '{{ route('reglements.documents', $reglement->id) }}';
                                }
                            });
                        }
                    }
                </script>
            </x-slot>
        </div>
    </div>
</x-app-layout>
