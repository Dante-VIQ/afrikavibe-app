<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TripPlannerController extends Controller
{
    public function searchHotels(Request $request)
    {
        $city = $request->input('city', 'Nairobi');
        $checkIn = $request->input('check_in', now()->addDays(7)->format('Y-m-d'));
        $checkOut = $request->input('check_out', now()->addDays(10)->format('Y-m-d'));

        $response = Http::withHeaders([
            'x-rapidapi-host' => 'booking-com15.p.rapidapi.com',
            'x-rapidapi-key' => env('RAPIDAPI_KEY'),
        ])->get('https://booking-com.p.rapidapi.com/v1/hotels/search', [
            'order_by' => 'popularity',
            'dest_type' => 'city',
            'adults_number' => 2,
            'checkin_date' => $checkIn,
            'checkout_date' => $checkOut,
            'units' => 'metric',
            'room_number' => 1,
            'dest_id' => '-2258073', // Example: Nairobi ID
            'locale' => 'en-gb',
            'currency_code' => 'USD'
        ]);

        $hotels = $response->json()['result'] ?? [];

        return view('trip-planner.hotels', [
            'hotels' => $hotels,
            'affiliateId' => env('TRAVELPAYOUTS_AID'),
        ]);
    }
}
