<span class="text-gray-700">
    @if ($status == 'approuvée')
        <span class="px-2 py-1 text-sm text-white bg-green-500 rounded">
            {{ $status }}
        </span>
    @elseif ($status == 'rejetée')
        <span class="px-2 py-1 text-sm text-white bg-red-500 rounded">
            {{ $status }}
        </span>
    @else
        <span class="px-2 py-1 text-sm text-white bg-yellow-500 rounded">
            {{ $status }}
        </span>
    @endif
