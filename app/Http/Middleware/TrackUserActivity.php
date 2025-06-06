<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Analysis;
use App\Events\UserActivity;
use PhpParser\Node\Stmt\If_;
use App\Models\UserActivityLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;


class TrackUserActivity
{

    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($this->shouldTrack($request)) {
            $this->logActivity($request);
        }
        return $response;
    }


    protected function shouldTrack(Request $request): bool
    {
        return auth()->check() &&
        !LaravelCrawlerDetect::isCrawler() &&
        $request->isMethod('GET');
    }

    protected function logActivity(Request $request)
    {
        UserActivityLog::create([
            'user_id' => auth()->id(),
            'route' => $request->route()->getName(),
            'url' => $request->fullUrl(),
            'ip_address' => $request->ip(),
            'user_agent' => substr($request->userAgent(), 0, 255),
            'metadata' => [
            'method' => $request->method(),
            'parameters' => $request->route()->parameters()
            ]

            ]);
    }
}
