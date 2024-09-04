<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Email settings') }}
            </h2>
        </div>
        <div class="flex">
            @include('components.breadcrumb', ['items' => $items])
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="py-2 text-green-600">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                    <h2 class="mb-6 text-2xl">Envoi de mail</h2>

                    <form action="{{ route('settings.email.update') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700" for="mail_mailer">Mail
                                    Mailer</label>
                                <input class="block w-full mt-1 rounded-md shadow-sm form-input" type="text"
                                    name="mail_mailer"
                                    value="{{ old('mail_mailer', \App\Models\Setting::get('mail_mailer', env('MAIL_MAILER'))) }}">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700" for="mail_host">Mail Host</label>
                                <input class="block w-full mt-1 rounded-md shadow-sm form-input" type="text"
                                    name="mail_host"
                                    value="{{ old('mail_host', \App\Models\Setting::get('mail_host', env('MAIL_HOST'))) }}">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700" for="mail_port">Mail Port</label>
                                <input class="block w-full mt-1 rounded-md shadow-sm form-input" type="text"
                                    name="mail_port"
                                    value="{{ old('mail_port', \App\Models\Setting::get('mail_port', env('MAIL_PORT'))) }}">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700" for="mail_username">Nom
                                    d'utilisateur</label>
                                <input class="block w-full mt-1 rounded-md shadow-sm form-input" type="text"
                                    name="mail_username"
                                    value="{{ old('mail_username', \App\Models\Setting::get('mail_username', env('MAIL_USERNAME'))) }}">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700" for="mail_password">Mot de
                                    passe</label>
                                <input class="block w-full mt-1 rounded-md shadow-sm form-input" type="text"
                                    name="mail_password"
                                    value="{{ old('mail_password', \App\Models\Setting::get('mail_password', env('MAIL_PASSWORD'))) }}">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700"
                                    for="mail_encryption">Encryption</label>
                                <input class="block w-full mt-1 rounded-md shadow-sm form-input" type="text"
                                    name="mail_encryption"
                                    value="{{ old('mail_encryption', \App\Models\Setting::get('mail_encryption', env('MAIL_ENCRYPTION'))) }}">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700" for="mail_from_name">Nom de
                                    l'expéditeur</label>
                                <input class="block w-full mt-1 rounded-md shadow-sm form-input" type="text"
                                    name="mail_from_name"
                                    value="{{ old('mail_from_name', \App\Models\Setting::get('mail_from_name', env('MAIL_FROM_NAME'))) }}">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700" for="mail_from_address">Email de
                                    l'expéditeur</label>
                                <input class="block w-full mt-1 rounded-md shadow-sm form-input" type="text"
                                    name="mail_from_address"
                                    value="{{ old('mail_from_address', \App\Models\Setting::get('mail_from_address', env('MAIL_FROM_ADDRESS'))) }}">
                            </div>
                        </div>

                        <button class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700"
                            type="submit">Update Settings</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
