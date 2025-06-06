<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\About;
use App\Models\Doctor;
use App\Models\Header;
use App\Models\Culture;
use App\Models\Feature;
use App\Models\Service;
use App\Models\Analysis;
use App\Models\Analytics;
use App\Models\Destination;
use App\Policies\BlogPolicy;
use App\Policies\AboutPolicy;
use App\Policies\DoctorPolicy;
use App\Policies\HeaderPolicy;
use App\Policies\CulturePolicy;
use App\Policies\FeaturePolicy;
use App\Policies\ServicePolicy;
use App\Policies\AnalysisPolicy;
use App\Policies\AnalyticsPolicy;
use App\Policies\DestinationPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // if ($this->app->environment('local')) {
        //     $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
        //     $this->app->register(TelescopeServiceProvider::class);
        // }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Blog::class, BlogPolicy::class);
        Gate::policy(Destination::class, DestinationPolicy::class);
        Gate::policy(About::class, AboutPolicy::class);
        Gate::policy(Header::class, HeaderPolicy::class);
        Gate::policy(Feature::class, FeaturePolicy::class);
        Gate::policy(Doctor::class, DoctorPolicy::class);
        Gate::policy(Service::class, ServicePolicy::class);
        Gate::policy(Analysis::class, AnalysisPolicy::class);
        Gate::policy(Culture::class, CulturePolicy::class);
        Gate::policy(Analytics::class, AnalyticsPolicy::class);



    }
}
