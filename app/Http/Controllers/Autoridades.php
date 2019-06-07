<?php

namespace iopro\Http\Controllers;

use Illuminate\Http\Request;
use iopro\Models\Asociacion;
use iopro\Http\Requests\RqGuardarAutoridad;
use iopro\Http\Requests\RqActualizarAcutoridad;
use iopro\DataTables\AutoridadesDataTable;
use iopro\User;
use iopro\Models\Periodo;
use Illuminate\Support\Facades\Hash;
use iopro\DataTables\AutoridadesEnAsociacionDataTable;
use Illuminate\Support\Facades\DB;

class Autoridades extends Controller
{

	public function __construct()
    {
        $this->middleware(['role:Administrador']);
    }

	public function index(AutoridadesDataTable $dataTable)
	{
		return $dataTable->render('autoridades.lista');
	}
   

    public function guardar(RqGuardarAutoridad $request)
    {
    	$user=new User;
        $user->name=$request->name;
        $user->email=$request->email;
        
        $user->password=Hash::make($request->password);

        $user->nombres=$request->nombres;
        $user->apellidos=$request->apellidos;
        $user->identificacion=$request->identificacion;
        $user->tipoIdentificacion=$request->tipoIdentificacion;
        $user->sexo=$request->sexo;
        $user->telefono=$request->telefono;
        $user->celular=$request->celular;
        $user->detalle=$request->detalle;
        $user->estadoCivil=$request->estadoCivil;
        if($request->rolfedereacion){
            $user->assignRole('Administrador');    
        }
      
        $user->assignRole('Asociacion');
        $user->save();

        $request->session()->flash('success','Nueva Autoridad creado');
        return redirect()->route('autoridades');

    }

    public function nuevo()
    {
        
        return view('autoridades.nuevo');
    }


    public function indexAso(AutoridadesEnAsociacionDataTable $dataTable,$idAso)
    {
        $autoridades=User::role('Asociacion')->get();
        $aso=Asociacion::findOrFail($idAso);
        

        $data = array(
            'aso' =>$aso,
            'autoridades'=>$autoridades,
            
        );
        
        return $dataTable->with('idAso',$aso->id)->render('autoridades.index',$data);
    }


    public function agregar(Request $request)
    {
        $validatedData = $request->validate([
            'asociacion' => 'required|exists:asociacion,id',
            'autoridad' => 'required|exists:users,id',
        ]);

        $existeAutoridad=Periodo::where([
            'asociacion_id'=>$request->asociacion,
            'users_id'=>$request->autoridad,
            'estado'=>true
        ])->first();

        if ($existeAutoridad) {
            $request->session()->flash('warning','Ya existe autoridad activo, con esa información. Por favor finalize el período para asignar nuevamente');
        }else{
            $per=new Periodo;
            $per->asociacion_id=$request->asociacion;
            $per->users_id=$request->autoridad;
            $per->rol=$request->rol;
            $per->estado=true;
            $per->save();

            $request->session()->flash('success','Autoridad agregado exitosa');
        }
        
        return redirect()->route('autoridadesAsociacion',$request->asociacion);
    }

    public function eliminar(Request $request,$idPer)
    {
        $per=Periodo::findOrFail($idPer);
        try {
            $per->delete();
            $request->session()->flash('success','Autoridad eliminado');
        } catch (\Exception $e) {
            $request->session()->flash('info','Autoridad no eliminado');
        }
        return redirect()->route('autoridadesAsociacion',$per->asociacion->id);
    }

    public function finalizar(Request $request,$idPer)
    {
        $per=Periodo::findOrFail($idPer);
        $per->estado=false;
        $per->save();
        $request->session()->flash('info','Autoridad finalizado');
        return redirect()->route('autoridadesAsociacion',$per->asociacion->id);   
    }

    public function editar($idUser)
    {
        $user=User::findOrFail($idUser);
        $data = array('user' => $user);
        return view('autoridades.editar',$data);
    }

    public function actualizar(RqActualizarAcutoridad $request){

        $user=User::find($request->id);
        $user->name=$request->name;
        $user->email=$request->email;
        if($request->password){
            $user->password=Hash::make($request->password);
        }
        $user->nombres=$request->nombres;
        $user->apellidos=$request->apellidos;
        $user->identificacion=$request->identificacion;
        $user->tipoIdentificacion=$request->tipoIdentificacion;
        $user->sexo=$request->sexo;
        $user->telefono=$request->telefono;
        $user->celular=$request->celular;
        $user->detalle=$request->detalle;
        $user->estadoCivil=$request->estadoCivil;
        
        if($request->rolfedereacion){
            $user->assignRole('Administrador');    
        }else{
            $user->removeRole('Administrador');
        }
        if($request->estado){
            $user->estado=true;
        }else{
            $user->estado=false;
        }
        $user->save();
        $request->session()->flash('success','Información de Autoridad actualizado');
        return redirect()->route('autoridades');
    }

    public function eliminarInfo(Request $request,$idUser)
    {
        $user=User::findOrFail($idUser);
        try {
            DB::beginTransaction();
            $user->delete();
            $request->session()->flash('success','Autoridad eliminado');
            DB::commit();
        } catch (\Exception $e) {
            $request->session()->flash('info','Autoridad no eliminado');
            DB::rollBack();
        }
        return redirect()->route('autoridades');
    }
}
