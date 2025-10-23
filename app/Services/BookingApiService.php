<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\SearchCache;
use Illuminate\Support\Str;

class BookingApiService
{
    protected $base = 'https://' . null; // will be constructed from env
    protected $host;
    protected $key;

    public function __construct()
    {
        $this->host = env('RAPIDAPI_HOST', 'booking-com15.p.rapidapi.com');
        $this->key = env('RAPIDAPI_KEY');
    }

    protected function headers()
    {
        return [
            'X-RapidAPI-Key' => $this->key,
            'X-RapidAPI-Host' => $this->host,
            'Accept' => 'application/json',
        ];
    }

    /**
     * Search for locations (destinations) - returns array of matches
     */
    public function searchLocations(string $query, $locale = 'en-gb', $cacheHours = 24)
    {
        $key = 'loc:' . Str::slug($query);
        $cache = SearchCache::where('query', $key)
            ->where('type', 'locations')
            ->where('created_at', '>', now()->subHours($cacheHours))
            ->first();

        if ($cache) {
            return $cache->results;
        }

        $endpoint = "https://{$this->host}/api/v1/attraction/searchAttractions";

        $resp = Http::withHeaders($this->headers())->get($endpoint, [
            'name' => $query,
            'locale' => $locale,
        ]);

        $data = $resp->successful() ? $resp->json() : [];

        SearchCache::create([
            'query' => $key,
            'type' => 'locations',
            'results' => json_encode($data),
        ]);

        return $data;
    }

    /**
     * Search hotels for a destination id or name
     * $destId - if known use dest_id from location result
     */
    public function searchHotelsByDestination($destId = null, $cityName = null, $locale = 'en-gb', $cacheHours = 12)
    {
        $key = $destId ? "hotels:{$destId}" : 'hotels:' . Str::slug($cityName);
        $cache = SearchCache::where('query', $key)
            ->where('type', 'hotels')
            ->where('created_at', '>', now()->subHours($cacheHours))
            ->first();

        if ($cache) {
            return $cache->results;
        }

       $endpoint = "https://{$this->host}/api/v1/attraction/searchAttractions";

        $params = [
            'locale' => $locale,
            'order_by' => 'popularity',
            'units' => 'metric',
            'adults_number' => 2,
            'room_number' => 1,
            'filter_by_currency' => 'USD',
            'page_number' => 0,
            'checkout_date' => now()->addDays(7)->format('Y-m-d'),
            'checkin_date' => now()->addDays(4)->format('Y-m-d'),
        ];

        if ($destId) {
            $params['dest_id'] = $destId;
        } else {
            $params['dest_type'] = 'city';
        } // fallback - API may require dest_id

        if ($cityName) {
            $params['name'] = $cityName;
        }

        $resp = Http::withHeaders($this->headers())->get($endpoint, $params);
        $data = $resp->successful() ? $resp->json() : [];

        SearchCache::create([
            'query' => $key,
            'type' => 'hotels',
            'results' => json_encode($data),
        ]);

        return $data;
    }

    /**
     * Utility: map API hotel item to our simplified object
     */
    public function mapHotelItem(array $item): array
    {
        // API keys vary; guard with null coalescing
        return [
            'hotel_name' => $item['hotel_name'] ?? ($item['name'] ?? ($item['hotel_name_trans'] ?? null)),
            'address' => $item['address'] ?? ($item['hotel_address'] ?? null),
            'min_price' => $item['price_breakdown']['min_price'] ?? ($item['min_price'] ?? null),
            'currency' => $item['currency_code'] ?? ($item['price_breakdown']['currency'] ?? null),
            'rating' => $item['review_score'] ?? ($item['class'] ?? null),
            'thumbnail' => $item['max_photo_url'] ?? ($item['image'] ?? null),
            'url' => $item['url'] ?? null,
            'raw' => $item,
        ];
    }
}
