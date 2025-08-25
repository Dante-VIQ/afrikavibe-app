<?php

namespace App\Http\Controllers;

use App\Models\ContentView;
use App\Models\UserActivityLog;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Jaybizzle\LaravelCrawlerDetect\Facades\LaravelCrawlerDetect;

class TrackingController extends Controller
{
    public function trackView(Request $request)
    {
        // Skip bots/crawlers
        if (LaravelCrawlerDetect::isCrawler()) {
            return response()->noContent();
        }

        $validated = $request->validate([
            'action' => 'required|string',
            'description' => 'required|string',
            'metadata' => 'nullable|array',
            'time_spent' => 'nullable|numeric' // Added validation for time_spent
        ]);

        // Get user ID (handle both authenticated and guest users)
        $userId = auth()->check() ? auth()->id() : null;

        // Create or update activity log
      UserActivityLog::updateOrCreate(
    [
        'user_id' => $userId,
        'action' => $validated['action'],
        'description' => $validated['description'],
    ],
    [
        'metadata' => $validated['metadata'] ?? null,
        'ip_address' => $request->ip(),
        'user_agent' => substr($request->userAgent() ?? '', 0, 255),
        'country_code' => $this->getCountryCode($request->ip()),
        'time_spent_seconds' => $validated['time_spent'] ?? 0,
        'is_engaged' => ($validated['time_spent'] ?? 0) >= 30,
    ]
);

        return response()->noContent();
    }

    private function getCountryCode($ip)
    {
        try {
            // Make sure you have the geoip package installed and configured
            if (function_exists('geoip') && $ip && $ip !== '127.0.0.1') {
                return geoip($ip)->getCountryCode();
            }
            return null;
        } catch (\Exception $e) {
            return null;
        }
    }
}
