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
use iopro\Http\Requests\Propiedad\RqActualizar;
use iopro\Models\PropietarioActual;
use PDF;
class Propiedades extends Controller
{

    
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        $this->authorize('crearPropiedad', $comu);
        return $dataTable->with('idComu',$comu->id)->render('propiedades.propiedadesEnComunidad',['comu'=>$comu]);
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
            $pro->medidaTotal=$request->medidaTotal.' '.$request->medida;
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
                $userAnt->propiedad_id=$pro->id;
                $userAnt->save();
            }
            foreach ($request->propietariosActuales as $pan) {
                $userAct=new PropietarioActual;
                $userAct->user_id=$pan;
                $userAct->propiedad_id=$pro->id;
                $userAct->save();
            }

            DB::commit();
            $request->session()->flash('extra',$pro->id);
            $request->session()->flash('success','Propiedad ingresado exitosamente.!');
        } catch (\Exception $th) {
            DB::rollBack();
            $request->session()->flash('info','Propiedad no ingresada vuelva intentar.!');
            return redirect()->route('nuevaPropiedad',$comu->id)->withInput();
        }
        return redirect()->route('propiedades',$comu->id);
    }


    public function editar($idPro)
    {
        $pro=Propiedad::findOrFail($idPro);
        $this->authorize('crearPropiedad', $pro->comunidad);
        $propietariosActuales=$pro->propietariosActuales;
        $propietariosAntiguos=$pro->propietariosAntiguos;
        $usuariosActuales=User::whereNotIn('id',$propietariosActuales->pluck('id'))->get();
        $usuariosAntiguos=User::whereNotIn('id',$propietariosAntiguos->pluck('id'))->get();
        
        $data = array(
            'propietariosActuales'=>$propietariosActuales,
            'propietariosAntiguos'=>$propietariosAntiguos,
            'usuariosActuales'=>$usuariosActuales,
            'usuariosAntiguos'=>$usuariosAntiguos,
            'propiedad'=>$pro
        );

        return view('propiedades.editar',$data);
    }

    public function actualizar(RqActualizar $request)
    {
        $pro=Propiedad::findOrFail($request->id);
        $this->authorize('crearPropiedad', $pro->comunidad);

        try {
            DB::beginTransaction();
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
            $pro->usuarioEditado=Auth::user()->id;
            $pro->detalle=$request->detalle;
            $pro->latitud=$request->latitud;
            $pro->longitud=$request->longitud;
            $pro->save();

            $pro->propietariosActuales()->sync($request->propietariosActuales);
            $pro->propietariosAntiguos()->sync($request->propietariosAntiguo);
            
            DB::commit();
            $request->session()->flash('extra',$pro->id);
        } catch (\Exception $th) {
            DB::rollBack();
            $request->session()->flash('info','Propiedad no ingresada vuelva intentar.!');
            return redirect()->route('nuevaPropiedad',$pro->comunidad->id)->withInput();
        }
        return redirect()->route('propiedades',$pro->comunidad->id);
    }

    public function informacion($idPro)
    {
        $pro=Propiedad::findOrFail($idPro);
        return view('propiedades.informacion',['propiedad'=>$pro]);
    }

    public function verPdf($idPro)
    {
        $pro=Propiedad::findOrFail($idPro);
        $pdf = PDF::loadView('propiedades.pdf', ['propiedad'=>$pro]);
        return $pdf->inline('Propiedad '.$pro->codigo.'.pdf');
    }
    public function imprimir($idPro)
    {
        $pro=Propiedad::findOrFail($idPro);
        return view('propiedades.imprimir', ['propiedad'=>$pro]);
    }
    
}
