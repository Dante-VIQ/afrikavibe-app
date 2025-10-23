<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class TripPlannerController extends Controller
{
    public function showResults(Request $request)
    {
        $query = $request->input('query');

        // Destination summary via Tavily or fallback dataset
        $destinationResponse = Http::withHeaders([
            'X-RapidAPI-Key' => env('RAPIDAPI_KEY'),
            'X-RapidAPI-Host' => 'booking-com15.p.rapidapi.com',
        ])->get('https://tavily-travel-api.p.rapidapi.com/se', [
            'query' => $query,
        ]);

        $destinationData = $destinationResponse->json() ?? [];

        return view('trip-planner.results', [
            'destination' => $query,
            'destinationData' => $destinationData,
        ]);
    }

    public function getHotels(Request $request)
    {
        $destination = $request->input('destination');

        $response = Http::withHeaders([
            'X-RapidAPI-Key' => env('RAPIDAPI_KEY'),
            'X-RapidAPI-Host' => 'booking-com15.p.rapidapi.com',
        ])->get('https://booking-com15.p.rapidapi.com/api/v1/hotels/searchDestination', [
            'query' => $destination,
        ]);

        return $response->json();
    }

    public function planTrip(Request $request)
    {
        $destination = $request->input('destination');
        $duration = $request->input('duration', 5);
        $budget = $request->input('budget', 'medium');

        $prompt = "Plan a {$duration}-day trip to {$destination} for a {$budget} budget traveler. Include daily activities, local cuisines, and estimated costs.";

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-4-turbo',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a helpful AI travel planner.'],
                ['role' => 'user', 'content' => $prompt],
            ],
        ]);

        return $response->json();
    }
}
