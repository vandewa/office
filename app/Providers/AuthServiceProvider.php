<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
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
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('kepala_dinas', function ($user) {
            return $user->idskpd == $user->kdunit;
        });

        Gate::define('sekretariat', function ($user) {
            return $user->idskpd == $user->kdunit.'.01' || $user->idskpd == '14.01';
        });

        Gate::define('kepala_bidang', function ($user) {
            return (preg_match('/^\d{2}$/', $user->idskpd) && $user->idskpd !== $user->kdunit) || $user->idskpd == '14.01';
        });

        Gate::define('staff', function ($user) {
            return preg_match('/^\d{2}\.\d{2}$/', $user->idskpd);
        });
    }

}
