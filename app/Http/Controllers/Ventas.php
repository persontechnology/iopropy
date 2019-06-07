<?php

namespace iopro\Http\Controllers;

use Illuminate\Http\Request;
use iopro\DataTables\VentasDataTable;
use iopro\User;
use iopro\DataTables\PropiedadVentaDataTable;
use iopro\Http\Requests\Ventas\RqGuardar;
use Illuminate\Support\Facades\DB;
use iopro\Models\Venta;
use iopro\Models\ItemActual;
use iopro\Models\Propiedad;
use Illuminate\Support\Facades\Auth;

class Ventas extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(VentasDataTable $dataTable)
    {
        return $dataTable->render('ventas.index');
    }

    public function nuevo(PropiedadVentaDataTable $dataTable)
    {   
        $venta=Venta::all()->last();
        $data = array(
            'usuarios' => User::all(),
            'venta'=>$venta
        );
        return $dataTable->render('ventas.nuevo',$data);
    }


    public function guardar(RqGuardar $request)
    {
        try {
            DB::beginTransaction();
            
            $pro=Propiedad::findOrFail($request->propiedad);
            
            $estado=true;
            $venta=new Venta;
            $venta->numero=$request->numeroVenta;
            $venta->precio=$request->precioEstimado;
            $venta->medidaTotal=$pro->medidaTotal;
            $venta->estado='Ingresado';
            $venta->propiedad_id=$pro->id;
            $venta->usuarioCreado=Auth::id();
            if(count($pro->ventas)>0){
                $estado=false;
            }
            
            $venta->save();
            if($estado){
                $venta->propietariosIniciales()->sync($pro->propietariosAntiguos->pluck('id'));
            }

            $venta->propietariosAntiguos()->sync($pro->propietariosActuales->pluck('id'));
            $venta->propietariosActuales()->sync($request->propietariosNuevos);
            
            DB::commit();
            $request->session()->flash('success','Venta ingresado exitosamente');
        } catch (\Exception $th) {
            DB::rollBack();
            $request->session()->flash('info','Venta no ingresada vuelva intentar.!'.$th->getMessage());
            return redirect()->route('nuevoVenta')->withInput();
        }
        return redirect()->route('ventas');
    }

    public function informacion($idVenta)
    {
        $venta=Venta::findOrFail($idVenta);
        return view('ventas.info',['venta'=>$venta]);
    }

    public function aprobar(Request $request,$idVenta)
    {
        $venta=Venta::findOrFail($idVenta);
        if($venta->estado=='Ingresado'){
            $pro=$venta->propiedad;
            $pro->propietariosActuales()->sync($venta->propietariosActuales->pluck('id'));
            $pro->propietariosAntiguos()->sync($venta->propietariosAntiguos->pluck('id'));
            $venta->estado='Vendido';
            $venta->usuarioEditado=Auth::id();
            $venta->save();
            $request->session()->flash('success','Venta aprobado');
        }else{
            $request->session()->flash('info','Venta no aprobado');
        }
        
        return redirect()->route('ventas');
    }

    public function anular(Request $request,$idVenta)
    {
        $venta=Venta::findOrFail($idVenta);
        if($venta->estado=='Ingresado'){
            $venta->estado='Anulado';
            $venta->usuarioEditado=Auth::id();
            $venta->save();
            $request->session()->flash('info','Venta anulado');
            
        }else{
            $request->session()->flash('info','Venta no anulado');
        }
        return redirect()->route('ventas');
    }

}
