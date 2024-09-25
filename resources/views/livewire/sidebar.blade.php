<div class="min-h-screen text-white bg-slate-700">
    <div class="w-full p-5 bg-white">
        <a href="{{ route('dashboard') }}">
            <img src="/images/logos/logo.png" alt="Logo" class="h-12">
        </a>
    </div>
    <div class="flex flex-col gap-2 p-2">

        <a href="{{ route('dashboard') }}" class="p-4 rounded bg-slate-700 hover:bg-slate-800">Tableau de bord</a>

        @if (auth()->user()->hasRole(['superadmin', 'assistance']))
            <div class="w-full" x-data="{ open: false }">
                <a x-on:click="open=!open" class="flex justify-between w-full p-4 rounded bg-sky-900 hover:bg-sky-950">
                    <span>Utilisateurs</span>
                    <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                    <svg x-show="open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                    </svg>


                </a>
                <div x-show="open" class="flex flex-col">
                    <a href="{{ route('users.index') }}" class="p-4 rounded bg-sky-900 hover:bg-sky-950">Liste</a>
                    <a href="{{ route('users.create') }}" class="p-4 rounded bg-sky-900 hover:bg-sky-950">Ajouter</a>
                </div>
            </div>
        @endif

        {{-- <div class="w-full" x-data="{ open: false }">
            <a x-on:click="open=!open" class="flex justify-between w-full p-4 rounded bg-sky-900 hover:bg-sky-950">
                <span>Entreprises</span>
                <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
                <svg x-show="open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                </svg>


            </a>
            <div x-show="open" class="flex flex-col">
                <a href="{{ route('companies.index') }}" class="p-4 rounded bg-sky-900 hover:bg-sky-950">Liste</a>
                <a href="{{ route('companies.create') }}" class="p-4 rounded bg-sky-900 hover:bg-sky-950">Ajouter</a>
            </div>
        </div> --}}

        <div class="w-full" x-data="{ open: false }">
            <a x-on:click="open=!open" class="flex justify-between w-full p-4 rounded bg-sky-900 hover:bg-sky-950">
                <span>Demandes</span>
                <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
                <svg x-show="open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                </svg>


            </a>
            <div x-show="open" class="flex flex-col">
                <a href="{{ route('demandes.create') }}" class="p-4 rounded bg-sky-900 hover:bg-sky-950">
                    Créer une demande
                </a>
                <a href="{{ route('demandes.index') }}" class="p-4 rounded bg-sky-900 hover:bg-sky-950">
                    Consulter les
                    demandes
                </a>
            </div>
        </div>
        @if (auth()->user()->hasRole(['superadmin', 'assistance']))
            <a href="{{ route('reglements.index') }}" class="p-4 rounded bg-sky-900 hover:bg-sky-950">
                Liste des règlements
            </a>
            <a href="{{ route('documents.index') }}" class="p-4 rounded bg-sky-900 hover:bg-sky-950">
                Liste des documents
            </a>
        @endif
        @if (auth()->user()->hasRole(['superadmin', 'assistance']))
            <div class="w-full" x-data="{ open: false }">
                <a x-on:click="open=!open" class="flex justify-between w-full p-4 rounded bg-sky-900 hover:bg-sky-950">
                    <span>Secteurs d'activité</span>
                    <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                    <svg x-show="open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                    </svg>


                </a>
                <div x-show="open" class="flex flex-col">
                    <a href="{{ route('domaines.index') }}" class="p-4 rounded bg-sky-900 hover:bg-sky-950">Liste</a>
                    <a href="{{ route('domaines.create') }}" class="p-4 rounded bg-sky-900 hover:bg-sky-950">Ajouter</a>
                </div>
            </div>
            <hr class="my-2 border-t border-white">
            <p class="px-2 text-sm">Sécurité</p>
            <div class="w-full" x-data="{ open: false }">
                <a x-on:click="open=!open"
                    class="flex justify-between w-full p-4 rounded bg-sky-900 hover:bg-sky-950">
                    <span>Roles</span>
                    <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                    <svg x-show="open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                    </svg>


                </a>
                <div x-show="open" class="flex flex-col">
                    <a href="{{ route('roles.index') }}" class="p-4 rounded bg-sky-900 hover:bg-sky-950">Liste</a>
                    <a href="{{ route('roles.create') }}" class="p-4 rounded bg-sky-900 hover:bg-sky-950">Ajouter</a>
                </div>
            </div>
            <div class="w-full" x-data="{ open: false }">
                <a x-on:click="open=!open"
                    class="flex justify-between w-full p-4 rounded bg-sky-900 hover:bg-sky-950">
                    <span>Autorisations</span>
                    <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                    <svg x-show="open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                    </svg>


                </a>
                <div x-show="open" class="flex flex-col">
                    <a href="{{ route('permissions.index') }}"
                        class="p-4 rounded bg-sky-900 hover:bg-sky-950">Liste</a>
                    <a href="{{ route('permissions.create') }}"
                        class="p-4 rounded bg-sky-900 hover:bg-sky-950">Ajouter</a>
                </div>
            </div>

            <hr class="my-2 border-t border-white">
            <p class="px-2 text-sm">Assistance</p>

            @php
                $unreadMessagesCount = \App\Models\Message::where('is_read', false)->count();
            @endphp

            <a href="{{ route('messages.index') }}"
                class="flex flex-row p-4 rounded bg-slate-700 hover:bg-slate-800">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                </svg>
                <span class="mx-2">Messages</span>
                @if ($unreadMessagesCount > 0)
                    <span
                        class="bg-red-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">{{ $unreadMessagesCount }}</span>
                @endif
            </a>

            <a href="{{ route('settings.index') }}"
                class="flex flex-row p-4 rounded bg-slate-700 hover:bg-slate-800">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
                <span class="mx-2">Paramètres</span>
            </a>
        @endif


        {{-- <div class="w-full" x-data="{ open: false }">
            <a x-on:click="open=!open" class="flex justify-between w-full p-4 rounded bg-sky-900 hover:bg-sky-950">
                <div class="flex justify-between">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    <span class="mx-2">Paramètres</span>
                </div>
                <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
                <svg x-show="open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                </svg>


            </a>
            <div x-show="open" class="flex flex-col">
                <a href="" class="p-4 rounded bg-sky-900 hover:bg-sky-950">Link</a>
                <a href="" class="p-4 rounded bg-sky-900 hover:bg-sky-950">Link</a>
                <a href="" class="p-4 rounded bg-sky-900 hover:bg-sky-950">Link</a>
            </div>
        </div>
        <a href="" class="p-4 rounded bg-sky-900 hover:bg-sky-950">Link</a>
        <a href="" class="p-4 rounded bg-sky-900 hover:bg-sky-950">Link</a>
        <a href="" class="p-4 rounded bg-sky-900 hover:bg-sky-950">Link</a> --}}
    </div>
</div>
