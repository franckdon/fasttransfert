<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            {{-- <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Users List') }}
            </h2> --}}
            @can('create users')
                <a href="{{ route('users.create') }}"
                    class="px-3 py-2 mt-5 ml-auto font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                    Créer un utilisateur</a>
                </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            <x-message> </x-message>
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="mb-6 text-2xl">Liste des utilisateurs</h2>
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr class="border-b">
                                <th class="px-6 py-3 text-left" width="60">#</th>
                                <th class="px-6 py-3 text-left">
                                    Nom
                                </th>
                                <th class="px-6 py-3 text-left">
                                    Email
                                </th>
                                <th class="px-6 py-3 text-left">
                                    Roles
                                </th>
                                <th class="px-6 py-3 text-left" width="180">
                                    crée le
                                </th>
                                <th class="px-6 py-3 text-center" width="180">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @if ($users->isNotEmpty())
                                @foreach ($users as $user)
                                    <tr class="border-b">
                                        <td class="px-6 py-3 text-left">
                                            <div class="text-sm font-medium leading-5 text-gray-900">
                                                {{ $loop->iteration }}
                                            </div>
                                        <td class="px-6 py-3 text-left">
                                            <div class="text-sm font-medium leading-5 text-gray-900">
                                                {{ $user->name }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 text-left">
                                            <div class="text-sm font-medium leading-5 text-gray-900">
                                                {{ $user->email }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 text-left">
                                            <div class="text-sm font-medium leading-5 text-gray-900">
                                                {{ $user->roles->pluck('name')->implode(', ') }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 text-left">
                                            <div class="text-sm leading-5 text-gray-500">
                                                {{ \Carbon\Carbon::parse($user->created_at)->format('d M, Y') }}
                                            </div>
                                        </td>
                                        <td
                                            class="flex flex-row px-6 py-3 text-sm font-medium leading-5 text-center whitespace-no-wrap">
                                            @can('edit users')
                                                <x-buttons.edit-button :route="route('users.edit', $user->id)" />
                                            @endcan
                                            @can('delete users')
                                                <x-buttons.delete-button :id="$user->id" functionName="deleteUser" />
                                            @endcan

                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="my-3">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
            <x-slot name="script">
                <script type="text/javascript">
                    function deleteUser(id) {
                        if (confirm('Are you sure you want to delete this user?')) {
                            $.ajax({
                                url: '{{ route('users.destroy') }}',
                                type: 'delete',
                                data: {
                                    id: id,
                                },
                                headers: {
                                    'x-csrf-token': '{{ csrf_token() }}'
                                },
                                dataType: 'json',
                                success: function(response) {
                                    window.location.href = '{{ route('users.index') }}';
                                }
                            });
                        }
                    }
                </script>
            </x-slot>
        </div>
    </div>
    {{-- @livewire('datatable', ['model' => \App\Models\User::class, 'searchableColumns' => ['name', 'email']]) --}}
</x-app-layout>
