<?php

namespace iopro\Policies;

use iopro\User;
use iopro\Models\Propiedad;
use Illuminate\Auth\Access\HandlesAuthorization;

class PropiedadPolicy
{
    use HandlesAuthorization;

    public function editar(User $user, Propiedad $propiedad)
    {
        
    }

    
}
