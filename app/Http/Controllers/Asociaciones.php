<?php

namespace iopro\Http\Controllers;

use Illuminate\Http\Request;
use iopro\DataTables\AsociacionDataTable;
use iopro\Http\Requests\RqIngresarAsociacion;
USE iopro\Http\Requests\RqActualizarAsociacion;
use iopro\Models\Asociacion;
class Asociaciones extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:Administrador']);
    }

    public function index(AsociacionDataTable $dataTable)
    {
    	 return $dataTable->render('asociaciones.index');
    }


    public function nuevo()
    {
    	return view('asociaciones.nuevo');
    }


    public function guardar(RqIngresarAsociacion $request)
    {
    	$aso=new Asociacion;
    	$aso->nombre=$request->nombre;
    	$aso->descripcion=$request->descripcion;
    	$aso->save();
    	$request->session()->flash('success','Nueva Asociación creado');
    	return redirect()->route('asociaciones');
    }

    public function editar(Request $request,$idAso)
    {
        $aso=Asociacion::findOrFail($idAso);
        $data = array('aso' => $aso );
        return view('asociaciones.editar',$data);
    }

    public function actualizar(RqActualizarAsociacion $request)
    {
        $aso=Asociacion::findOrFail($request->asociacion);
        $aso->nombre=$request->nombre;
        $aso->descripcion=$request->descripcion;
        $aso->save();
        $request->session()->flash('success','Asociación actualizada');
        return redirect()->route('asociaciones');
    }

    public function eliminar(Request $request,$idAso)
    {   
        $aso=Asociacion::findOrFail($idAso);
        try {
            $aso->delete();
            $request->session()->flash('success','Asociación eliminada');
        } catch (\Exception $e) {
            $request->session()->flash('info','Asociación no eliminada');
        }
        return redirect()->route('asociaciones');   
    }
}
