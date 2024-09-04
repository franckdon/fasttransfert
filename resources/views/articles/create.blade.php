<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Create Article') }}
            </h2>
            <a href="{{ route('articles.index') }}"
                class="px-3 py-2 mt-5 ml-auto font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Back</a>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="mb-6 text-2xl">Create Article</h2>
                    <form method="POST" action="{{ route('articles.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" name="title" id="title"
                                placeholder="Entrez le titre de l'article"
                                class="block w-full mt-1 rounded-md shadow-sm form-input" value="{{ old('name') }}" />
                            @error('title')
                                <p class="mt-1 text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Content</label>
                            <div class="my-3">
                                <textarea name="text" id="text" rows="10" placeholder="Entrez le contenu de l'article"
                                    class="block w-full mt-1 rounded-md shadow-sm form-textarea">{{ old('text') }}</textarea>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="author" class="block text-sm font-medium text-gray-700">Author</label>
                            <input type="text" name="author" id="author" placeholder="Entrez le nom de l'auteur"
                                class="block w-full mt-1 rounded-md shadow-sm form-input" value="{{ old('name') }}" />
                            @error('author')
                                <p class="mt-1 text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit"
                            class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
