<?php

namespace iopro\Http\Controllers;

use Illuminate\Http\Request;
use iopro\DataTables\PropiedadesFedDataTable;
use iopro\User;
use iopro\Models\Comunidad;
use iopro\Http\Requests\Propiedad\RqGuardar;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use iopro\Models\Propiedad;
use iopro\Models\Propietario;
use iopro\Models\PropietarioActual;
use iopro\Http\Requests\Propiedad\RqActualizar;
class PropiedadesFed extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(PropiedadesFedDataTable $dataTable)
    {
        return $dataTable->render('propiedades.fed.index');
    }
    public function nuevo()
    {
        $comu=Comunidad::all();
        
        $data = array('usuarios' => User::orderBy('apellidos','desc')->get(),'comunidades'=>$comu);
        return view('propiedades.fed.nuevo',$data);
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
            return redirect()->route('nuevaPropiedadFed')->withInput();
        }
        return redirect()->route('propiedadesFed');
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

        return view('propiedades.fed.editar',$data);
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
            return redirect()->route('nuevaPropiedadFed')->withInput();
        }
        return redirect()->route('propiedadesFed');
    }

    public function informacion($idPro)
    {
        $pro=Propiedad::findOrFail($idPro);
        return view('propiedades.fed.informacion',['propiedad'=>$pro]);
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
