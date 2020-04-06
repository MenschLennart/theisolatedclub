<?php

namespace App\Providers;

use App\Activity;
use App\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    private function equalUser(User $user, Activity $activity) {
        return ($user->id === $activity->user_id);
    }

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('edit-activity', function(User $user, Activity $activity) {
            return $this->equalUser($user, $activity)
                ? Response::allow()
                : Response::deny(__('You\'re not allowed to edit this activity!'));
        });

        Gate::define('update-activity', function($user, $activity) {
            return $this->equalUser($user, $activity)
                ? Response::allow()
                : Response::deny(__('You\'re not allowed to update this activity!'));
        });

        Gate::define('delete-activity', function($user, $activity) {
            return $this->equalUser($user, $activity)
                ? Response::allow()
                : Response::deny(__('You\'re not allowed to delete this activity!'));
        });
    }
}
