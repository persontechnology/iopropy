<?php

namespace iopro\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use iopro\User;
use iopro\Policies\UserPolicy;
use iopro\Models\Comunidad;
use iopro\Policies\ComunidadPolicy;
use iopro\Models\Propiedad;
use iopro\Policies\PropiedadPolicy;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Comunidad::class=>ComunidadPolicy::class,
        Propiedad::class=>PropiedadPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Implicitly grant "Admin" role all permissions
        // This works in the app by using gate-related functions like auth()->user->can() and @can()
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Administrador') ? true : null;
        });
    }
}
