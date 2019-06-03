<?php

namespace iopro\Policies;

use iopro\User;
use iopro\Models\Propiedad;
use Illuminate\Auth\Access\HandlesAuthorization;

class PropiedadPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the propiedad.
     *
     * @param  \iopro\User  $user
     * @param  \iopro\Models\Propiedad  $propiedad
     * @return mixed
     */
    public function view(User $user, Propiedad $propiedad)
    {
        
    }

    
}
