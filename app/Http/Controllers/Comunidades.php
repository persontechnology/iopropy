<?php

namespace iopro\Http\Controllers;

use Illuminate\Http\Request;
use iopro\Models\Comunidad;
use iopro\Models\Parroquia;
use iopro\DataTables\ComunidadDataTable;
use iopro\DataTables\ComunidadListaEnParroquiaDataTable;
use iopro\Models\Asociacion;
use iopro\DataTables\ComunidadListaDataTable;
use iopro\DataTables\ComunidadesEnAsociacionActivaDataTable;
use iopro\Models\Periodo;
use Illuminate\Support\Facades\Auth;
class Comunidades extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:Administrador|Asociacion']);
    }
    
    public function index(ComunidadDataTable $dataTable,$idParroquia)
    {
    	$data = array('parroquia' => Parroquia::findOrFail($idParroquia));
    	return $dataTable->with('idParroquia',$idParroquia)->render('comunidades.index',$data);
    }


    public function agregar($idParroquia)
    {
        $aso=Asociacion::orderBy('nombre','asc')->get();
    	$data = array('parroquia' => Parroquia::findOrFail($idParroquia),'aso'=>$aso);
    	return view('comunidades.agregar',$data);
    }
    public function guardar(Request $request)
    {
    	$validatedData = $request->validate([
        	'nombre' => 'required|max:255|unique:comunidad',
	        'parroquia'=>'required',
            'asociacion'=>'required|exists:asociacion,id'
	    ]);

        $parroquia=Parroquia::findOrFail($request->parroquia);
	    $comunidad=new Comunidad;
	    $comunidad->nombre=$request->nombre;
	    $comunidad->codigo='';
	    $comunidad->parroquia_id=$parroquia->id;
        $comunidad->asociacion_id=$request->asociacion;
	    $comunidad->save();
        $comunidad->codigo=$parroquia->codigo.$comunidad->id;
        $comunidad->save();

	    $request->session()->flash('success','Comunidad agregado');
	    return redirect()->route('comunidades',$request->parroquia);
    }

    public function editar($idComunidad)
    {
        $aso=Asociacion::orderBy('nombre','asc')->get();
        $data = array(
            'comunidad' => Comunidad::findOrFail($idComunidad),
            'aso'=>$aso
        );

        return view('comunidades.editar',$data);
    }

    public function actualizar(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|max:255|unique:comunidad,nombre,'.$request->comunidad,
            'codigo' => 'required|max:255|unique:comunidad,codigo,'.$request->comunidad,
            'comunidad'=>'required',
            'asociacion'=>'required|exists:asociacion,id'
        ]);

        $comunidad=Comunidad::find($request->comunidad);
        $comunidad->nombre=$request->nombre;
        $comunidad->codigo=$request->codigo;
        $comunidad->asociacion_id=$request->asociacion;
        $comunidad->save();
        $request->session()->flash('success','Comunidad actualizado');
        return redirect()->route('comunidades',$comunidad->parroquia->id);
    }

    public function eliminar(Request $request,$idComunidad)
    {
        $comunidad=Comunidad::findOrFail($idComunidad);
        $parroquia_id=$comunidad->parroquia->id;
        try {
            $comunidad->delete();
            $request->session()->flash('success','Comunidad eliminado');
        } catch (\Exception $e) {
            $request->session()->flash('info','Comunidad no eliminado');
        }

        return redirect()->route('comunidades',$parroquia_id);
    }


    public function comunidadListaEnParroquia(ComunidadListaEnParroquiaDataTable $dataTable,$idParroquia)
    {
        $data = array('parroquia' => Parroquia::findOrFail($idParroquia));
        return $dataTable->with('idParroquia',$idParroquia)->render('comunidades.listaEnParroquia',$data);
    }
    


    public function comunidadesLista(ComunidadListaDataTable $dataTable)
    {
        return $dataTable->render('comunidades.lista');
    }
    

}
