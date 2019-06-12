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
use PDF;
use iopro\DataTables\VentasEnPropiedadDataTable;

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
            
            
            $venta=new Venta;
            $venta->numero=$request->numeroVenta;
            $venta->precio=$request->precioEstimado;
            $venta->medidaTotal=$pro->medidaTotal;
            $venta->estado='Ingresado';
            $venta->propiedad_id=$pro->id;
            $venta->usuarioCreado=Auth::id();
            $venta->norte=$pro->linderoNorteCon;
            $venta->sur=$pro->linderoSurCon;
            $venta->este=$pro->linderoEsteCon;
            $venta->oeste=$pro->linderoOesteCon;
          
            
            $venta->save();
            
            $venta->propietariosIniciales()->sync($pro->propietariosAntiguos->pluck('id'));
            

            $venta->propietariosAntiguos()->sync($pro->propietariosActuales->pluck('id'));
            $venta->propietariosActuales()->sync($request->propietariosNuevos);
            
            DB::commit();
            $request->session()->flash('success','Venta ingresado exitosamente');
        } catch (\Exception $th) {
            DB::rollBack();
            $request->session()->flash('info','Venta no ingresada vuelva intentar.!');
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

    public function eliminar(Request $request,$idVenta)
    {
        try {
            DB::beginTransaction();
            
            
            $venta=Venta::findOrFail($idVenta);
            
            if($venta->estado=='Anulado'){
                $venta->propietariosIniciales()->detach();
                $venta->propietariosAntiguos()->detach();
                $venta->propietariosActuales()->detach();
            }
            $venta->delete();

            DB::commit();
            $request->session()->flash('success','Venta eliminado exitosamente');
        } catch (\Exception $th) {
            DB::rollBack();
            $request->session()->flash('info','Venta no eliminada vuelva intentar.!');
        }
        return redirect()->route('ventas');
    }

    public function imprimir($idVenta)
    {
        $venta=Venta::findOrFail($idVenta);
        return view('ventas.imprimir',['venta'=>$venta]);
    }

    public function pdf($idVenta)
    {
        $venta=Venta::findOrFail($idVenta);
        $pdf = PDF::loadView('ventas.imprimir', ['venta'=>$venta]);
        return $pdf->inline('Venta '.$venta->numero.'.pdf');
    }

    public function contrato(Request $request,$idVenta)
    {
        $venta=Venta::findOrFail($idVenta);
        if($venta->estado=='Vendido'){
            return view('ventas.contrato',['venta'=>$venta]);
        }else{
            $request->session()->flash('info','Debe aprobar la venta para acceder al documento de contrato de venta');
            return redirect()->route('ventas');
        }
    }


    public function actualizarContrato(Request $request)
    {
        $venta=Venta::findOrFail($request->id);
        if($venta->estado=='Vendido'){
            $venta->contrato=$request->contrato;
            $venta->save();
            $request->session()->flash('success','Contrato actualizado exitosamente');
        }else{
            $request->session()->flash('info','Debe aprobar la venta para acceder al documento de contrato de venta');
        }
        return redirect()->route('contratoVenta',$venta->id);
    } 


    public function contratoPdf(Request $request,$idVenta)
    {
        $venta=Venta::findOrFail($idVenta);
        if($venta->contrato){
            if($venta->estado=='Vendido'){
                $pdf = PDF::loadView('ventas.contratoPdf', ['venta'=>$venta]);
                return $pdf->inline('Venta '.$venta->numero.'.pdf');

            }else{
                $request->session()->flash('info','Debe aprobar la venta para acceder al documento de contrato de venta');
            }
        }else{
            $request->session()->flash('info','Primero actualice información porfavor');
        }
        return redirect()->route('contratoVenta',$venta->id);
    }

    public function ventasEnPropiedad(VentasEnPropiedadDataTable $dataTable,$idProp)
    {
        $pro=Propiedad::findOrFail($idProp);
        return $dataTable->with('idPro',$pro->id)->render('ventas.propiedad.index');
    }
}
