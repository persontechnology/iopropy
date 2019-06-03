<?php

namespace iopro\Policies;

use iopro\User;
use iopro\Models\Comunidad;
use Illuminate\Auth\Access\HandlesAuthorization;
use iopro\Models\Periodo;

class ComunidadPolicy
{
    use HandlesAuthorization;

    public function crearPropiedad(User $user, Comunidad $comunidad)
    {
        $per=Periodo::where([
            'asociacion_id'=>$comunidad->asociacion->id,
            'users_id'=>$user->id,
            'estado'=>true
            ])->first();
        if($per){
            return true;
        }
    }

}
