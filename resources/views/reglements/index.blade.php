<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Liste des reglements') }}
            </h2>
            @can('create reglements')
                <a href="{{ route('reglements.create') }}"
                    class="px-3 py-2 mt-5 ml-auto font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Créer un
                    règlement</a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            <x-message> </x-message>
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="mb-6 text-2xl">Liste des règlements</h2>
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr class="border-b">
                                <th class="px-6 py-3 text-left" width="60">#</th>
                                <th class="px-6 py-3 text-left">
                                    Libellé
                                </th>
                                {{-- <th class="px-6 py-3 text-left">Nombre de fichiers</th> --}}
                                <th class="px-6 py-3 text-left" width="80">
                                    Nbre fichiers
                                </th>
                                <th class="px-6 py-3 text-left" width="80">
                                    Nbre questions
                                </th>
                                <th class="px-6 py-3 text-center" width="280">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @if ($reglements->isNotEmpty())
                                @foreach ($reglements as $reglement)
                                    <tr class="border-b">
                                        <td class="px-6 py-3 text-left">
                                            <div class="text-sm font-medium leading-5 text-gray-900">
                                                {{ $loop->iteration }}
                                            </div>
                                        <td class="px-6 py-3 text-left">
                                            <div class="text-sm font-medium leading-5 text-gray-900">
                                                <span class="mr-10">{{ $reglement->title }}</span>

                                            </div>
                                        </td>
                                        <td class="px-6 py-3 text-left">
                                            <a href="{{ route('reglements.documents', $reglement->id) }}">
                                                <span
                                                    class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-yellow-300 border border-yellow-300">

                                                    {{ $reglement->documents->count() }}
                                                </span>
                                            </a>
                                            Fichier(s)
                                        </td>
                                        <td class="px-6 py-3 text-left">
                                            <a href="{{ route('questions.index', $reglement->id) }}">
                                                <span
                                                    class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-yellow-300 border border-yellow-300">

                                                    {{ $reglement->questions->count() }}
                                                </span>
                                            </a>
                                            question(s)
                                        </td>
                                        <td
                                            class="flex flex-row px-6 py-3 text-sm font-medium leading-5 text-center whitespace-no-wrap">

                                            @can('edit reglements')
                                                <x-buttons.edit-button :route="route('reglements.edit', $reglement->id)" />
                                            @endcan
                                            @can('delete reglements')
                                                <x-buttons.delete-button :id="$reglement->id" functionName="deleteReglement" />
                                            @endcan
                                            {{-- <a href="{{ route('questions.index', $reglement->id) }}"
                                                class="px-3 py-2 text-white rounded-md bg-sky-600 hover:bg-sky-700">Questions</a> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="my-3">
                        {{ $reglements->links() }}
                    </div>
                </div>
            </div>
            <x-slot name="script">
                <script type="text/javascript">
                    function deleteReglement(id) {
                        if (confirm('Are you sure you want to delete this reglement?')) {
                            $.ajax({
                                url: '{{ route('reglements.destroy') }}',
                                type: 'DELETE',
                                data: {
                                    id: id,
                                },
                                headers: {
                                    'x-csrf-token': '{{ csrf_token() }}'
                                },
                                dataType: 'json',
                                success: function(response) {
                                    window.location.href = '{{ route('reglements.index') }}';
                                }
                            });
                        }
                    }
                </script>
            </x-slot>
        </div>
    </div>
</x-app-layout>
