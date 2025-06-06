<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class ActivityLogController extends Controller
{
    public function index()
    {
       $this->authorize('view-activity-logs');
       $logs = ActivityLog::with('user')
       ->orderBy('created_by', 'desc')
       ->paginate(25);

       return view('activity-logs.index', compact('logs'));
    }
}
