<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Liste des demandes') }}
            </h2>
            @can('create demandes')
                <a href="{{ route('demandes.create') }}"
                    class="px-3 py-2 mt-5 ml-auto font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Créer une
                    demande
                </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            <x-message> </x-message>
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="mb-6 text-2xl">Liste des demandes</h2>
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr class="border-b">
                                <th class="px-6 py-3 text-left" width="60">#</th>
                                <th class="px-6 py-3 text-left">
                                    Créateur
                                </th>
                                <th class="px-6 py-3 text-left">
                                    Demandeur
                                </th>
                                <th class="px-6 py-3 text-left">
                                    Motif
                                </th>
                                <th class="px-6 py-3 text-center" width="60">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-left">
                                    Commentaire
                                </th>
                                <th class="px-6 py-3 text-left" width="180">
                                    Date de création
                                </th>
                                <th class="px-6 py-3 text-center" width="180">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @if ($demandes->isNotEmpty())
                                @foreach ($demandes as $demande)
                                    <tr class="border-b">
                                        <td class="px-6 py-3 text-left">
                                            <div class="text-sm font-medium leading-5 text-gray-900">
                                                {{ $loop->iteration }}
                                            </div>
                                        <td class="px-6 py-3 text-left">
                                            <div class="text-sm font-medium leading-5 text-gray-900">
                                                {{ $demande->user->name }}
                                            </div>
                                        </td>

                                        <td class="px-6 py-3 text-left">
                                            <div class="text-sm leading-5 text-gray-500">
                                                @if ($demande->demandeur_id)
                                                    {{ $demande->demandeur->name }}
                                                @else
                                                    Null
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 text-left">
                                            <div class="text-sm font-medium leading-5 text-gray-900">
                                                {{ $demande->reglement->title }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 text-left">
                                            <div class="text-sm font-medium leading-5 text-gray-900">
                                                <livewire:status-demande :demande="$demande" />
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 text-left">
                                            <div class="text-sm font-medium leading-5 text-gray-900">
                                                {{ $demande->historiques->last()->commentaire ?? '' }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 text-left">
                                            <div class="text-sm leading-5 text-gray-500">
                                                {{ \Carbon\Carbon::parse($demande->created_at)->format('d M, Y H:i') }}
                                            </div>
                                        </td>
                                        <td
                                            class="flex flex-row px-6 py-3 text-sm font-medium leading-5 text-center whitespace-no-wrap">
                                            @can('view demandes')
                                                <x-buttons.show-button :route="route('demandes.show', $demande->id)" />
                                            @endcan
                                            @can('delete demandes')
                                                <x-buttons.delete-button :id="$demande->id" functionName="deleteDemande" />
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="my-3">
                        {{ $demandes->links() }}
                    </div>
                </div>
            </div>
            <x-slot name="script">
                <script type="text/javascript">
                    function deleteDemande(id) {
                        if (confirm('Are you sure you want to delete this demande?')) {
                            $.ajax({
                                url: '{{ route('demandes.destroy') }}',
                                type: 'DELETE',
                                data: {
                                    id: id,
                                },
                                headers: {
                                    'x-csrf-token': '{{ csrf_token() }}'
                                },
                                dataType: 'json',
                                success: function(response) {
                                    window.location.href = '{{ route('demandes.index') }}';
                                }
                            });
                        }
                    }
                </script>
            </x-slot>
        </div>
    </div>
</x-app-layout>
