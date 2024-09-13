<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            {{-- <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Liste des demandes') }}
            </h2> --}}
            {{-- @can('create demandes')
                <a href="{{ route('demandes.create') }}"
                    class="px-3 py-2 mt-5 ml-auto font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Créer une
                    demande
                </a>
            @endcan --}}
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            <x-message> </x-message>
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="mb-6 text-2xl">Logs des activités</h2>
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr class="border-b">
                                <th class="px-6 py-3 text-left">Date</th>
                                <th class="px-6 py-3 text-left">
                                    Description
                                </th>
                                <th class="px-6 py-3 text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @if ($logs->isNotEmpty())
                                @foreach ($logs as $log)
                                    <tr class="border-b">
                                        <td class="px-6 py-3 text-left">
                                            <div class="text-sm font-medium leading-5 text-gray-900">
                                                {{ \Carbon\Carbon::parse($log->created_at)->format('d M, Y H:i') }}
                                            </div>
                                        <td class="px-6 py-3 text-left">
                                            <div class="text-sm font-medium leading-5 text-gray-900">
                                                {{ $log->description }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 text-left">
                                            @can('delete logs')
                                                <x-buttons.delete-button :id="$log->id" functionName="deleteLog" />
                                            @endcan
                                        </td>

                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="my-3">
                        {{ $logs->links() }}
                    </div>
                </div>
            </div>
            <x-slot name="script">
                <script type="text/javascript">
                    function deleteLog(id) {
                        if (confirm('Are you sure you want to delete this history?')) {
                            $.ajax({
                                url: '{{ route('logs.destroy') }}',
                                type: 'DELETE',
                                data: {
                                    id: id,
                                },
                                headers: {
                                    'x-csrf-token': '{{ csrf_token() }}'
                                },
                                dataType: 'json',
                                success: function(response) {
                                    window.location.href = '{{ route('activity.logs') }}';
                                }
                            });
                        }
                    }
                </script>
            </x-slot>
        </div>
    </div>
</x-app-layout>
