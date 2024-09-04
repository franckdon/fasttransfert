<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Companies List') }}
            </h2>
            @can('create companies')
                <a href="{{ route('companies.create') }}"
                    class="px-3 py-2 mt-5 ml-auto font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Créer
                    entreprise</a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            <x-message> </x-message>
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="mb-6 text-2xl">Liste des entreprises</h2>
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr class="border-b">
                                <th class="px-6 py-3 text-left" width="60">#</th>
                                <th class="px-6 py-3 text-left">
                                    Name
                                </th>
                                <th class="px-6 py-3 text-left">
                                    Email
                                </th>
                                <th class="px-6 py-3 text-left">
                                    phone
                                </th>
                                <th class="px-6 py-3 text-left">
                                    Siteweb
                                </th>
                                <th class="px-6 py-3 text-left" width="180">
                                    Created
                                </th>
                                <th class="px-6 py-3 text-center" width="180">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @if ($companies->isNotEmpty())
                                @foreach ($companies as $company)
                                    <tr class="border-b">
                                        <td class="px-6 py-3 text-left">
                                            <div class="text-sm font-medium leading-5 text-gray-900">
                                                {{ $loop->iteration }}
                                            </div>
                                        <td class="px-6 py-3 text-left">
                                            <div class="text-sm font-medium leading-5 text-gray-900">
                                                {{ $company->name }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 text-left">
                                            <div class="text-sm font-medium leading-5 text-gray-900">
                                                {{ $company->email }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 text-left">
                                            <div class="text-sm font-medium leading-5 text-gray-900">
                                                {{ $company->phone }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 text-left">
                                            <div class="text-sm font-medium leading-5 text-gray-900">
                                                {{ $company->website }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 text-left">
                                            <div class="text-sm leading-5 text-gray-500">
                                                {{ \Carbon\Carbon::parse($company->created_at)->format('d M, Y') }}
                                            </div>
                                        </td>
                                        <td
                                            class="px-6 py-3 text-sm font-medium leading-5 text-center whitespace-no-wrap">
                                            @can('edit companies')
                                                <a href="{{ route('companies.edit', $company->id) }}"
                                                    class="px-3 py-2 text-white rounded-sm bg-slate-700 hover:bg-slate-600">Edit</a>
                                            @endcan
                                            @can('delete companies')
                                                <a href="javascript:void(0);"
                                                    class="px-3 py-2 text-white bg-red-600 rounded-md hover:bg-red-700"
                                                    onclick="deleteCompany({{ $company->id }})">Delete</a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="my-3">
                        {{ $companies->links() }}
                    </div>
                </div>
            </div>
            <x-slot name="script">
                <script type="text/javascript">
                    function deleteCompany(id) {
                        if (confirm('Are you sure you want to delete this company?')) {
                            $.ajax({
                                url: '{{ route('companies.destroy') }}',
                                type: 'delete',
                                data: {
                                    id: id,
                                },
                                headers: {
                                    'x-csrf-token': '{{ csrf_token() }}'
                                },
                                dataType: 'json',
                                success: function(response) {
                                    window.location.href = '{{ route('companies.index') }}';
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
