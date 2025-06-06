<?php

namespace App\Http\Controllers;

use App\Models\ContentView;
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
            'content_type' => 'required|in:blog,destination,culture',
            'content_id' => 'required|integer',
            'time_spent' => 'nullable|integer|min:0'
        ]);

        $modelClass = "App\\Models\\" . ucfirst($validated['content_type']);

        ContentView::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'viewable_type' => $modelClass,
                'viewable_id' => $validated['content_id'],
                'ip_address' => $request->ip()
            ],
            [
                'user_agent' => substr($request->userAgent(), 0, 255),
                'country_code' => $this->getCountryCode($request->ip()),
                'time_spent_seconds' => $validated['time_spent'] ?? 0,
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
