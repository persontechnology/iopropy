<?php

namespace iopro\Models;
use iopro\Models\Parroquia;
use iopro\Models\Asociacion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

	public function comuninaPerteneceUsuario()
	{
		$idAs=$this->asociacion->id;
        $comuninaPerteneceUsuario=$this->asociacion->periodos()->where(
            [
                'asociacion_id'=>$idAs,
                'users_id'=>Auth::id(),
                'estado'=>true
			])->first();
		if($comuninaPerteneceUsuario){
			return true;
		}
		return false;
			
	}
}
