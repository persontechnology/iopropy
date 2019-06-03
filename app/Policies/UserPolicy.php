<?php

namespace iopro\Policies;

use iopro\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

 
    public function crear(User $user)
    {
        if($user->hasRole(['Administrador','Asociacion'])){
            if(count($user->periodosActivos)>0){
                return true;
            }
        }return false;
    }

    public function editar(User $user, User $model)
    {
        if($user->hasRole(['Administrador','Asociacion'])){
            if($user->id==$model->id){
                return false;
            }else{
                return true;
            }
        }
    }

}
