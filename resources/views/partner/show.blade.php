<!-- resources/views/partners/show.blade.php -->
<x-app-layout>
    <div class="max-w-5xl mx-auto bg-white shadow rounded-2xl p-6">
        <!-- Partner Info -->
        <div class="flex items-center gap-6 mb-6">
            <img src="{{ asset('storage/'.$partner->logo) }}" 
                 class="w-20 h-20 rounded-full shadow object-cover" alt="{{ $partner->name }}">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">{{ $partner->name }}</h1>
                <p class="text-gray-600">{{ $partner->tagline }}</p>
                <a href="{{ $partner->website_url }}" target="_blank" 
                   class="text-indigo-600 hover:underline">Visit Website</a>
            </div>
        </div>

        <p class="text-gray-700 mb-6">{{ $partner->description }}</p>

        <!-- Items Section -->
        <h2 class="text-xl font-semibold mb-4">Items for Sale</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach($partner->items as $item)
                <div class="bg-gray-100 rounded-xl p-4 shadow hover:shadow-lg transition">
                    <img src="{{ asset('storage/'.$item->image) }}" 
                         class="w-full h-40 object-cover rounded-lg mb-3" alt="{{ $item->name }}">
                    <h3 class="text-lg font-bold text-gray-800">{{ $item->name }}</h3>
                    <p class="text-sm text-gray-600">{{ $item->description }}</p>
                    <span class="block mt-2 text-indigo-600 font-bold">${{ number_format($item->price, 2) }}</span>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
