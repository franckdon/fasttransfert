<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Permissions List') }}
            </h2>
            @can('create permissions')
                <a href="{{ route('permissions.create') }}"
                    class="px-3 py-2 mt-5 ml-auto font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                    Créer une autorisation
                </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            <x-message> </x-message>
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="mb-6 text-2xl">Liste des autorisations</h2>
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr class="border-b">
                                <th class="px-6 py-3 text-left" width="60">#</th>
                                <th class="px-6 py-3 text-left">
                                    Nom
                                </th>
                                <th class="px-6 py-3 text-left" width="180">
                                    Date de création
                                </th>
                                <th class="px-6 py-3 text-center" width="180">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @if ($permissions->isNotEmpty())
                                @foreach ($permissions as $permission)
                                    <tr class="border-b">
                                        <td class="px-6 py-3 text-left">
                                            <div class="text-sm font-medium leading-5 text-gray-900">
                                                {{ $loop->iteration }}
                                            </div>
                                        <td class="px-6 py-3 text-left">
                                            <div class="text-sm font-medium leading-5 text-gray-900">
                                                {{ $permission->name }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 text-left">
                                            <div class="text-sm leading-5 text-gray-500">
                                                {{ \Carbon\Carbon::parse($permission->created_at)->format('d M, Y') }}
                                            </div>
                                        </td>
                                        <td
                                            class="flex flex-row px-6 py-3 text-sm font-medium leading-5 text-center whitespace-no-wrap">
                                            @can('edit permissions')
                                                <x-buttons.edit-button :route="route('permissions.edit', $permission->id)" />
                                            @endcan
                                            @can('delete permissions')
                                                <x-buttons.delete-button :id="$permission->id"
                                                    functionName="deletePermission" />
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="my-3">
                        {{ $permissions->links() }}
                    </div>
                </div>
            </div>
            <x-slot name="script">
                <script type="text/javascript">
                    function deletePermission(id) {
                        if (confirm('Are you sure you want to delete this permission?')) {
                            $.ajax({
                                url: '{{ route('permissions.destroy') }}',
                                type: 'DELETE',
                                data: {
                                    id: id,
                                },
                                headers: {
                                    'x-csrf-token': '{{ csrf_token() }}'
                                },
                                dataType: 'json',
                                success: function(response) {
                                    window.location.href = '{{ route('permissions.index') }}';
                                }
                            });
                        }
                    }
                </script>
            </x-slot>
        </div>
    </div>
</x-app-layout>
