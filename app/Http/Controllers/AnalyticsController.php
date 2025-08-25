<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\City;
use App\Models\Culture;
use Carbon\CarbonPeriod;
use App\Models\ContentView;
use Illuminate\Http\Request;
use App\Models\UserActivityLog;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class AnalyticsController extends Controller
{

   
    public function getBlogCountProperty()
    {
        return Blog::count();
    }

   
    public function getCultureCountProperty()
    {
        return Culture::count();
    }
   
    public function getCityCountProperty()
    {
        return City::count();
    }

    public function calculateBounceRate()
    {
        $totalSessions = DB::table('analyses')->count('session_id');

        $bounces = DB::table('analyses')
            ->where('is_bounce', 1)
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->count();

        return $totalSessions > 0 ? round(($bounces / $totalSessions) * 100, 2) : 0;
    }

  public function index(Request $request)
{
    // if (!Gate::allows('view-activity')) {
    //     abort(403);
    // }

    // if (!auth()->user()->isMaster()) {
    //     abort(403, 'Unauthorized access. Master role required.');
    // }

      $masterEmails = ['damalide20@gmail.com', 'master@example.com'];
    if (!auth()->check() || !in_array(auth()->user()->email, $masterEmails)) {
        abort(403, 'Unauthorized access. Master role required.');
    }

    $range = $request->input('range', 7);
    $contentType = $request->input('type');
    $source = $request->input('source', 'content'); // Get the source parameter

    // Convert to boolean for the filter array
    $useContentView = $source === 'content';

    // Get analytics from both data sources
    $contentStats = $this->getContentViewStats($range, $contentType);
    $activityStats = $this->getActivityStats($range, $contentType);
    $contentTrends = $this->getContentViewTrends($range, $contentType);
    $activityTrends = $this->getActivityTrends($range, $contentType);
    $topContent = $this->getContentViewTopContent($range, $contentType);
    $topActions = $this->getTopActions($range, $contentType);
    $userActivity = $this->getUserActivity($range, $contentType);

    $actions = UserActivityLog::distinct('action')->pluck('action');

    // Generate labels for charts
    $period = CarbonPeriod::create(now()->subDays($range), now());
    $labels = collect($period->toArray())->map(fn($date) => $date->format('M j'));

    // Include useContentView in filters
    $filters = compact('range', 'contentType', 'useContentView');

    return view('admin.admin', [
        // Combined stats
        'stats' => array_merge($contentStats, $activityStats),

        // Separate trends for different charts
        'contentTrends' => $contentTrends,
        'activityTrends' => $activityTrends,

        // Top content and actions
        'topContent' => $topContent,
        'topActions' => $topActions,

        // User activity data
        'userActivity' => $userActivity,

        // Filters and labels
        'filters' => $filters,
        'labels' => $labels,
        'actions' => $actions,

        // Raw data for custom charts
        'contentViewsData' => $this->getContentViewChartData($range, $contentType),
        'userActivityData' => $this->getUserActivityChartData($range, $contentType)
    ]);
}

    // ContentView Analytics Methods
    private function getContentViewStats($days, $contentType)
    {
        $query = ContentView::where('created_at', '>=', now()->subDays($days));

        if ($contentType) {
            $modelClass = "App\\Models\\" . ucfirst($contentType);
            $query->where('viewable_type', $modelClass);
        }

        $totalViews = $query->count();
        $uniqueVisitors = $query->distinct('ip_address')->count('ip_address');
        $uniqueUsers = $query->distinct('user_id')->count('user_id');

        return [
            'content_views' => $totalViews,
            'content_unique_visitors' => $uniqueVisitors,
            'content_unique_users' => $uniqueUsers,
            'content_avg_daily_views' => round($totalViews / max($days, 1))
        ];
    }

    private function getContentViewTrends($days, $contentType)
    {
        $period = collect();
        $labels = collect();

        for ($i = $days; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $period->push($date->format('Y-m-d'));
            $labels->push($date->format('M j'));
        }

        $query = ContentView::query()
            ->selectRaw('DATE(created_at) as date, COUNT(*) as views')
            ->where('created_at', '>=', now()->subDays($days))
            ->groupBy('date')
            ->orderBy('date');

        if ($contentType) {
            $modelClass = "App\\Models\\" . ucfirst($contentType);
            $query->where('viewable_type', $modelClass);
        }

        $data = $query->pluck('views', 'date');

        return [
            'labels' => $labels,
            'data' => $period->map(fn($date) => $data[$date] ?? 0),
        ];
    }

    private function getContentViewChartData($days, $contentType)
    {
        $query = ContentView::query()
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays($days))
            ->groupBy('date')
            ->orderBy('date');

        if ($contentType) {
            $modelClass = "App\\Models\\" . ucfirst($contentType);
            $query->where('viewable_type', $modelClass);
        }

        return $query->pluck('count', 'date');
    }

    // UserActivityLog Analytics Methods
    private function getActivityStats($days, $contentType)
    {
        $query = UserActivityLog::where('created_at', '>=', now()->subDays($days));

        $totalActivities = $query->count();
        $uniqueUsers = $query->distinct('user_id')->count('user_id');
        $uniqueActions = $query->distinct('action')->count('action');

        return [
            'total_activities' => $totalActivities,
            'activity_unique_users' => $uniqueUsers,
            'unique_actions' => $uniqueActions,
            'activity_avg_daily' => round($totalActivities / max($days, 1))
        ];
    }

    private function getActivityTrends($days, $contentType)
    {
        $period = collect();
        $labels = collect();

        for ($i = $days; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $period->push($date->format('Y-m-d'));
            $labels->push($date->format('M j'));
        }

        $query = UserActivityLog::query()
            ->selectRaw('DATE(created_at) as date, COUNT(*) as activities')
            ->where('created_at', '>=', now()->subDays($days))
            ->groupBy('date')
            ->orderBy('date');

        $data = $query->pluck('activities', 'date');

        return [
            'labels' => $labels,
            'data' => $period->map(fn($date) => $data[$date] ?? 0),
        ];
    }

    private function getUserActivityChartData($days, $contentType)
    {
        return UserActivityLog::query()
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays($days))
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count', 'date');
    }

    private function getTopActions($days, $contentType)
    {
        return UserActivityLog::query()
            ->selectRaw('action, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays($days))
            ->groupBy('action')
            ->orderByDesc('count')
            ->limit(10)
            ->get()
            ->map(function ($item) {
                return [
                    'action' => $item->action,
                    'count' => $item->count,
                    'description' => $item->description ?? null
                ];
            });
    }

    private function getUserActivity($days, $contentType)
    {
        return UserActivityLog::with('user')
            ->where('created_at', '>=', now()->subDays($days))
            ->orderByDesc('created_at')
            ->limit(20)
            ->get()
            ->map(function ($log) {
                return [
                    'user' => $log->user ? $log->user->name : 'Guest',
                    'action' => $log->action,
                    'description' => $log->description,
                    'time' => $log->created_at->diffForHumans(),
                    'ip' => $log->ip_address
                ];
            });
    }

    // Top Content (from ContentView)
    private function getContentViewTopContent($days, $contentType)
    {
        $query = ContentView::query()
            ->selectRaw('viewable_id, viewable_type, COUNT(*) as views')
            ->where('created_at', '>=', now()->subDays($days))
            ->groupBy('viewable_id', 'viewable_type')
            ->orderByDesc('views')
            ->limit(10);

        if ($contentType) {
            $modelClass = "App\\Models\\" . ucfirst($contentType);
            $query->where('viewable_type', $modelClass);
        }

        return $query->get()
            ->map(function ($item) {
                if (!$item->viewable) {
                    return null;
                }

                return [
                    'title' => $item->viewable->title ?? $item->viewable->name ?? 'Unknown',
                    'views' => $item->views,
                    'type' => class_basename($item->viewable_type),
                    'url' => $this->getContentUrl($item->viewable_type, $item->viewable_id),
                ];
            })
            ->filter();
    }

    public function getContentUrl($type, $id)
    {
        $basename = class_basename($type);

        return match($basename) {
            'Blog' => route('blog-lay', $id),
            'Destination' => route('doctor-page', $id),
            'Culture' => route('culture-page', $id),
            default => '#'
        };
    }

    // Additional method for content type distribution
    public function getContentTypeDistribution($days)
    {
        return ContentView::query()
            ->selectRaw('viewable_type, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays($days))
            ->groupBy('viewable_type')
            ->orderByDesc('count')
            ->get()
            ->map(function ($item) {
                return [
                    'type' => class_basename($item->viewable_type),
                    'count' => $item->count,
                    'percentage' => 0 // Will be calculated in frontend
                ];
            });
    }
}
