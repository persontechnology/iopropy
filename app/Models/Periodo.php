<?php

namespace iopro\Models;

use Illuminate\Database\Eloquent\Model;
use iopro\User;
use iopro\Models\Asociacion;
class Periodo extends Model
{
    protected $table='periodo';


 	public function autoridad()
	{
	    return $this->belongsTo(User::class, 'users_id');
	}   

	public function asociacion()
	{
	    return $this->belongsTo(Asociacion::class, 'asociacion_id');
	}   
}
