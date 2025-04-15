<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class AdminDashboard extends Component
{

    public $bounceRate, $pageViews, $newSessions, $weeklyIncome;

    public function calculateBounceRate(){
        $totalSessions = \DB::table('analyses')->count('session_id');

        $bounces = \DB::table('analyses')->where('is_bounce', 1)->count();

        return $totalSessions > 0 ? round(($bounces / $totalSessions) *100, 2 ): 0;
    }
    public function calculatePageViews(){
        return \DB::table('analyses')->select('page_url', \DB::raw('COUNT(*) as views'))->groupBy('page_url')->get();
    }

    public function calculateNewSessions(){
        return \DB::table('analyses')->where('is_new_session', 1)->count();
    }

    public function calculateWeeklyIncome(){
        return \DB::table('analyses')->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->sum('income');
    }
    public function render()
    {
        return view('livewire.admin-dashboard');
    }
}
