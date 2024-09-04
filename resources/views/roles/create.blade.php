<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Create Role') }}
            </h2>
            <a href="{{ route('roles.index') }}"
                class="px-3 py-2 mt-5 ml-auto font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Back</a>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="mb-6 text-2xl">Create Role</h2>
                    <form method="POST" action="{{ route('roles.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" name="name" id="name"
                                class="block w-full mt-1 rounded-md shadow-sm form-input" value="{{ old('name') }}" />
                            @error('name')
                                <p class="mt-1 text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-4 mb-3">
                            @if ($permissions->isNotEmpty())
                                @foreach ($permissions as $permission)
                                    <div class="mt-3">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                            id="permission-{{ $permission->id }}" class="rounded"
                                            {{ in_array($permission->id, old('permissions', [])) ? 'checked' : '' }} />
                                        <label for="permission-{{ $permission->id }}"
                                            class="">{{ $permission->name }}</label>
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
