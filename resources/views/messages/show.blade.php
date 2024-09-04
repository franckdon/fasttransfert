<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Create Permission') }}
            </h2>
            <a href="{{ route('permissions.index') }}"
                class="px-3 py-2 mt-5 ml-auto font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Back</a>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="mb-6 text-2xl">Message #{{ $message->id }}</h2>

                    <div class="mb-4">
                        <label for="name" class="block text-gray-700">Nom & Prénoms</label>
                        <input type="text" id="name" name="name" value="{{ $message->name }}"
                            class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"
                            required disabled>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700">Adresse Email</label>
                        <input type="email" id="email" name="email" value="{{ $message->email }}"
                            class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"
                            required disabled>
                    </div>

                    <div class="mb-4">
                        <label for="telephone" class="block text-gray-700">Numéro de Téléphone</label>
                        <input type="tel" id="telephone" name="telephone" value="{{ $message->telephone }}"
                            class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"
                            required disabled>
                    </div>

                    <div class="mb-4">
                        <label for="subject" class="block text-gray-700">Sujet</label>
                        <input type="text" id="subject" name="subject" value="{{ $message->subject }}"
                            class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"
                            required disabled>
                    </div>

                    <div class="mb-6">
                        <label for="message" class="block text-gray-700">Description</label>
                        <textarea id="message" name="message" rows="4"
                            class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"
                            placeholder="Décrivez votre demande ici..." required disabled>
                        {{ $message->message }}</textarea>

                    </div>

                    <div class="text-center">
                        <a href="{{ route('messages.index') }}"
                            class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300">Retour</a>
                    </div>



                </div>
            </div>
        </div>
    </div>
</x-app-layout>
