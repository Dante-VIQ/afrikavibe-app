<?php

namespace App\Http\Controllers;

use Carbon\CarbonPeriod;
use App\Models\ContentView;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AnalyticsController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view-analytics');

        // try {
            $range = $request->input('range', 30);
            $contentType = $request->input('type');

            $stats = $this->getStats($range, $contentType);
            $trends = $this->getTrends($range, $contentType) ?? ['labels' => [], 'data' => []];
            $topContent = $this->getTopContent($range, $contentType);
            $filters = compact('range', 'contentType');

            // return view('activity.trends', compact('stats', 'trends', 'topContent', 'range', 'contentType'));
        // } catch (\Exception $e) {
        //     logger()->error('activity error: ' . $e->getMessage());

            return view('activity.trends', [
                'stats' => $stats,
                'trends' => $trends,
                'topContent' => $topContent,
                'filters' => $filters
            ]);
        // }
    }

    private function getStats($days, $contentType)
    {
        $query = $this->baseQuery($days, $contentType);

        $totalViews = $query->count();
        $engagedViews = $query->where('is_engaged', true)->count();

        return [
            'total_views' => $totalViews,
            'unique_visitors' => $query->distinct('ip_address')->count(),
            'avg_time' => round($query->avg('time_spent_seconds')),
            'engagement_rate' => $totalViews > 0 ? round(($engagedViews / $totalViews) * 100) : 0
        ];
    }

    private function getTrends($days, $contentType)
    {
        $period = collect();
        $labels = collect();

        for ($i = $days; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $period->push($date->format('Y-m-d'));
            $labels->push($date->format('M j'));
        }

        $data = ContentView::query()
            ->selectRaw('DATE(created_at) as date, COUNT(*) as views')
            ->where('created_at', '>=', now()->subDays($days))
            ->when($contentType, fn($q) => $q->where('viewable_type', 'App\\Models' . ucfirst($contentType)))
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('views', 'date');

        return response()->json([
            'labels' => $labels,
            'data' => $period->map(fn($date) => $data[$date] ?? 0),
        ]);
    }
    private function getTopContent($days, $contentType)
    {
        return ContentView::query()
            ->selectRaw('viewable_id, viewable_type, COUNT(*) as views')
            ->where('created_at', '>=', now()->subDays($days))
            ->when($contentType, fn($q) => $q->where('viewable_type', "App\\Models\\" . ucfirst($contentType)))
            ->groupBy('viewable_id', 'viewable_type')
            ->orderByDesc('views')
            ->with('viewable')
            ->limit(5)
            ->get()
            ->map(function ($item) {
                return [
                    'title' => $item->viewable->title ?? $item->viewable->name,
                    'views' => $item->views,
                    'url' => route($item->viewable_type::getRouteName(), $item->viewable),
                ];
            });
    }

    public function getContentUrl($type, $id)
    {
        return match(class_basename($type)) {
            'Blog' => route('blog-lay', $id),
            'Destination' => route('doctor-page', $id),
            'Culture' => route('culture-page', $id),
            default => '#'
        };
    }
}
