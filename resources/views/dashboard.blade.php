<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- {{ __("You're logged in!") }} --}}
                    <div class="container">

                        <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-4">
                            <a href="{{ route('demandes.index') }}">
                                <x-stats-card count="{{ $demandes }}" title="Demandes" bgColor="blue-500" />
                            </a>
                            <x-stats-card count="{{ $demandesPending }}" title="en attente" bgColor="yellow-500" />
                            <x-stats-card count="{{ $demandesApproved }}" title="Acceptées" bgColor="green-500" />
                            <x-stats-card count="{{ $demandesRejected }}" title="Rejetées" bgColor="red-500" />
                        </div>



                        <!-- Recent Posts and Activity Logs -->
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <!-- Recent Posts -->
                            <div class="p-6 bg-white rounded-lg shadow-lg">
                                <h2 class="mb-4 text-lg font-bold">Demandes récentes</h2>
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr>
                                            <th
                                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                #</th>
                                            <th
                                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                Entreprise</th>
                                            <th
                                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                Créé à</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">1</td>
                                            <td class="px-6 py-4 whitespace-nowrap"><a href="#"
                                                    class="text-blue-500">9 Things I Love About Shaving My Head</a></td>
                                            <td class="px-6 py-4 whitespace-nowrap">2024-07-13</td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">2</td>
                                            <td class="px-6 py-4 whitespace-nowrap"><a href="#"
                                                    class="text-blue-500">Why Teamwork Really Makes The Dream Work</a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">2024-07-13</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Activity Logs -->
                            <div class="p-6 bg-white rounded-lg shadow-lg">
                                <h2 class="mb-4 text-lg font-bold">Journal d'activités</h2>
                                <ul class="divide-y divide-gray-200">
                                    <li class="flex items-center py-4">
                                        <div
                                            class="flex items-center justify-center w-10 h-10 text-white bg-blue-500 rounded-full">
                                            F
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm text-gray-700"><strong>Franck BASSA</strong> mis à jour
                                                shipping-rule-item "Livraison a"</p>
                                            <p class="text-xs text-gray-400">il y a 3 jours (41.207.209.134)</p>
                                        </div>
                                    </li>
                                    <li class="flex items-center py-4">
                                        <div
                                            class="flex items-center justify-center w-10 h-10 text-white bg-blue-500 rounded-full">
                                            F
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm text-gray-700"><strong>Franck BASSA</strong> mis à jour
                                                shipping-rule-item "Livraison par colissimo (5 à 10...)"</p>
                                            <p class="text-xs text-gray-400">il y a 3 jours (41.207.209.134)</p>
                                        </div>
                                    </li>
                                    <!-- Add more activity logs as needed -->
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
