<?php

namespace iopro\Http\Controllers;

use Illuminate\Http\Request;
use iopro\Models\Comunidad;

class Propiedades extends Controller
{


    public function index(Request $request,$idComunidad)
    {
        
        return Comunidad::findOrFail($idComunidad);
    }
}
