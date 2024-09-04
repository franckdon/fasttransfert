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

            <x-message> </x-message>
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">


                <div class="p-6 bg-white rounded-lg shadow-md">
                    <h2 class="mb-6 text-lg font-semibold text-gray-700">Common</h2>
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        <!-- Card Item -->
                        <div class="flex items-start space-x-3">
                            <div class="p-3 bg-gray-100 rounded-full">
                                <svg class="w-6 h-6 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                            </div>
                            <div>
                                <a href="{{ route('settings.general') }}"
                                    class="font-semibold text-blue-600">General</a>
                                <p class="text-sm text-gray-500">View and update your general settings and activate
                                    license</p>
                            </div>
                        </div>

                        <!-- Repeat for other cards -->
                        <div class="flex items-start space-x-3">
                            <div class="p-3 bg-gray-100 rounded-full">
                                <svg class="w-6 h-6 text-gray-600" fill="currentColor" viewBox="0 0 24 24"><svg
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                    </svg>
                                </svg>
                            </div>
                            <div>
                                <a href="{{ route('settings.email') }}" class="font-semibold text-blue-600">Email</a>
                                <p class="text-sm text-gray-500">View and update your email settings and email templates
                                </p>
                            </div>
                        </div>

                        <!-- Continue with the rest of the items... -->

                        <div class="flex items-start space-x-3">
                            <div class="p-3 bg-gray-100 rounded-full">
                                <svg class="w-6 h-6 text-gray-600" fill="currentColor"
                                    viewBox="0 0 24 24"><!-- Icon SVG --></svg>
                            </div>
                            <div>
                                <a href="#" class="font-semibold text-blue-600">Email templates</a>
                                <p class="text-sm text-gray-500">Email templates using HTML & system variables.</p>
                            </div>
                        </div>
                    </div>
                </div>




            </div>
            <x-slot name="script">

            </x-slot>
        </div>
    </div>

</x-app-layout>
