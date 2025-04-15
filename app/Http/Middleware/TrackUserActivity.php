<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Analysis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Stmt\If_;
use Symfony\Component\HttpFoundation\Response;

class TrackUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $analysis = \App\Models\Analysis::create([
        //     'user_id' => Auth::id(),
        //     'session_id' => Session::getId(),
        //     'start_time' => now(),
        // ]);

        // Session::put('analyses_id', $analysis->id);

        $sessionId = session()->getId() ?? uniqid('guest_');

        $pageUrl = $request->path();

        // check new session
        $isNewSession = !\DB::table('analyses')->where('session_id', '$sessionId')->exists();

        // save activity
        \DB::table('analyses')->insert([
            'session_id' => $sessionId,
            'page_url' => $pageUrl,
            'ip_address' => $request->ip(),
            'is_new_session' => $isNewSession ? 1 : 0,
            // 'time_spent' => 0,

            // default bounce value
            'created_at' => now(),
            'updated_at' => now(),


        ]);

        // if(! session()->has('session_id')) {
        //     session()->regenerate();
        // }
        $activity = \App\Models\Activity::create([
            'user_id' => Auth::id(),
            'session_id' => Session::getId(),
            'page' => $pageUrl,
            'time_spent' => 0,
        ]);

        Session::put('activity_id', $activity->id);

        return $next($request);
    }

    public function terminate($request, $response)
    {
        if (Session::has('analysis_id')) {
            $analysis = \App\Models\Analysis::find(Session::get('analysis_id'));

            if ($analysis) {
                $analysis->update(['end_time' => now()]);
            }
        }

    }
}
