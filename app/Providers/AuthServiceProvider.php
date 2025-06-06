<?php

namespace App\Providers;

use App\Role;
use App\Models\User;
use App\Policies\UserPolicy;
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
        User::class => UserPolicy::class,
        'App\Models\Analytics' => 'App\Policies\AnalyticsPolicy',

    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {

        Gate::before(function (User $user, $ability){
            if($user->isMaster()) {
                return true;
            }
        });
        Gate::define('manage-users', function ($user) {
            return $user->role === User::ROLE_MASTER;
        });

        Gate::define('edit-content', function (User $user) {
            return in_array($user->role, [User::ROLE_MASTER, User::ROLE_EDITOR, User::ROLE_ADMIN]);
        });

        Gate::define('view-activity-logs', function ($user) {
            return $user->role === User::ROLE_ADMIN || $user->role === User::ROLE_MASTER;
        });

        $this->registerPolicies();

    }
}
