<?php

namespace iopro\Models;
use iopro\User;
use iopro\Models\Propiedad;
use iopro\Models\Archivo;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table='venta';

    public function propiedad()
    {
        return $this->belongsTo( Propiedad::class , 'propiedad_id');
    }

    public function propietariosIniciales()
    {
        return $this->belongsToMany(User::class, 'itemInicial', 'venta_id', 'user_id');
    }

    public function propietariosAntiguos()
    {
        return $this->belongsToMany(User::class, 'itemAntiguo', 'venta_id', 'user_id');
    }

    public function propietariosActuales()
    {
        return $this->belongsToMany(User::class, 'itemActual', 'venta_id', 'user_id');
    }
    public function usuario($idUser)
    {
        $user=User::find($idUser);
        if($user){
            return $user;
        }
        return null;
        
    }

    public function archivos()
    {
        return $this->hasMany(Archivo::class);
    }

}

