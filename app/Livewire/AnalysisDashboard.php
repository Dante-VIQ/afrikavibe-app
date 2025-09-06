<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Blog;
use App\Models\City;
use App\Models\User;
use App\Models\Admin;
use App\Models\Doctor;
use App\Models\Culture;
use App\Models\Feature;
use Livewire\Component;
use App\Models\Analysis;
use Carbon\CarbonPeriod;
use App\Models\Analytics;
use App\Models\ContentView;
use App\Models\Destination;
use App\Models\UserActivityLog;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\UserActivity;
use App\Http\Controllers\AnalyticsController;
use App\Livewire\UserActivity as LivewireUserActivity;

#[Layout('layouts.art')]
class AnalysisDashboard extends Component
{
    public $analysis, $analyze, $users, $user, $user_id;

    public $blogs, $blog;

    public $search;

    public AnalyticsController $analytics;

    protected $rules = [
        'search' => 'alpha|min:3|max:50',
    ];

    public $range = 7;
    public $type = null;
    public $source = 'content';
    
    public $stats = [];
    public $contentTrends = [];
    public $activityTrends = [];
    public $topContent = [];
    public $topActions = [];
    public $userActivity = [];
    public $labels = [];
    public $actions = [];
    public $contentViewsData = [];
    public $userActivityData = [];

    protected $queryString = [
        'range' => ['except' => 7],
        'type' => ['except' => ''],
        'source' => ['except' => 'content']
    ];

    public function mount()
    {
        // Authorization: Only allow master role
        $this->authorize('viewAny', Analysis::class);
        $this->loadData();
    }

    public function updated($property)
    {
        if (in_array($property, ['range', 'type', 'source'])) {
            $this->loadData();
        }
    }

    public function loadData()
    {
        // Get analytics from both data sources
        $this->stats = array_merge(
            $this->getContentViewStats($this->range, $this->type),
            $this->getActivityStats($this->range, $this->type)
        );

        $this->contentTrends = $this->getContentViewTrends($this->range, $this->type);
        $this->activityTrends = $this->getActivityTrends($this->range, $this->type);
        $this->topContent = $this->getContentViewTopContent($this->range, $this->type);
        $this->topActions = $this->getTopActions($this->range, $this->type);
        $this->userActivity = $this->getUserActivity($this->range, $this->type);
        $this->actions = UserActivityLog::distinct('action')->pluck('action')->toArray();

        // Generate labels for charts
        $period = CarbonPeriod::create(now()->subDays($this->range), now());
        $this->labels = collect($period->toArray())->map(fn($date) => $date->format('M j'))->toArray();

        // Raw data for custom charts
        $this->contentViewsData = $this->getContentViewChartData($this->range, $this->type);
        $this->userActivityData = $this->getUserActivityChartData($this->range, $this->type);
    }

    // Copy all your controller methods here (they remain the same)
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
            })->toArray();
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
            })->toArray();
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
            ->filter()->toArray();
    }

    private function getContentUrl($type, $id)
    {
        $basename = class_basename($type);

        return match($basename) {
            'Blog' => route('blog-lay', $id),
            'Destination' => route('doctor-page', $id),
            'Culture' => route('culture-page', $id),
            default => '#'
        };
    }
    #[Computed()]
    public function getUserCountProperty()
    {
        return User::count(); // Get the total number of users

        // return view('users.index', compact('userCount'));
    }

    #[Computed()]
    public function getDoctorCountProperty()
    {
        return Doctor::count();
    }
    #[Computed()]
    public function getBlogCountProperty()
    {
        return Blog::count();
    }

    #[Computed()]
    public function getCultureCountProperty()
    {
        return Culture::count();
    }
    #[Computed()]
    public function getCityCountProperty()
    {
        return City::count();
    }

    #[Computed()]
    public function getFeatureCountProperty()
    {
        return Feature::count();
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


    public function render()
    {
       
        $this->analysis = Analysis::all();
        return view('livewire.analysis-dashboard');
    }
}
