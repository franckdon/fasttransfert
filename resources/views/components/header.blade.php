<header id="site-header" class="fixed top-0 left-0 z-50 w-full bg-white shadow">
    <div class="container px-4 mx-auto sm:px-6 lg:px-8">
        <div class="flex items-center justify-between py-4">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="text-lg font-semibold text-gray-900">
                <img src="/images/logos/logo.png" alt="Logo" class="h-12">
            </a>

            <!-- Menu principal -->
            <nav class="hidden space-x-4 md:flex">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-gray-900">Accueil</a>
                <a href="#" class="text-gray-700 hover:text-gray-900">À propos</a>
                <a href="#" class="text-gray-700 hover:text-gray-900">Services</a>
                <a href="{{ route('contact') }}" class="text-gray-700 hover:text-gray-900">Contact</a>
            </nav>

            <!-- Boutons pour utilisateur non connecté -->
            @guest
                <div class="items-center hidden space-x-4 md:flex">
                    <a href="{{ route('login') }}"
                        class="px-4 py-4 text-gray-700 border-2 rounded-lg border-sky-900 hover:text-gray-900 hover:border-sky-700">Se
                        connecter</a>
                    <a href="{{ route('register') }}"
                        class="px-4 py-4 text-white rounded-lg bg-sky-900 hover:bg-sky-700">S'enregistrer</a>
                </div>
            @endguest

            <!-- Menu utilisateur connecté -->
            @auth
                <div class="items-center hidden space-x-4 md:flex">
                    <span class="text-gray-700">{{ Auth::user()->name }}</span>
                    <!-- Icône utilisateur -->
                    <div class="relative">
                        <button id="user-menu-button"
                            class="flex text-sm bg-gray-800 rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                            <img class="w-8 h-8 rounded-full"
                                src="{{ Auth::user()->profile_photo_url ?? 'https://via.placeholder.com/150' }}"
                                alt="{{ Auth::user()->name }}" />
                        </button>
                        <!-- Menu déroulant -->
                        <div id="user-menu"
                            class="absolute right-0 hidden w-48 py-1 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5">
                            <a href="{{ route('profile.edit') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Mon profil</a>
                            <a href="{{ route('demandes.index') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Mes demandes</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="block w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100">Déconnexion</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endauth

            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button id="mobile-menu-button"
                    class="text-gray-700 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile menu -->
        <div id="mobile-menu" class="hidden md:hidden">
            <nav class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ route('home') }}"
                    class="block px-3 py-2 text-base font-medium text-gray-700 rounded-md hover:text-gray-900 hover:bg-gray-50">Accueil</a>
                <a href="#"
                    class="block px-3 py-2 text-base font-medium text-gray-700 rounded-md hover:text-gray-900 hover:bg-gray-50">À
                    propos</a>
                <a href="#"
                    class="block px-3 py-2 text-base font-medium text-gray-700 rounded-md hover:text-gray-900 hover:bg-gray-50">Services</a>
                <a href="{{ route('contact') }}"
                    class="block px-3 py-2 text-base font-medium text-gray-700 rounded-md hover:text-gray-900 hover:bg-gray-50">Contact</a>

                @guest
                    <a href="{{ route('login') }}"
                        class="block px-3 py-2 text-base font-medium text-gray-700 rounded-md hover:text-gray-900 hover:bg-gray-50">Se
                        connecter</a>
                    <a href="{{ route('register') }}"
                        class="block px-3 py-2 text-base font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600">S'enregistrer</a>
                @endguest

                @auth
                    <a href="{{ route('profile.edit') }}"
                        class="block px-3 py-2 text-base font-medium text-gray-700 rounded-md hover:text-gray-900 hover:bg-gray-50">Mon
                        profil</a>
                    <a href="{{ route('demandes.index') }}"
                        class="block px-3 py-2 text-base font-medium text-gray-700 rounded-md hover:text-gray-900 hover:bg-gray-50">Mes
                        demandes</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="block w-full px-3 py-2 text-base font-medium text-left text-gray-700 rounded-md hover:bg-gray-50">Déconnexion</button>
                    </form>
                @endauth
            </nav>
        </div>
    </div>
</header>

<!-- Script pour le menu utilisateur -->
<script>
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        var menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });

    var userMenuButton = document.getElementById('user-menu-button');
    var userMenu = document.getElementById('user-menu');

    if (userMenuButton) {
        userMenuButton.addEventListener('click', function() {
            userMenu.classList.toggle('hidden');
        });

        // Fermer le menu si on clique en dehors
        window.addEventListener('click', function(e) {
            if (!userMenuButton.contains(e.target) && !userMenu.contains(e.target)) {
                userMenu.classList.add('hidden');
            }
        });
    }

    // Add shadow on scroll
    window.addEventListener('scroll', function() {
        var header = document.getElementById('site-header');
        if (window.scrollY > 50) {
            header.classList.add('shadow-lg', 'bg-gray-50');
        } else {
            header.classList.remove('shadow-lg', 'bg-gray-50');
        }
    });
</script>
