<?php

namespace iopro\Models;

use Illuminate\Database\Eloquent\Model;
use iopro\Models\Comunidad;
class Propiedad extends Model
{
    protected $table='propiedad';

    public function comuinidad()
    {
        return $this->belongsTo(Comunidad::class);
    }
}
