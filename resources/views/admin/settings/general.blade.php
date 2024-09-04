<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Parametres') }}
            </h2>
        </div>
        <div class="flex">
            @include('components.breadcrumb', ['items' => $items])
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex flex-wrap">
                <div class="w-full p-4 md:w-1/3">
                    <h2 class="mb-4 text-3xl">Général</h2>
                    <p class="text-muted">Paramétrage des informations sur le site</p>
                </div>

                <div class="w-full p-5 bg-white rounded md:w-2/3 card">

                    <form method="POST" action="{{ route('settings.general.update') }}" enctype="multipart/form-data">
                        <div class="card-body">
                            @csrf
                            <div class="flex flex-wrap mb-4 -mx-2">
                                <!-- Nom du site -->
                                <div class="w-full px-2 md:w-1/2">
                                    <label for="site_name" class="block text-sm font-medium text-gray-700">Nom du
                                        site</label>
                                    <input type="text" name="site_name" id="site_name"
                                        class="block w-full mt-1 rounded-md shadow-sm form-input"
                                        value="{{ old('site_name', \App\Models\Setting::get('site_name')) }}" />
                                    @error('site_name')
                                        <p class="mt-1 text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                <!-- Titre du site -->
                                <div class="w-full px-2 md:w-1/2">
                                    <label for="site_title" class="block text-sm font-medium text-gray-700">Titre du
                                        site</label>
                                    <input type="text" name="site_title" id="site_title"
                                        class="block w-full mt-1 rounded-md shadow-sm form-input"
                                        value="{{ old('site_title', \App\Models\Setting::get('site_title')) }}" />
                                    @error('site_title')
                                        <p class="mt-1 text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="site_description"
                                    class="block text-sm font-medium text-gray-700">Description du
                                    site
                                </label>
                                <input type="text" name="site_description" id="site_description"
                                    class="block w-full mt-1 rounded-md shadow-sm form-input"
                                    value="{{ old('site_description', \App\Models\Setting::get('site_description')) }}" />
                                @error('site_description')
                                    <p class="mt-1 text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex flex-wrap mb-4 -mx-2">

                                <div class="w-full px-2 md:w-1/2">
                                    <label for="site_address"
                                        class="block text-sm font-medium text-gray-700">Adresse</label>
                                    <input type="text" name="site_address" id="site_address"
                                        class="block w-full mt-1 rounded-md shadow-sm form-input"
                                        value="{{ old('site_address', \App\Models\Setting::get('site_address')) }}" />
                                    @error('site_address')
                                        <p class="mt-1 text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="w-full px-2 md:w-1/2">
                                    <label for="site_email" class="block text-sm font-medium text-gray-700">Email de
                                        contact</label>
                                    <input type="email" name="site_email" id="site_email"
                                        class="block w-full mt-1 rounded-md shadow-sm form-input"
                                        value="{{ old('site_email', \App\Models\Setting::get('site_email')) }}" />
                                    @error('site_email')
                                        <p class="mt-1 text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="flex flex-wrap mb-4 -mx-2">

                                <div class="w-full px-2 md:w-1/2">
                                    <label for="site_phone" class="block text-sm font-medium text-gray-700">Numéro de
                                        tel</label>
                                    <input type="text" name="site_phone" id="site_phone"
                                        class="block w-full mt-1 rounded-md shadow-sm form-input"
                                        value="{{ old('site_phone', \App\Models\Setting::get('site_phone')) }}" />
                                    @error('site_phone')
                                        <p class="mt-1 text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="email" class="block text-sm font-medium text-gray-700">Email de
                                    l'administrateur</label>
                                <input type="email" name="email" id="email"
                                    class="block w-full mt-1 rounded-md shadow-sm form-input"
                                    value="{{ old('email', \App\Models\Setting::get('site_email')) }}" />
                                @error('email')
                                    <p class="mt-1 text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- <div class="mb-4">
                                <div class="flex flex-wrap -mx-2">
                                    <!-- Logo du site -->
                                    <div class="w-full px-2 md:w-1/2">
                                        <label for="site_logo" class="block text-sm font-medium text-gray-700">Logo du
                                            site</label>

                                        <!-- Container for the logo preview -->
                                        <div class="mt-2">
                                            <div
                                                class="flex items-center justify-center w-32 h-32 overflow-hidden bg-gray-100 rounded-md">
                                                <img src="{{ old('site_logo') ? asset('images/' . old('site_logo')) : (\App\Models\Setting::get('site_logo') ? asset('images/' . \App\Models\Setting::get('site_logo')) : '') }}"
                                                    alt="Logo du site" class="object-cover w-full h-full">
                                            </div>
                                        </div>

                                        <!-- File input for logo -->
                                        <input type="file" name="site_logo" id="site_logo" class="block w-full mt-1"
                                            accept=".png, .jpg, .jpeg" onchange="previewLogo(event)">

                                        <!-- Legend -->
                                        <p class="mt-1 text-sm text-gray-500">Taille recommandée : 512x512px. Extensions
                                            acceptées : .png, .jpg, .jpeg</p>

                                        @error('site_logo')
                                            <p class="mt-1 text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Favicon du site -->
                                    <div class="w-full px-2 md:w-1/2">
                                        <label for="site_favicon"
                                            class="block text-sm font-medium text-gray-700">Favicon du site</label>

                                        <!-- Container for the favicon preview -->
                                        <div class="mt-2">
                                            <div
                                                class="flex items-center justify-center w-32 h-32 overflow-hidden bg-gray-100 rounded-md">
                                                <img id="favicon-preview"
                                                    src="{{ old('site_favicon') ? asset('path_to_existing_favicon') : '' }}"
                                                    alt="Aperçu du favicon" class="object-cover w-full h-full"
                                                    style="display: {{ old('site_favicon') ? 'block' : 'none' }};">
                                            </div>
                                        </div>

                                        <!-- File input for favicon -->
                                        <input type="file" name="site_favicon" id="site_favicon"
                                            class="block w-full mt-1" accept=".png, .jpg, .ico"
                                            onchange="previewFavicon(event)">

                                        <!-- Legend -->
                                        <p class="mt-1 text-sm text-gray-500">Taille recommandée : 32x32px ou 64x64px.
                                            Extensions acceptées : .png, .ico</p>

                                        @error('site_favicon')
                                            <p class="mt-1 text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div> --}}

                            <button
                                class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Enregistrer</button>
                        </div>
                    </form>


                    <x-message></x-message>
                    <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg"></div>
                </div>

                <x-slot name="script">
                    <script>
                        function previewLogo(event) {
                            const preview = document.getElementById('logo-preview');
                            const file = event.target.files[0];
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    preview.src = e.target.result;
                                    preview.style.display = 'block';
                                };
                                reader.readAsDataURL(file);
                            }
                        }

                        function previewFavicon(event) {
                            const preview = document.getElementById('favicon-preview');
                            const file = event.target.files[0];
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    preview.src = e.target.result;
                                    preview.style.display = 'block';
                                };
                                reader.readAsDataURL(file);
                            }
                        }
                    </script>
                </x-slot>

            </div>


</x-app-layout>
