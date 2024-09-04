<x-auth-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="flex gap-3 mb-10 flex-column flex-md-row align-items-start">
            <div class="p-3 bg-white rounded">
                <svg class="icon text-primary svg-icon-ti-ti-lock" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z"></path>
                    <path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0"></path>
                    <path d="M8 11v-4a4 4 0 1 1 8 0v4"></path>
                </svg>
            </div>
            <div>
                <h3 class="mb-1 text-3xl fs-4">Connectez-vous à votre compte</h3>
                <p class="text-1xl text-muted">Vos données personnelles seront utilisées pour
                    soutenir votre expérience sur ce site Web, pour gérer l'accès à votre compte.</p>
            </div>
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nom')" />
            <x-text-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')"
                required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone Number -->
        <div class="mt-4">
            <x-input-label for="telephone" :value="__('Telephone')" />
            <x-text-input id="telephone" class="block w-full mt-1" type="text" name="telephone" :value="old('telephone')"
                required autocomplete="telephone" />
            <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
        </div>

        <!-- secteur -->
        <div class="mt-4">
            <x-input-label for="domaine_id" :value="__('Secteur d\'activité')" />
            <select id="domaine_id" name="domaine_id"
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500">
                <option value="">{{ __('Sélectionnez un secteur d\'activité') }}</option>
                @foreach ($domaines as $domaine)
                    <option value="{{ $domaine->id }}" {{ old('domaine') == $domaine->id ? 'selected' : '' }}>
                        {{ $domaine->name }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('domaine')" class="mt-2" />
        </div>




        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block w-full mt-1" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block w-full mt-1" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-auth-layout>
