@props(['products' => []])
<div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($products as $product)
            <div class="bg-white rounded-xl shadow p-4 flex flex-col">
                <a href="{{ $product['aw_deep_link'] }}" target="_blank" rel="noopener noreferrer">
                    <img src="{{ $product['aw_product_image_url'] ?? 'https://via.placeholder.com/600x400' }}" alt="{{ $product['product_name'] }}" class="h-48 w-full object-cover rounded">
                </a>
                <div class="mt-3 flex-1">
                    <h3 class="text-lg font-semibold truncate">{{ $product['product_name'] }}</h3>
                    <p class="text-sm text-gray-500">{{ $product['merchant_name'] }}</p>
                </div>
                <div class="mt-3 flex items-center justify-between">
                    <span class="text-blue-600 font-bold">{{ $product['display_price'] ?? '' }}</span>
                    <a href="{{ $product['aw_deep_link'] }}" target="_blank" class="bg-green-600 text-white px-3 py-1 rounded text-sm">View</a>
                </div>
            </div>
        @empty
            <p class="hidden">No products found.</p>
        @endforelse
 </div>


