<?php

namespace iopro\Models;
use iopro\Models\Parroquia;
use iopro\Models\Asociacion;
use Illuminate\Database\Eloquent\Model;

class Comunidad extends Model
{
    protected $table='comunidad';

    public function parroquia()
	{
	    return $this->belongsTo(Parroquia::class, 'parroquia_id');
	}
	public function asociacion()
	{
		return $this->belongsTo(Asociacion::class, 'asociacion_id');
	}
}
