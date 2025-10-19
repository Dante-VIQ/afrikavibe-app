<x-app-layout>
<div class="max-w-6xl mx-auto p-6">
    {{-- <form action="{{ route('trip-planner.results') }}" method="GET" class="flex gap-2 mb-8">
        <input type="text" name="query" value="{{ $query ?? '' }}"
               placeholder="Where do you want to go?"
               class="border rounded-xl p-3 flex-grow">
        <button class="bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-blue-700">Search</button>
    </form> --}}

    {{-- @if($message)
        <p class="text-center text-yellow-700 bg-yellow-100 border-l-4 border-yellow-500 p-4 mb-6">{{ $message }}</p>
    @endif --}}

    @if(!empty($hotels))
        <h2 class="text-2xl font-bold mb-4">Top Hotels near {{ $query }}
            @if(!empty($budget)) <span class="text-base font-normal">({{ ucfirst($budget) }} stays)</span>@endif
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($hotels as $hotel)
                <div class="bg-white shadow rounded-xl overflow-hidden">
                    <img src="{{ $hotel['max_photo_url'] ?? '/images/default.jpg' }}"
                         alt="{{ $hotel['hotel_name'] ?? 'Hotel' }}"
                         class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="font-semibold text-lg">{{ $hotel['hotel_name'] }}</h3>
                        <p class="text-gray-500">{{ $hotel['address'] ?? '' }}</p>
                        <a href="{{ $hotel['url'] ?? '#' }}"
                           target="_blank"
                           class="text-blue-600 hover:underline">View Details</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @if(!empty($destinations))
        <h2 class="text-2xl font-bold mt-10 mb-4">Other Places Around {{ $query }}</h2>
        <ul class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($destinations as $place)
                <li class="bg-gray-100 p-4 rounded-xl">
                    <h4 class="font-semibold">{{ $place['name'] ?? 'Unknown place' }}</h4>
                    <p class="text-gray-500">{{ $place['type'] ?? '' }}</p>
                </li>
            @endforeach
        </ul>
    @endif
</div>
</x-app-layout>
