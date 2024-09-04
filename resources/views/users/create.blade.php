<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            {{-- <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('create User') }}
            </h2> --}}
            <div class="flex items-right">
                <a href="{{ route('users.index') }}"
                    class="px-3 py-2 mt-5 ml-auto font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Back</a>
            </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="mb-6 text-2xl">Create user</h2>
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf

                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text" name="name" id="name" placeholder="Entrez le nom"
                                    class="block w-full mt-1 rounded-md shadow-sm form-input"
                                    value="{{ old('name') }}" />
                                @error('name')
                                    <p class="mt-1 text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email"
                                    class="block w-full mt-1 rounded-md shadow-sm form-input"
                                    placeholder="Entrez l'email" value="{{ old('email') }}" />
                                @error('email')
                                    <p class="mt-1 text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="telephone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                                <input type="text" name="telephone" id="telephone"
                                    class="block w-full mt-1 rounded-md shadow-sm form-input"
                                    placeholder="Entrez le numéro de téléphone" value="{{ old('telephone') }}" />
                                @error('telephone')
                                    <p class="mt-1 text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="domaine" class="block text-sm font-medium text-gray-700">Domaine
                                    d'activité</label>
                                <select name="domaine_id" id="domaine_id"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Sélectionnez un domaine</option>
                                    @foreach ($domaines as $domaine)
                                        <option value="{{ $domaine->id }}">{{ $domaine->name }}</option>
                                    @endforeach
                                </select>
                                @error('domaine_id')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <hr class="my-6">

                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <div class="mb-4">
                                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                <input type="password" name="password" id="password"
                                    class="block w-full mt-1 rounded-md shadow-sm form-input"
                                    value="{{ old('password') }}" />
                                @error('password')
                                    <p class="mt-1 text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="confirm_password" class="block text-sm font-medium text-gray-700">Confirm
                                    Password</label>
                                <input type="password" name="confirm_password" id="confirm_password"
                                    class="block w-full mt-1 rounded-md shadow-sm form-input"
                                    value="{{ old('confirm_password') }}" />
                                @error('confirm_password')
                                    <p class="mt-1 text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-4">
                            @if ($roles->isNotEmpty())
                                @foreach ($roles as $role)
                                    <div class="mt-3">
                                        <input type="checkbox" name="roles[]" value="{{ $role->name }}"
                                            id="role-{{ $role->id }}" class="rounded" />
                                        <label for="role-{{ $role->id }}">{{ $role->name }}</label>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <button
                            class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Create</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
