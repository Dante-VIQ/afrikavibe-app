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
            'metadata' => 'nullable|array'
        ]);

        // $modelClass = "App\\Models\\" . ucfirst($validated['content_type']);
        // $model = $modelClass::findOrFail($validated['content_id']);

        UserActivityLog::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'action' => $validated['action'],
                'description' => $validated['description'],
                'ip_address' => $request->ip(),
                'user_agent' => substr($request->userAgent(), 0, 255),
                'country_code' => $this->getCountryCode($request->ip()),
                // 'time_spent_seconds' => $validated['time_spent'] ?? 0,
                'is_engaged' => ($validated['time_spent'] ?? 0) >= 30
            ]
        );

        return response()->noContent();
    }

    private function getCountryCode($ip)
    {
        try {
            return geoip($ip)->getCountryCode();
        } catch (\Exception $e) {
            return null;
        }
    }
}
