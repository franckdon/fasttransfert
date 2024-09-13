<x-home-layout>
    <section class="pt-24 pb-16 bg-white md:pt-32">
        <div class="container items-center px-4 mx-auto sm:px-6 lg:px-8 md:flex-row">
            <div class="flex flex-col">
                <h1 class="text-4xl">Nous contacter</h1>
                <p class="mt-3 text-1xl">Remplissez le formulaire ci-dessous et nous vous répondrons dans les plus brefs
                    délais.</p>
            </div>
            <div class="flex flex-col items-center justify-between p-6 md:flex-row">
                <!-- Formulaire à gauche -->
                <div class="w-full md:w-1/2">
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf

                        <!-- Nom -->
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700">Nom & prénoms</label>
                            <input type="text" id="name" name="name"
                                class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"
                                required>
                        </div>

                        <!-- Adresse Email -->
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700">Adresse Email</label>
                            <input type="email" id="email" name="email"
                                class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"
                                required>
                        </div>

                        <!-- Numéro de Téléphone -->
                        <div class="mb-4">
                            <label for="telephone" class="block text-gray-700">Numéro de Téléphone</label>
                            <input type="tel" id="telephone" name="telephone"
                                class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"
                                required>
                        </div>

                        <!-- Sujet -->
                        <div class="mb-4">
                            <label for="subject" class="block text-gray-700">Sujet</label>
                            <select id="subject" name="subject"
                                class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"
                                required>
                                <option value="">Sélectionnez un sujet</option>
                                <option value="support">Support Technique</option>
                                <option value="commercial">Demande Commerciale</option>
                                <option value="autre">Autre</option>
                            </select>
                        </div>

                        <!-- Description -->
                        <div class="mb-6">
                            <label for="message" class="block text-gray-700">Description</label>
                            <textarea id="message" name="message" rows="4"
                                class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"
                                placeholder="Décrivez votre demande ici..." required></textarea>
                        </div>

                        <!-- Bouton Envoyer -->
                        <div class="text-center">
                            <button type="submit"
                                class="w-full px-4 py-2 font-bold text-white rounded-md bg-sky-900 hover:bg-sky-700 focus:outline-none focus:ring focus:ring-blue-300">
                                Envoyer
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Image à droite -->
                <div class="w-full mt-6 md:w-1/2 md:mt-0 md:ml-6">
                    <img src="{{ asset('images/contact-page.svg') }}" alt="Image illustrative"
                        class="w-full h-auto rounded-md shadow-md">
                </div>
            </div>

        </div>

    </section>
</x-home-layout>
