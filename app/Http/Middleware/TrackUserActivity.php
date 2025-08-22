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
use Jaybizzle\LaravelCrawlerDetect\Facades\LaravelCrawlerDetect;


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
        return !LaravelCrawlerDetect::isCrawler() &&
        $request->isMethod('GET') &&
        !$request->ajax();
    }

    protected function logActivity(Request $request)
    {
        UserActivityLog::log(
            action: 'route_visit',
            description: "Visited {$request->route()->getName()}",
            metadata: [
            'route' => $request->route()->getName(),
            'url' => $request->fullUrl(),
            'params' => $request->route()->parameters()
            ]

            );
    }
}
