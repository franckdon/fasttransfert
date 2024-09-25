<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | Transfert de document en ligne</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @livewireStyles

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans antialiased">

    <div class="flex h-screen" x-data="{ sidebar: true, mobile: false }">
        <div x-show="mobile" class="fixed w-full h-screen bg-white md:hidden md:w-1/5 lg:w-1/6">
            <a class="float-right p-4 cursor-pointer" x-on:click="mobile = !mobile">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </a>
            @livewire('sidebar')
        </div>
        <div x-show="sidebar" class="hidden md:block md:w-1/5 lg:w-1/6">
            @livewire('sidebar')
        </div>
        <div class="flex-grow min-h-screen bg-gray-100">
            <div class="flex">
                <div class="p-5 bg-white">
                    <a class="hidden cursor-pointer md:block" x-on:click="sidebar = !sidebar">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </a>

                    <a class="block cursor-pointer md:hidden" x-on:click="mobile = !mobile">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </a>
                </div>
                <div class="flex-grow"> @include('layouts.navigation')</div>
            </div>




            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>


            <div class="py-6 mt-10 text-black bg-white">
                <div class="px-4 mx-auto max-w-7xl">
                    <div class="flex flex-col items-center justify-between md:flex-row">
                        <div class="mb-4 md:mb-0">
                            <p class="text-sm">
                                &copy; {{ date('Y') }} <a href="https://www.kfm-consulting.com" target="_blanck">KFM
                                    CONSULTING</a>. Tous droits réservés.
                            </p>
                        </div>
                        <div>
                            <ul class="flex space-x-4">
                                <li>
                                    <a href="{{ route('contact') }}"
                                        class="text-gray-400 hover:text-gray-300">Contact</a>
                                </li>
                                <li>
                                    <a href="{{ route('home') }}" class="text-gray-400 hover:text-gray-300">À propos</a>
                                </li>
                                <li>
                                    <a href="" class="text-gray-400 hover:text-gray-300">Politique de
                                        confidentialité</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @livewireScripts
</body>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
@isset($script)
    {{ $script }}
@endisset

</html>
