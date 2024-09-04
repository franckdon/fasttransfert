<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Edit Company') }}
            </h2>
            <div class="flex">
                <a href="{{ route('companies.index') }}"
                    class="px-3 py-2 mt-5 ml-auto font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Back</a>
            </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="mb-6 text-2xl">Modifier {{ $company->name }}</h2>
                    <form method="POST" action="{{ route('companies.update', $company->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-2">
                            <!-- Name Field -->
                            <div class="col-span-1">
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text" name="name" id="name"
                                    class="block w-full mt-1 rounded-md shadow-sm form-input"
                                    value="{{ old('name', $company->name) }}" />
                                @error('name')
                                    <p class="mt-1 text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email Field -->
                            <div class="col-span-1">
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email"
                                    class="block w-full mt-1 rounded-md shadow-sm form-input"
                                    placeholder="Entrez l'email" value="{{ old('email', $company->email) }}" />
                                @error('email')
                                    <p class="mt-1 text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Phone Field -->
                            <div class="col-span-1">
                                <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                                <input type="text" name="phone" id="phone"
                                    class="block w-full mt-1 rounded-md shadow-sm form-input"
                                    placeholder="Entrez le numéro de téléphone"
                                    value="{{ old('phone', $company->phone) }}" />
                                @error('phone')
                                    <p class="mt-1 text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Address Field -->
                            <div class="col-span-1">
                                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                                <input type="text" name="address" id="address"
                                    class="block w-full mt-1 rounded-md shadow-sm form-input"
                                    placeholder="Entrez l'adresse" value="{{ old('address', $company->address) }}" />
                                @error('address')
                                    <p class="mt-1 text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- website Field -->
                            <div class="col-span-1">
                                <label for="website" class="block text-sm font-medium text-gray-700">website</label>
                                <input type="text" name="website" id="website"
                                    class="block w-full mt-1 rounded-md shadow-sm form-input"
                                    placeholder="Entrez le siteweb " value="{{ old('website', $company->website) }}" />
                                @error('website')
                                    <p class="mt-1 text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Logo Field -->
                            <div class="col-span-1">
                                <label for="logo" class="block text-sm font-medium text-gray-700">Logo</label>
                                <input type="file" name="logo" id="logo"
                                    class="block w-full mt-1 rounded-md shadow-sm form-input" />
                                @error('logo')
                                    <p class="mt-1 text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <button class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                            Update
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
