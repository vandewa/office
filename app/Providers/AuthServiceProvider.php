<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\SuratMasuk;
use App\Policies\SuratMasukPolicy;
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
        SuratMasuk::class => SuratMasukPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate untuk kepala dinas
        Gate::define('kepala_dinas', function ($user) {
            return $user->idskpd == $user->kdunit && $user->idjabjbt == $user->kdunit && $user->idjenjab == 20;
        });

        // Gate untuk kepala bidang
        Gate::define('kepala_bidang', function ($user) {
            return $user->idjabjbt == $user->idskpd && $user->idskpd !== $user->kdunit;
        });

        // Gate untuk staff
        Gate::define('staff', function ($user) {
            return ($user->idjabjbt != $user->idskpd) || (!empty($user->idjabfung) && !empty($user->idjabfungum));
        });

        // Gate untuk sekretariat
        Gate::define('sekretariat', function ($user) {
            return $user->idskpd == $user->kdunit.'.01' ||
                   preg_match('/^' . preg_quote($user->kdunit . '.01', '/') . '\.\d{2}$/', $user->idskpd);
        });

        //    // Define a custom gate for checking multiple roles
           Gate::define('view-status-surat', function ($user) {
            return Gate::allows('sekretariat', $user) ||
                   Gate::allows('kepala_dinas', $user) ||
                   Gate::allows('kepala_bidang', $user);
        });

        Gate::define('add-disposisi', function ($user) {
            return Gate::allows('kepala_dinas', $user) ||
                   Gate::allows('kepala_bidang', $user);
        });

        Gate::define('view-diteruskan-kepada', function ($user) {
            return Gate::allows('kepala_dinas', $user) ||
                   Gate::allows('sekretariat', $user);
        });

        Gate::define('view-disposisi', function ($user) {
            return Gate::allows('sekretariat', $user) ||
                   Gate::allows('kepala_bidang', $user);
        });
    }
}
