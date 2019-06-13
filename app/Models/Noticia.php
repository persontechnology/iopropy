<?php

namespace iopro\Models;

use Illuminate\Database\Eloquent\Model;
use iopro\Models\Propiedad;
class Noticia extends Model
{
    protected $table='noticia';

    public function propiedad()
    {
        return $this->belongsTo(Propiedad::class,'propiedad_id');
    }
}
