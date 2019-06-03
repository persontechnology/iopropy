<?php

namespace iopro\Http\Controllers;

use Illuminate\Http\Request;
use iopro\Models\Comunidad;
use Illuminate\Support\Facades\Auth;
use iopro\DataTables\MiComunidadesDataTable;
use iopro\DataTables\MiAsociacionesDataTable;
use iopro\DataTables\PropiedadEnComunidadDataTable;
use iopro\Models\Asociacion;

class Propiedades extends Controller
{


    public function asociaciones(MiAsociacionesDataTable $dataTable)
    {
        return $dataTable->render('propiedades.asociaciones');
    }


    public function comunidades(MiComunidadesDataTable $dataTable,$idAso)
    {
        $aso=Asociacion::findOrFail($idAso);
        $asoPerteneceUsuario= $aso->periodos()->where(
            [
                'asociacion_id'=>$aso->id,
                'users_id'=>Auth::id(),
                'estado'=>true
            ])->first();
        
            if($asoPerteneceUsuario){
                return $dataTable->with('idAso',$aso->id)->render('propiedades.comunidades',['aso'=>$aso]);
            }
        return abort(403);
        
    }


    public function index(PropiedadEnComunidadDataTable $dataTable,$idComunidad)
    {
        
        $comu=Comunidad::findOrFail($idComunidad);
        if($comu->comuninaPerteneceUsuario()){
            return $dataTable->with('idComu',$comu->id)->render('propiedades.propiedadesEnComunidad',['comu'=>$comu]);
        }
        return abort(403);   
    }

    public function nuevo(Request $request,$idComunidad)
    {
        $comu=Comunidad::findOrFail($idComunidad);
        
        if($comu->comuninaPerteneceUsuario()){
            return view('propiedades.nuevo',['comu'=>$comu]);
        }
        return abort(403);   
    }

    
}
