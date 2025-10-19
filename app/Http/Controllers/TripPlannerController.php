<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class TripPlannerController extends Controller
{
    public function search(Request $request)
    {
            $query = $request->input('query', 'Nairobi');
            $budget = $request->input('budject', '');

            // STEP 1: Get destination info
            $locationResponse = Http::withHeaders([
                'x-rapidapi-key' => env('RAPIDAPI_KEY'),
                'x-rapidapi-host' => 'booking-com.p.rapidapi.com'
            ])->get('https://booking-com.p.rapidapi.com/v1/hotels/locations', [
                'name' => $query,
                'locale' => 'en-gb'
            ]);

            $locations = $locationResponse->json();
            $destId = $locations[0]['dest_id'] ?? null;
            $destType = $locations[0]['dest_type'] ?? 'city';

            if (!$destId) {
                return view('trip-planner.results', [
                    'hotels' => [],
                    'destinations' => [],
                    'query' => $query,
                    'budget' => $budget,
                    'message' => 'No results found for this destination.'
                ]);
            }

            // STEP 2: Fetch nearby hotels
            $hotelParams = [
                'checkout_date' => now()->addDays(3)->format('Y-m-d'),
                'checkin_date' => now()->addDays(1)->format('Y-m-d'),
                'dest_id' => $destId,
                'dest_type' => $destType,
                'adults_number' => 2,
                'order_by' => 'popularity',
                'locale' => 'en-gb',
                'units' => 'metric',
                'room_number' => 1,
                'filter_by_currency' => 'USD'
            ];
            // Optionally filter by budget
            if ($budget === 'budget') {
                $hotelParams['price_filter'] = 'low';
            } elseif ($budget === 'moderate') {
                $hotelParams['price_filter'] = 'mid';
            } elseif ($budget === 'luxury') {
                $hotelParams['price_filter'] = 'high';
            }

            $hotelResponse = Http::withHeaders([
                'x-rapidapi-key' => env('RAPIDAPI_KEY'),
                'x-rapidapi-host' => 'booking-com.p.rapidapi.com'
            ])->get('https://booking-com.p.rapidapi.com/v1/hotels/search', $hotelParams);

            $hotels = $hotelResponse->json()['result'] ?? [];

            // STEP 3: Fetch nearby destinations (optional but powerful)
            $nearbyResponse = Http::withHeaders([
                'x-rapidapi-key' => env('RAPIDAPI_KEY'),
                'x-rapidapi-host' => 'booking-com15.p.rapidapi.com'
            ])->get('https://booking-com.p.rapidapi.com/v1/hotels/nearby-places', [
                'latitude' => $locations[0]['latitude'] ?? 0,
                'longitude' => $locations[0]['longitude'] ?? 0,
                'locale' => 'en-gb'
            ]);

            $destinations = $nearbyResponse->json()['results'] ?? [];

            // STEP 4: Return everything to view
            return view('trip-planner.results', [
                'hotels' => $hotels,
                'destinations' => $destinations,
                'query' => $query,
                'budget' => $budget,
                'message' => null
            ]);
    }
}
