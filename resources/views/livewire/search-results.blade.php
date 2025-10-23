<div class="space-y-4">
  <div class="bg-white p-4 rounded shadow flex justify-between items-center">
    <div>
      <h2 class="text-xl font-bold">Results for: {{ $q }}</h2>
      <p class="text-sm text-gray-600">Showing top hotels and featured destinations</p>
    </div>
    <div>
      {{-- <button onclick="window.location='{{ route('subscribe.promo') }}'" class="px-3 py-2 bg-green-600 text-white rounded">Get Curated Guide</button> --}}
    </div>
  </div>

  @if(count($partners))
    <div class="bg-yellow-50 p-4 rounded">
      <h3 class="font-semibold">Featured (Partners)</h3>
      @foreach($partners as $p)
        <div class="border-b py-2 flex justify-between">
          <div>
            <div class="font-medium">{{ $p['name'] }}</div>
            <div class="text-sm">{{ $p['destination_name'] }}</div>
          </div>
          <div>
            <a href="{{ $p['website'] ?? '#' }}" target="_blank" class="text-xs px-3 py-1 border rounded">Visit</a>
          </div>
        </div>
      @endforeach
    </div>
  @endif

  <div class="bg-white p-4 rounded shadow">
    <h3 class="font-semibold">Top Hotels (Booking.com)</h3>
    @forelse($hotels as $hotel)
      <div class="border-b py-2 flex justify-between">
        <div>
          <div class="font-medium">{{ $hotel['hotel_name'] }}</div>
          <div class="text-sm text-gray-500">{{ $hotel['address'] }}</div>
        </div>
        <div class="text-right">
          <div class="text-sm">From {{ $hotel['currency'] ?? 'USD' }} {{ number_format($hotel['min_price'] ?? 0, 2) }}</div>
          <a class="mt-2 inline-block text-xs px-3 py-1 border rounded" href="{{ $hotel['url'] ?? '#' }}" target="_blank">Book</a>
        </div>
      </div>
    @empty
      <div class="p-4 text-sm text-gray-500">No hotels found for your search.</div>
    @endforelse
  </div>
</div>
