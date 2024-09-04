<div class="p-4">
    <!-- Barre de recherche et actions -->
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center">
            <button class="p-2 mr-2 bg-gray-200 rounded">Bulk Actions</button>
            <button class="p-2 bg-gray-200 rounded">Filtres</button>
        </div>
        <input type="text" class="p-2 border rounded" placeholder="Rechercher..." wire:model.debounce.250ms="search">
    </div>

    <table class="min-w-full bg-white">
        <thead class="bg-gray-50">
            <tr class="border-b">
                <!-- Colonne ID -->
                <th class="px-4 py-2" wire:click="sortBy('id')">
                    ID @if ($sortField === 'id')
                        <span>{{ $sortAsc ? '▲' : '▼' }}</span>
                    @endif
                </th>
                <th class="px-4 py-2 text-left" wire:click="sortBy('name')">
                    Nom
                    @if ($sortField === 'name')
                        <span>{{ $sortAsc ? '▲' : '▼' }}</span>
                    @endif
                </th>
                <th class="px-4 py-2 text-left" wire:click="sortBy('email')">
                    Email
                    @if ($sortField === 'email')
                        <span>{{ $sortAsc ? '▲' : '▼' }}</span>
                    @endif
                </th>
                <th class="px-4 py-2 text-left">
                    Role
                    @if ($sortField === 'email')
                        <span>{{ $sortAsc ? '▲' : '▼' }}</span>
                    @endif
                </th>
                <th class="px-4 py-2 text-left" wire:click="sortBy('created_at')">
                    Created At
                    @if ($sortField === 'created_at')
                        <span>{{ $sortAsc ? '▲' : '▼' }}</span>
                    @endif
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr class="border-b">
                    <td class="px-4 py-2 border">{{ $item->id }}</td>
                    <td class="px-6 py-3 text-left">{{ $item->name }}</td>
                    <td class="px-6 py-3 text-left">{{ $item->email }}</td>
                    <td class="px-6 py-3 text-left"> {{ $item->roles->pluck('name')->implode(', ') }} </td>
                    <td class="px-6 py-3 text-left">{{ \Carbon\Carbon::parse($item->created_at)->format('d M, Y') }}
                    </td>
                    <!-- Actions pour l'édition/suppression -->
                    <td class="px-4 py-2 border">
                        @can('edit users')
                            <a href="{{ route('users.edit', $item->id) }}"
                                class="px-3 py-2 text-white rounded-sm bg-slate-700 hover:bg-slate-600">Edit</a>
                        @endcan
                        @can('delete users')
                            <a href="javascript:void(0);"
                                class="px-3 py-2 text-white bg-red-600 rounded-md hover:bg-red-700"
                                onclick="deleteUser({{ $item->id }})">Delete</a>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $data->links() }}
</div>
