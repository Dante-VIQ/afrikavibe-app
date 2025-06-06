<?php

namespace App\Livewire;

use App\Http\Controllers\AnalyticsController;
use Carbon\Carbon;
use App\Models\Blog;
use App\Models\City;
use App\Models\User;
use App\Models\Admin;
use App\Models\Feature;
use Livewire\Component;
use App\Models\Analysis;
use App\Models\Destination;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Layout;
use App\Http\Controllers\UserActivity;
use App\Livewire\UserActivity as LivewireUserActivity;
use App\Models\Analytics;

#[Layout('layouts.art')]
class AnalysisDashboard extends Component
{
    public $analysis, $analyze, $users, $user, $user_id;

    public $blogs, $blog;

    public $search;
  
    public AnalyticsController $analytics;

    public $range = [], $contentType = [], $trends = [];

    protected $rules = [
        'search' => 'alpha|min:3|max:50',
    ];

    #[Computed()]
    public function getUserCountProperty()
    {
        return User::count(); // Get the total number of users

        // return view('users.index', compact('userCount'));
    }

    #[Computed()]
    public function getDestinationCountProperty()
    {
        return Destination::count();
    }

    #[Computed()]
    public function analytics($range, $contentType)
    {
        return view('activity.trends', [
            'stats' => $this->getStats($range, $contentType),
            'trends' => $this->getTrends($range, $contentType),
            'topContent' => $this->getTopContent($range, $contentType),
            'filters' => [
                'range' => $range,
                'type' => $contentType
            ]
        ]);
    }
    #[Computed()]
    public function getBlogCountProperty()
    {
        return Blog::count();
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
        // $this->analysis = Analysis::all();
        return view('livewire.analysis-dashboard');
    }
}
