<?php

namespace iopro\Models;

use Illuminate\Database\Eloquent\Model;
use iopro\Models\Comunidad;
use iopro\Models\Periodo;
class Asociacion extends Model
{
    protected $table='asociacion';

    public function comunidades()
    {
        return $this->hasMany(Comunidad::class,'asociacion_id');
    }

    public function periodos()
    {
        return $this->hasMany(Periodo::class);
    }

}
