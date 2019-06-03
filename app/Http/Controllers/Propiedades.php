<?php

namespace iopro\Http\Controllers;

use Illuminate\Http\Request;
use iopro\Models\Comunidad;
use Illuminate\Support\Facades\Auth;
use iopro\DataTables\MiComunidadesDataTable;
use iopro\DataTables\MiAsociacionesDataTable;
use iopro\DataTables\PropiedadEnComunidadDataTable;
use iopro\Models\Asociacion;
use iopro\User;
use iopro\Http\Requests\Propiedad\RqGuardar;
use Illuminate\Support\Facades\DB;
use iopro\Models\Propiedad;
use iopro\Models\Propietario;

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

    public function nuevo($idComunidad)
    {       
        $comu=Comunidad::findOrFail($idComunidad);
        $this->authorize('crearPropiedad', $comu);
        $data = array('usuarios' => User::orderBy('apellidos','desc')->get(),'comu'=>$comu);
        return view('propiedades.nuevo',$data);
    }

    public function guardar(RqGuardar $request)
    {
        $comu=Comunidad::findOrFail($request->comunidad);
        $this->authorize('crearPropiedad', $comu);
        try {
            DB::beginTransaction();
            $pro=new Propiedad;
            $pro->codigo=$request->codigo;
            $pro->medidaTotal=$request->medidaTotal;
            $pro->linderoNorteCon=$request->linderoNorteCon;
            $pro->linderoSurCon=$request->linderoSurCon;
            $pro->linderoEsteCon=$request->linderoEsteCon;
            $pro->linderoOesteCon=$request->linderoOesteCon;
            $pro->camino=$request->camino;
            $pro->precioEstimado=$request->precioEstimado;
            $pro->serviciosBasicos=$request->serviciosBasicos;
            $pro->tieneCasa=$request->tieneCasa;
            $pro->usuarioCreado=Auth::user()->id;
            $pro->comunidad_id=$comu->id;
            $pro->save();

            foreach ($request->propietariosAntiguo as $pac) {
                $userAnt=new Propietario;
                $userAnt->user_id=$pac;
                $userAnt->propiedad_id=$comu->id;
                $userAnt->tipo='Antiguo';
                $userAnt->save();
            }
            foreach ($request->propietariosActuales as $pan) {
                $userAct=new Propietario;
                $userAct->user_id=$pan;
                $userAct->propiedad_id=$comu->id;
                $userAct->tipo='Actual';
                $userAct->save();
            }

            DB::commit();
            $request->session()->flash('success','Propiedad ingresado existosamente');
        } catch (\Exception $th) {
            DB::rollBack();
            $request->session()->flash('info','Propiedad bo ingresada vuelva intentar.!'.$th->getMessage());
            return redirect()->route('nuevaPropiedad',$comu->id)->withInput();
        }
        return redirect()->route('propiedades',$comu->id);
    }

    
}
