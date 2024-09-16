<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Editer un Rôle') }}
            </h2>
            <a href="{{ route('roles.index') }}"
                class="px-3 py-2 mt-5 ml-auto font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Retour</a>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="mb-6 text-2xl">Edit {{ $role->name }}</h2>
                    <form method="POST" action="{{ route('roles.update', $role->id) }}">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Libellé du
                                rôle</label>
                            <input type="text" name="name" id="name"
                                class="block w-full mt-1 rounded-md shadow-sm form-input"
                                value="{{ old('name', $role->name) }}" />
                            @error('name')
                                <p class="mt-1 text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <section class="grid grid-cols-1 py-6 divide-y gap-y-3">
                            <details open class="py-1 text-sm group">
                                <summary
                                    class="flex cursor-pointer flex-row items-center justify-between py-1 font-semibold text-gray-800 marker:[font-size:0px]">
                                    Demandes
                                    <svg class="w-6 h-6 text-gray-400 transform rotate-0 group-open:rotate-180"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </summary>
                                <p class="text-gray-500">
                                <div class="grid grid-cols-4 mb-3">
                                    @if ($permissions->isNotEmpty())
                                        @foreach ($permissions as $permission)
                                            @if (strpos($permission, 'demandes') !== false)
                                                <div class="mt-3">
                                                    <input type="checkbox" name="permissions[]"
                                                        value="{{ $permission->name }}"
                                                        id="permission-{{ $permission->id }}" class="rounded"
                                                        {{ $hasPermissions->contains($permission->name) ? 'checked' : '' }} />
                                                    <label for="permission-{{ $permission->id }}"
                                                        class="">{{ $permission->name }}</label>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                                </p>
                            </details>

                            <details class="py-1 text-sm group">
                                <summary
                                    class="flex cursor-pointer flex-row items-center justify-between py-1 font-semibold text-gray-800 marker:[font-size:0px]">
                                    Reglements
                                    <svg class="w-6 h-6 text-gray-400 transform rotate-0 group-open:rotate-180"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </summary>
                                <p class="text-gray-500">
                                <div class="grid grid-cols-4 mb-3">
                                    @if ($permissions->isNotEmpty())
                                        @foreach ($permissions as $permission)
                                            @if (strpos($permission, 'reglements') !== false)
                                                <div class="mt-3">
                                                    <input type="checkbox" name="permissions[]"
                                                        value="{{ $permission->name }}"
                                                        id="permission-{{ $permission->id }}" class="rounded"
                                                        {{ $hasPermissions->contains($permission->name) ? 'checked' : '' }} />
                                                    <label for="permission-{{ $permission->id }}"
                                                        class="">{{ $permission->name }}</label>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                                </p>
                            </details>

                            <details class="py-1 text-sm group">
                                <summary
                                    class="flex cursor-pointer flex-row items-center justify-between py-1 font-semibold text-gray-800 marker:[font-size:0px]">
                                    Questions
                                    <svg class="w-6 h-6 text-gray-400 transform rotate-0 group-open:rotate-180"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </summary>
                                <p class="text-gray-500">
                                <div class="grid grid-cols-4 mb-3">
                                    @if ($permissions->isNotEmpty())
                                        @foreach ($permissions as $permission)
                                            @if (strpos($permission, 'questions') !== false)
                                                <div class="mt-3">
                                                    <input type="checkbox" name="permissions[]"
                                                        value="{{ $permission->name }}"
                                                        id="permission-{{ $permission->id }}" class="rounded"
                                                        {{ $hasPermissions->contains($permission->name) ? 'checked' : '' }} />
                                                    <label for="permission-{{ $permission->id }}"
                                                        class="">{{ $permission->name }}</label>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                                </p>
                            </details>

                            <details class="py-1 text-sm group">
                                <summary
                                    class="flex cursor-pointer flex-row items-center justify-between py-1 font-semibold text-gray-800 marker:[font-size:0px]">
                                    Secteurs d'activités
                                    <svg class="w-6 h-6 text-gray-400 transform rotate-0 group-open:rotate-180"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </summary>
                                <p class="text-gray-500">
                                <div class="grid grid-cols-4 mb-3">
                                    @if ($permissions->isNotEmpty())
                                        @foreach ($permissions as $permission)
                                            @if (strpos($permission, 'domaines') !== false)
                                                <div class="mt-3">
                                                    <input type="checkbox" name="permissions[]"
                                                        value="{{ $permission->name }}"
                                                        id="permission-{{ $permission->id }}" class="rounded"
                                                        {{ $hasPermissions->contains($permission->name) ? 'checked' : '' }} />
                                                    <label for="permission-{{ $permission->id }}"
                                                        class="">{{ $permission->name }}</label>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                                </p>
                            </details>

                            <details class="py-1 text-sm group">
                                <summary
                                    class="flex cursor-pointer flex-row items-center justify-between py-1 font-semibold text-gray-800 marker:[font-size:0px]">
                                    Autorisations
                                    <svg class="w-6 h-6 text-gray-400 transform rotate-0 group-open:rotate-180"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7">
                                        </path>
                                    </svg>
                                </summary>
                                <p class="text-gray-500">
                                <div class="grid grid-cols-4 mb-3">
                                    @if ($permissions->isNotEmpty())
                                        @foreach ($permissions as $permission)
                                            @if (strpos($permission, 'permissions') !== false)
                                                <div class="mt-3">
                                                    <input type="checkbox" name="permissions[]"
                                                        value="{{ $permission->name }}"
                                                        id="permission-{{ $permission->id }}" class="rounded"
                                                        {{ $hasPermissions->contains($permission->name) ? 'checked' : '' }} />
                                                    <label for="permission-{{ $permission->id }}"
                                                        class="">{{ $permission->name }}</label>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                                </p>
                            </details>

                            <details class="py-1 text-sm group">
                                <summary
                                    class="flex cursor-pointer flex-row items-center justify-between py-1 font-semibold text-gray-800 marker:[font-size:0px]">
                                    Roles
                                    <svg class="w-6 h-6 text-gray-400 transform rotate-0 group-open:rotate-180"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7">
                                        </path>
                                    </svg>
                                </summary>
                                <p class="text-gray-500">
                                <div class="grid grid-cols-4 mb-3">
                                    @if ($permissions->isNotEmpty())
                                        @foreach ($permissions as $permission)
                                            @if (strpos($permission, 'roles') !== false)
                                                <div class="mt-3">
                                                    <input type="checkbox" name="permissions[]"
                                                        value="{{ $permission->name }}"
                                                        id="permission-{{ $permission->id }}" class="rounded"
                                                        {{ $hasPermissions->contains($permission->name) ? 'checked' : '' }} />
                                                    <label for="permission-{{ $permission->id }}"
                                                        class="">{{ $permission->name }}</label>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                                </p>
                            </details>
                            <details class="py-1 text-sm group">
                                <summary
                                    class="flex cursor-pointer flex-row items-center justify-between py-1 font-semibold text-gray-800 marker:[font-size:0px]">
                                    Messages
                                    <svg class="w-6 h-6 text-gray-400 transform rotate-0 group-open:rotate-180"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7">
                                        </path>
                                    </svg>
                                </summary>
                                <p class="text-gray-500">
                                <div class="grid grid-cols-4 mb-3">
                                    @if ($permissions->isNotEmpty())
                                        @foreach ($permissions as $permission)
                                            @if (strpos($permission, 'messages') !== false)
                                                <div class="mt-3">
                                                    <input type="checkbox" name="permissions[]"
                                                        value="{{ $permission->name }}"
                                                        id="permission-{{ $permission->id }}" class="rounded"
                                                        {{ $hasPermissions->contains($permission->name) ? 'checked' : '' }} />
                                                    <label for="permission-{{ $permission->id }}"
                                                        class="">{{ $permission->name }}</label>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                                </p>
                            </details>
                            <details class="py-1 text-sm group">
                                <summary
                                    class="flex cursor-pointer flex-row items-center justify-between py-1 font-semibold text-gray-800 marker:[font-size:0px]">
                                    Utilisateurs
                                    <svg class="w-6 h-6 text-gray-400 transform rotate-0 group-open:rotate-180"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7">
                                        </path>
                                    </svg>
                                </summary>
                                <p class="text-gray-500">
                                <div class="grid grid-cols-4 mb-3">
                                    @if ($permissions->isNotEmpty())
                                        @foreach ($permissions as $permission)
                                            @if (strpos($permission, 'users') !== false)
                                                <div class="mt-3">
                                                    <input type="checkbox" name="permissions[]"
                                                        value="{{ $permission->name }}"
                                                        id="permission-{{ $permission->id }}" class="rounded"
                                                        {{ $hasPermissions->contains($permission->name) ? 'checked' : '' }} />
                                                    <label for="permission-{{ $permission->id }}"
                                                        class="">{{ $permission->name }}</label>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                                </p>
                            </details>
                        </section>

                        {{-- <div class="grid grid-cols-4 mb-3">
                            @if ($permissions->isNotEmpty())
                                @foreach ($permissions as $permission)
                                    <div class="mt-3">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                            id="permission-{{ $permission->id }}" class="rounded"
                                            {{ $hasPermissions->contains($permission->name) ? 'checked' : '' }} />
                                        <label for="permission-{{ $permission->id }}"
                                            class="">{{ $permission->name }}</label>
                                    </div>
                                @endforeach
                            @endif
                        </div> --}}

                        <button
                            class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Modifier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
