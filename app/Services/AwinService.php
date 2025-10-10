<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;


class AwinService
{
    protected string $publisherId;
    protected string $apiKey;
    protected string $baseUrl;

    public function __construct()
    {
        $this->publisherId = config('services.awin.publisher_id');
        $this->apiKey = config('services.awin.api_key');
        $this->baseUrl = "https://api.awin.com/publishers/{$this->publisherId}";
    }

    /**
     * Search products on AWIN and return a normalized products array.
     *
     * @param string $keyword
     * @param int $limit
     * @return array
     */
    public function searchProducts(string $keyword = 'travel', int $limit = 9): array
    {
        // cache key
        $cacheKey = "awin_products_".md5($keyword).'_'.$limit;

        return Cache::remember($cacheKey, now()->addMinutes(15), function () use ($keyword, $limit) {
            // Request
            try {
                $response = Http::withToken($this->apiKey)
                    ->accept('application/json')
                    ->timeout(10)
                    ->get("{$this->baseUrl}/products", [
                        'search' => $keyword,
                        'pageSize' => $limit,
                    ]);
            } catch (\Throwable $e) {
                Log::error('AWIN API request failed: '.$e->getMessage());
                return $this->fallbackProducts();
            }

            if ($response->failed()) {
                Log::error('AWIN API returned failure: '.$response->status().' - '.$response->body());
                return $this->fallbackProducts();
            }

            $json = $response->json();

            // AWIN response structures can vary by API version. Try common keys and normalize.
            $list = [];

            if (isset($json['products']) && is_array($json['products'])) {
                $list = $json['products'];
            } elseif (isset($json['data']) && is_array($json['data'])) {
                $list = $json['data'];
            } elseif (is_array($json)) {
                // maybe the top-level array is the list
                $list = $json;
            }

            // Normalize each product to the keys our view expects
            $normalized = array_map(function ($p) {
                return [
                    'product_name' => $p['name'] ?? $p['product_name'] ?? ($p['title'] ?? 'Untitled product'),
                    'merchant_name' => $p['merchantName'] ?? $p['merchant_name'] ?? ($p['merchant'] ?? ''),
                    'display_price' => $p['price'] ?? $p['displayPrice'] ?? $p['display_price'] ?? null,
                    'aw_product_image_url' => $p['image'] ?? $p['imageUrl'] ?? $p['aw_product_image_url'] ?? null,
                    'aw_deep_link' => $p['offerUrl'] ?? $p['deepLink'] ?? $p['aw_deep_link'] ?? ($p['trackingLink'] ?? '#'),
                ];
            }, $list);

            return $normalized;
        });
    }

    /**
     * Fallback static products (used when API fails or during development).
     */
    protected function fallbackProducts(): array
    {
        return [
            [
                'product_name' => 'Sample Travel Package - 3 nights',
                'merchant_name' => 'Sample Merchant',
                'display_price' => 'USD 199',
                'aw_product_image_url' => 'https://via.placeholder.com/600x400?text=Sample+1',
                'aw_deep_link' => 'https://example.com',
            ],
            [
                'product_name' => 'Sample Flight Offer',
                'merchant_name' => 'Sample Flights',
                'display_price' => 'USD 99',
                'aw_product_image_url' => 'https://via.placeholder.com/600x400?text=Sample+2',
                'aw_deep_link' => 'https://example.com',
            ],
        ];
    }
}
