 <div class="max-w-6xl mx-auto py-4">
        <h1 class="text-2xl font-bold mb-6 text-center">Plan a Trip - Find Your Stay</h1>

        <div class="grid md:grid-cols-3 gap-6">
            @foreach ($hotels as $hotel)
                <div class="bg-white shadow rounded-2xl overflow-hidden">
                    <img src="{{ $hotel['max_photo_url'] ?? '/images/default-hotel.jpg' }}"
                         alt="{{ $hotel['hotel_name'] }}"
                         class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h2 class="font-semibold text-lg">{{ $hotel['hotel_name'] }}</h2>
                        <p class="text-sm text-gray-600">{{ $hotel['address'] ?? '' }}</p>
                        <p class="text-yellow-500 mt-1">⭐ {{ $hotel['review_score'] ?? 'N/A' }}</p>
                        <p class="text-green-600 font-bold mt-2">${{ $hotel['min_total_price'] ?? 'N/A' }}</p>

                        <a href="https://www.booking.com/hotel/{{ $hotel['hotel_id'] }}.html?aid={{ $affiliateId }}"
                           target="_blank"
                           class="mt-4 block text-center bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                            Book Now
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

