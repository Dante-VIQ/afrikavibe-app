<?php

namespace App\Livewire;
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

#[Layout('layouts.art')]
class AnalysisDashboard extends Component
{
    public $analysis, $analyze, $users, $user, $user_id;

    public $blogs, $blog;

    public $bounceRate, $pageViews, $newSessions, $weeklyIncome;

    public $pageType = 'blog';

    public $period = 'daily';

    public $chartData;

    public $search;

    protected $rules = [
        'search' => 'alpha|min:3|max:50',
    ];

    public function loadChartData()
    {
        $data = $this->getActivityStats($this->pageType, $this->period);
        $this->chartData = [
            'labels' => $data->pluck('date')->toArray(),
            'views' =>$data->pluck('total_views')->toArray(),
            'timeSpent' => $data->pluck('total_time_spent')->map(function ($time) {
                return round($time / 60, 2);
            })->toArray(),
        ];

        $this->emit('chartUpdated', $this->chartData);
    }
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
        $totalSessions = \DB::table('analyses')->count('session_id');

        $bounces = \DB::table('analyses')
            ->where('is_bounce', 1)
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->count();

        return $totalSessions > 0 ? round(($bounces / $totalSessions) * 100, 2) : 0;
    }
    public function calculatePageViews()
    {
        return \DB::table('analyses')
            ->select('page_url', \DB::raw('COUNT(*) as views'))
            ->groupBy('page_url')
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->get();
    }

    public function calculateNewSessions()
    {
        return \DB::table('analyses')->where('is_new_session', 1)->count();
    }

    public function calculateWeeklyIncome()
    {
        return \DB::table('analyses')
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->sum('income');
    }


    #[Computed]
    public function mount()
    {
        $this->bounceRate = $this->calculateBounceRate();
        $this->pageViews = $this->calculatePageViews();
        $this->newSessions = $this->calculateNewSessions();
        $this->weeklyIncome = $this->calculateWeeklyIncome();
    }
    public function render()
    {
        // $this->analysis = Analysis::all();
        return view('livewire.analysis-dashboard', [
            'bounceRate' => $this->bounceRate,
            'pageViews' => $this->pageViews,
            'newSessions' => $this->newSessions,
            'weeklyIncome' => $this->weeklyIncome,
            'chartData' => $this->chartData,
        ]);
    }
}
