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


                        @if (auth()->user()->hasRole(['superadmin', 'assistance']))
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
                                            @if ($demandesRecentes->isNotEmpty())
                                                @foreach ($demandesRecentes as $demande)
                                                    <tr>
                                                        <td class="px-6 py-4 whitespace-nowrap">{{ $demande->id }}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap"><a href="#"
                                                                class="text-blue-500">
                                                                {{ $demande->demandeur->name }}
                                                            </a>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            {{ \Carbon\Carbon::parse($demande->created_at)->format('d M, Y') }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                    <div class="my-3">
                                        {{ $demandesRecentes->links() }}
                                    </div>
                                </div>

                                <!-- Activity Logs -->
                                <div class="p-6 bg-white rounded-lg shadow-lg">
                                    <h2 class="mb-4 text-lg font-bold">Journal d'activités</h2>
                                    <ul class="divide-y divide-gray-200">
                                        @if ($logs->isNotEmpty())
                                            @foreach ($logs as $log)
                                                <li class="flex items-center py-4">
                                                    <div
                                                        class="flex items-center justify-center w-10 h-10 text-white bg-blue-500 rounded-full">
                                                        F
                                                    </div>
                                                    <div class="ml-3">

                                                        @php
                                                            $daysDifference = \Carbon\Carbon::parse(
                                                                $log->created_at,
                                                            )->diffInDays(\Carbon\Carbon::now());
                                                            $hoursDifference = \Carbon\Carbon::parse(
                                                                $log->created_at,
                                                            )->diffInHours(\Carbon\Carbon::now());
                                                        @endphp

                                                        <p class="text-sm text-gray-700">
                                                            <strong>{{ $log->user->name }}</strong> mis à
                                                            jour
                                                            {{ $log->entity_type == 'App\Models\Demande' ? 'demande' : 'connecté' }}
                                                        </p>
                                                        <p class="text-xs text-gray-400">
                                                            ({{ \Carbon\Carbon::parse($log->created_at)->format('d M, Y') }})
                                                        </p>
                                                    </div>
                                                </li>
                                            @endforeach

                                        @endif
                                        <!-- Add more activity logs as needed -->
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
