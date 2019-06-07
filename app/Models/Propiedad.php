<?php

namespace iopro\Models;

use Illuminate\Database\Eloquent\Model;
use iopro\Models\Comunidad;
use iopro\Models\Venta;
use iopro\User;
class Propiedad extends Model
{
    protected $table='propiedad';

   
    public function getPosicionAttribute()
    {
        return "lat:". $this->latitud.", lng: ".$this->longitud;
    }

    public function comunidad()
    {
        return $this->belongsTo(Comunidad::class);
    }

    
    public function propietariosAntiguos()
    {
        return $this->belongsToMany(User::class, 'propietario', 'propiedad_id', 'user_id');
    }

    public function propietariosActuales()
    {
        return $this->belongsToMany(User::class, 'propietarioActual', 'propiedad_id', 'user_id');
    }

    public function usuario($idUser)
    {
        $user=User::find($idUser);
        if($user){
            return $user;
        }
        return null;
    }

    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }
    
}
