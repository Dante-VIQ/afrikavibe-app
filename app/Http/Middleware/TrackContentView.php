<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\ContentView;
use App\Models\User;
use Illuminate\Http\Request;


class TrackContentView
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($this->shouldTrack($request)) {
            $this->recordView($request);
        }
        return $response;

    }

    protected function shouldTrack(Request $request): bool
    {
       return !LaravelCrawlerDetect::isCrawler() &&
        $request->isMethod('GET')
         && $this->isTrackableRoute($request);
    }

    protected function isTrackableRoute(Request $request): bool
    {
        $route = $request->route();
        return $route && in_array($route->getName(), [
            'blog-lay',
            'livewire.doctors-page',
            'livewire.culture-page'
        ]);
    }
    protected function recordView(Request $request)
    {
        $model = $request->route()->parameter('blog') ?? 
                    $request->route()->parameter('doctor') ??
                     $request->route()->parameter('culture');

        ContentView::create([
            'user_id' => auth()->id(),
            'viewable_type' => get_class($model),
            'viewable_id' => $model->id,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'country_code' => $this->getCountryCode($request->ip()),
        ]);
    }

    protected function getCountryCode($ip)
    {
        try {
            return geoip($ip)->getCountryCode();
        } catch (\Exception $e) {
            return null;
        }
    }
}
