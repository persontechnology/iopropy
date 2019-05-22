<?php

namespace iopro\Models;

use Illuminate\Database\Eloquent\Model;
use iopro\Models\Canton;
class Parroquia extends Model
{
    protected $table='parroquia';

    public function canton()
	{
	    return $this->belongsTo(Canton::class, 'canton_id');
	}
}
