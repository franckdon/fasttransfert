<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ $reglement->title }} / <span class="muted">{{ $questions->count() }} Question(s)</span>

            </h2>

            @can('create questions')
                <a href="{{ route('questions.create', $reglement->id) }}"
                    class="px-3 py-2 mt-5 ml-auto font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Ajouter
                </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            <x-message> </x-message>
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="mb-6 text-2xl">Liste des questions</h2>
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr class="border-b">
                                <th class="px-6 py-3 text-left" width="60">#</th>
                                <th class="px-6 py-3 text-left">
                                    Libellé
                                </th>
                                {{-- <th class="px-6 py-3 text-left">description</th> --}}
                                <th class="px-6 py-3 text-left" width="80">
                                    Date de création
                                </th>
                                <th class="px-6 py-3 text-center" width="280">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @if ($questions->isNotEmpty())
                                @foreach ($questions as $question)
                                    <tr class="border-b">
                                        <td class="px-6 py-3 text-left">
                                            <div class="text-sm font-medium leading-5 text-gray-900">
                                                {{ $loop->iteration }}
                                            </div>
                                        <td class="px-6 py-3 text-left">
                                            <div class="text-sm font-medium leading-5 text-gray-900">
                                                {{ $question->intitule }}
                                            </div>
                                        </td>
                                        {{-- <td class="px-6 py-3 text-left">
                                            {{ $reglement->description }}</td> --}}
                                        <td class="px-6 py-3 text-left">
                                            <div class="text-sm leading-5 text-gray-500">
                                                {{ \Carbon\Carbon::parse($question->created_at)->format('d M, Y') }}
                                            </div>
                                        </td>
                                        <td
                                            class="flex flex-row px-6 py-3 text-sm font-medium leading-5 text-center whitespace-no-wrap">

                                            @can('edit questions')
                                                <a href="{{ route('questions.edit', $question->id) }}" type="button"
                                                    class="text-gray-900 bg-white hover:bg-gray-100 border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-gray-800 dark:bg-white dark:border-gray-700 dark:text-gray-900 dark:hover:bg-gray-200 me-2 mb-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                    </svg>
                                                </a>
                                            @endcan
                                            @can('delete questions')
                                                <x-buttons.delete-button :id="$question->id" functionName="deleteQuestion" />
                                            @endcan

                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="my-3">
                        {{ $questions->links() }}
                    </div>
                </div>
            </div>
            <x-slot name="script">
                <script type="text/javascript">
                    function deleteQuestion(id) {
                        if (confirm('Are you sure you want to delete this question?')) {
                            $.ajax({
                                url: '{{ route('questions.destroy') }}',
                                type: 'DELETE',
                                data: {
                                    id: id,
                                },
                                headers: {
                                    'x-csrf-token': '{{ csrf_token() }}'
                                },
                                dataType: 'json',
                                success: function(response) {
                                    window.location.href =
                                        '{{ route('questions.index', $reglement->id) }}';
                                }
                            });
                        }
                    }
                </script>
            </x-slot>
        </div>
    </div>
</x-app-layout>
