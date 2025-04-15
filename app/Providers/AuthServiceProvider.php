<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Blog' => 'App\Policies\BlogPolicy',
        'App\Models\Destination' => 'App\Policies\DestinationPolicy',
        'App\Models\About' => 'App\Policies\AboutPolicy',
        'App\Models\Header' => 'App\Policies\HeaderPolicy',
        'App\Models\Feature' => 'App\Policies\FeaturePolicy',
        'App\Models\Doctor' => 'App\Policies\DoctorPolicy',
        'App\Models\Service' => 'App\Policies\ServicePolicy',
        'App\Models\Analysis' => 'App\Policies\AnalysisPolicy',
        'App\Models\Culture' => 'App\Policies\CulturePolicy',

    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
