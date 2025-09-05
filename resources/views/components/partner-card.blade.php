@props(['partner'])

@if ($partner)
    <div class="bg-white rounded-2xl shadow-md p-6 w-full max-w-lg mx-auto">
        <!-- Business Logo + Name -->
        <div class="flex items-center gap-4 mb-4">
            <img src="{{ $partner->logo }}" alt="{{ $partner->name }}" class="w-16 h-16 object-cover rounded-full shadow">
            <div>
                <h2 class="text-xl font-bold text-gray-800">{{ $partner->name }}</h2>
                <p class="text-sm text-gray-500">{{ $partner->tagline }}</p>
            </div>
        </div>

        <!-- Auto-Scrolling Item Slider -->
        <div x-data="{ current: 0, total: {{ count($partner->items) }} }" x-init="setInterval(() => { current = (current + 1) % total }, 4000)" class="relative overflow-hidden">
            <div class="flex transition-transform duration-500"
                :style="'transform: translateX(-' + current * 100 + '%)'">
                @foreach ($partner->items as $item)
                    <div class="w-full flex-shrink-0 p-4">
                        <div class="bg-gray-100 rounded-xl p-4 h-full flex flex-col justify-between shadow">
                            <img src="{{ $item->image }}" alt="{{ $item->name }}"
                                class="w-full h-40 object-cover rounded-lg mb-3">
                            <h3 class="text-lg font-semibold text-gray-800">{{ $item->name }}</h3>
                            <p class="text-sm text-gray-600 mb-2">{{ $item->description }}</p>
                            <span class="text-md font-bold text-indigo-600">
                                ${{ number_format($item->price, 2) }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Manual Controls -->
            <button @click="current = (current - 1 + total) % total"
                class="absolute left-0 top-1/2 -translate-y-1/2 bg-white p-2 rounded-full shadow hover:bg-gray-200">
                ‹
            </button>
            <button @click="current = (current + 1) % total"
                class="absolute right-0 top-1/2 -translate-y-1/2 bg-white p-2 rounded-full shadow hover:bg-gray-200">
                ›
            </button>
        </div>

        <!-- Visit Website -->
        <div class="mt-4 text-center">
            <a href="{{ $partner->website_url }}" target="_blank"
                class="inline-block bg-indigo-600 text-white px-4 py-2 rounded-lg shadow hover:bg-indigo-700 transition">
                Visit Business
            </a>
        </div>
    </div>
@else
    <div class="bg-gray-100 rounded-2xl p-6 text-center">
        <p>No partner information available</p>
    </div>
@endif
