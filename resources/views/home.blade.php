<x-home-layout>

    <section class="pt-24 pb-16 bg-white md:pt-32">
        <div class="container flex flex-col items-center px-4 mx-auto sm:px-6 lg:px-8 md:flex-row">
            <!-- Contenu à gauche -->
            <div class="text-center md:w-1/2 md:text-left md:pr-8">
                <h1 class="mb-4 text-4xl font-bold sm:text-5xl lg:text-6xl">
                    Bienvenue sur <span class="text-sky-800">MyFastTransfer</span>
                </h1>
                <h2 class="mb-4 text-2xl text-gray-700 sm:text-3xl lg:text-4xl">
                    Sous-titre accrocheur
                </h2>
                <p class="mb-6 text-lg text-gray-600 sm:text-xl">
                    Une brève description de ce que vous proposez. Attirez l'attention avec quelques phrases percutantes
                    et engageantes.
                </p>
                <a href="#" class="px-6 py-3 text-lg text-white bg-blue-500 rounded-md hover:bg-blue-600">
                    Découvrir
                </a>
            </div>

            <!-- Image à droite -->
            <div class="mt-8 md:w-1/2 md:mt-0">
                <img src="/images/design-illustration.svg" alt="Hero Image" class="w-full h-auto rounded-lg">
            </div>
        </div>
    </section>
    </div>

    <section class="bg-white dark:bg-gray-900">
        <div class="max-w-screen-xl px-4 py-8 mx-auto sm:py-16 lg:px-6">
            @livewire('section-component', [
                'sectionName' => 'Services',
                'title' => 'Our Amazing Services',
                'description' => 'We offer a wide range of services to help you succeed.',
            ])
            <div class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-12 md:space-y-0">
                <x-card title="Secure"
                    paragraph="Lorem ipsum donor amet siti ceali ut enim ad minim veniam, quis nostrud ut enim ad minim veniam, quis nostrud."
                    icon='<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 text-primary-600 lg:w-6 lg:h-6 dark:text-primary-300">
                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>' />
                <x-card title="24/7 Support"
                    paragraph="Lorem ipsum donor amet siti ceali ut enim ad minim veniam, quis nostrud ut enim ad minim veniam, quis nostrud."
                    icon='<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 text-primary-600 lg:w-6 lg:h-6 dark:text-primary-300">
                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>' />
                <x-card title="Fast"
                    paragraph="Lorem ipsum donor amet siti ceali ut enim ad minim veniam, quis nostrud ut enim ad minim veniam, quis nostrud."
                    icon='<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 text-primary-600 lg:w-6 lg:h-6 dark:text-primary-300">
                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>' />
                <x-card title="Secure"
                    paragraph="Lorem ipsum donor amet siti ceali ut enim ad minim veniam, quis nostrud ut enim ad minim veniam, quis nostrud."
                    icon='<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 text-primary-600 lg:w-6 lg:h-6 dark:text-primary-300">
                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>' />
                <x-card title="24/7 Support"
                    paragraph="Lorem ipsum donor amet siti ceali ut enim ad minim veniam, quis nostrud ut enim ad minim veniam, quis nostrud."
                    icon='<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 text-primary-600 lg:w-6 lg:h-6 dark:text-primary-300">
                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>' />
                <x-card title="Fast"
                    paragraph="Lorem ipsum donor amet siti ceali ut enim ad minim veniam, quis nostrud ut enim ad minim veniam, quis nostrud."
                    icon='<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 text-primary-600 lg:w-6 lg:h-6 dark:text-primary-300">
                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>' />
            </div>
        </div>
    </section>

    <section class="relative pt-12 bg-blueGray-50">
        <div class="flex flex-wrap items-center">
            <div class="w-full px-4 ml-auto mr-auto md:w-4/12">
                <img alt="..." class="max-w-full rounded-lg shadow-lg"
                    src="https://images.unsplash.com/photo-1555212697-194d092e3b8f?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=634&amp;q=80">
            </div>
            <div class="w-full px-4 ml-auto mr-auto md:w-5/12">
                <div class="md:pr-12">
                    <div
                        class="inline-flex items-center justify-center w-16 h-16 p-3 mt-8 mb-6 text-center text-pink-600 bg-pink-300 rounded-full shadow-lg">
                        <i class="text-xl fas fa-rocket"></i>
                    </div>
                    <h3 class="text-3xl font-semibold">A growing company</h3>
                    <p class="mt-4 text-lg leading-relaxed text-blueGray-500">
                        The extension comes with three pre-built pages to help you get
                        started faster. You can change the text and images and you're
                        good to go.
                    </p>
                    <ul class="mt-6 list-none">
                        <li class="py-2">
                            <div class="flex items-center">
                                <div>
                                    <span
                                        class="inline-block px-2 py-1 mr-3 text-xs font-semibold text-pink-600 uppercase bg-pink-200 rounded-full"><i
                                            class="fas fa-fingerprint"></i></span>
                                </div>
                                <div>
                                    <h4 class="text-blueGray-500">
                                        Carefully crafted components
                                    </h4>
                                </div>
                            </div>
                        </li>
                        <li class="py-2">
                            <div class="flex items-center">
                                <div>
                                    <span
                                        class="inline-block px-2 py-1 mr-3 text-xs font-semibold text-pink-600 uppercase bg-pink-200 rounded-full"><i
                                            class="fab fa-html5"></i></span>
                                </div>
                                <div>
                                    <h4 class="text-blueGray-500">Amazing page examples</h4>
                                </div>
                            </div>
                        </li>
                        <li class="py-2">
                            <div class="flex items-center">
                                <div>
                                    <span
                                        class="inline-block px-2 py-1 mr-3 text-xs font-semibold text-pink-600 uppercase bg-pink-200 rounded-full"><i
                                            class="far fa-paper-plane"></i></span>
                                </div>
                                <div>
                                    <h4 class="text-blueGray-500">Dynamic components</h4>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <footer class="relative pt-8 pb-6 mt-8">
            <div class="container px-4 mx-auto">
                <div class="flex flex-wrap items-center justify-center md:justify-between">
                    <div class="w-full px-4 mx-auto text-center md:w-6/12">
                        <div class="py-1 text-sm font-semibold text-blueGray-500">
                            Made with <a href="https://www.creative-tim.com/product/notus-js"
                                class="text-blueGray-500 hover:text-gray-800" target="_blank">Notus JS</a> by <a
                                href="https://www.creative-tim.com" class="text-blueGray-500 hover:text-blueGray-800"
                                target="_blank"> Creative Tim</a>.
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </section>

    <section class="bg-white dark:bg-gray-900">
        <div class="max-w-screen-md px-4 py-8 mx-auto lg:py-16">
            <h2 class="mb-4 text-4xl font-extrabold tracking-tight text-center text-gray-900 dark:text-white">Contact Us
            </h2>
            <p class="mb-8 font-light text-center text-gray-500 lg:mb-16 dark:text-gray-400 sm:text-xl">Got a technical
                issue? Want to send feedback about a beta feature? Need details about our Business plan? Let us know.
            </p>
            <form action="#" class="space-y-8">
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your
                        email</label>
                    <input type="email" id="email"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light"
                        placeholder="name@flowbite.com" required>
                </div>
                <div>
                    <label for="subject"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Subject</label>
                    <input type="text" id="subject"
                        class="block w-full p-3 text-sm text-gray-900 border border-gray-300 rounded-lg shadow-sm bg-gray-50 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light"
                        placeholder="Let us know how we can help you" required>
                </div>
                <div class="sm:col-span-2">
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Your
                        message</label>
                    <textarea id="message" rows="6"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg shadow-sm border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Leave a comment..."></textarea>
                </div>
                <button type="submit"
                    class="px-5 py-3 text-sm font-medium text-center text-white rounded-lg bg-primary-700 sm:w-fit hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Send
                    message</button>
            </form>
        </div>
    </section>



</x-home-layout>
