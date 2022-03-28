<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Order;
use App\Models\Children;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\Children' => 'App\Policies\ChildrenPolicy',
        'App\Models\Order' => 'App\Policies\OrderPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('view-dashboard', function(User $user) {
            return $user->role_id === 2 || $user->role_id === 3;
        });

        Gate::define('update-user', function(User $user, $request) {
            return $user->id === $request->id
                ? Response::allow()
                : Response::deny('TÁTO AKCIA JE NEOPRÁVNENÁ.');
        });
    }
}
