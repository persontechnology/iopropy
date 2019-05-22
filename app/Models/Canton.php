<?php

namespace iopro\Models;

use Illuminate\Database\Eloquent\Model;

class Canton extends Model
{
    protected $table='canton';

    public function provincia()
	{
	    return $this->belongsTo('iopro\Models\Provincia', 'provincia_id');
	}
}
