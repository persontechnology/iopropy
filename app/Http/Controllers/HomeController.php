<?php

namespace iopro\Http\Controllers;

use Illuminate\Http\Request;
use iopro\Models\Venta;
use Illuminate\Support\Facades\DB;

use iopro\DataTables\MisPropiedadesDataTable;
use Illuminate\Support\Facades\Auth;
use iopro\Http\Requests\RqActualizarPerfil;
use Illuminate\Support\Facades\Hash;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        return view('home');
    }

    public function reportes(MisPropiedadesDataTable $dataTable)
    {
        $ventaXAnioActual=Venta::whereYear('created_at', '=', date('Y'))->sum('precio');
        $ventasMesesActuales= Venta::select(
            DB::raw('sum(precio) as total'),
            DB::raw("DATE_FORMAT(created_at,'%M %Y') as meses")
        )
        ->whereYear('created_at',date('Y'))
        ->groupBy('meses')
        ->orderBy('created_at')
        ->where('estado','Vendido')
        ->get();
        
        $ventasAnios= Venta::select(
            DB::raw('sum(precio) as total'),
            DB::raw("DATE_FORMAT(created_at,'%Y') as anios")
        )
        ->groupBy('anios')
        ->take(10)
        ->get();

        $data = array(
            'ventaXAnioActual' => $ventaXAnioActual,
            'ventasMesesActuales'=>$ventasMesesActuales,
            'ventasAnios'=>$ventasAnios
        );
        return $dataTable->with('idUser',Auth::user()->id)->render('reportes.index',$data);
    }


    public function miperfil()
    {
        $data = array('user' => Auth::user() );
        return view('auth.perfil',$data);
    }
    
    public function miperfilActualizar(RqActualizarPerfil $request)
    {
        $user=Auth::user();
        $user->nombres=$request->nombres;
        $user->apellidos=$request->apellidos;
        $user->identificacion=$request->identificacion;
        $user->tipoIdentificacion=$request->tipoIdentificacion;
        $user->sexo=$request->sexo;
        $user->telefono=$request->telefono;
        $user->celular=$request->celular;
        $user->detalle=$request->detalle;
        $user->estadoCivil=$request->estadoCivil;
        

        if($request->clave && $request->password){
            if (Hash::check($request->clave, $user->password)) {
                $user->password=Hash::make($request->password);
                $request->session()->flash('success','Perfil y contraseña actualizado');
                $user->save();
            }else{
                $request->session()->flash('danger','Contraseña antigua no coincide');
            }
        }else{
            $request->session()->flash('success','Perfil actualizado');
            $user->save();
        }
        return redirect()->route('miPerfil');
    }
}
