<?php

namespace iopro\Http\Controllers;

use Illuminate\Http\Request;
use iopro\Models\Venta;
use iopro\Models\Archivo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class Archivos extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request,$idVenta)
    {
    	$venta=Venta::find($idVenta);
    	$data = array('venta' => $venta );
    	return view('archivos.index',$data);
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'fotos.*'=>"required|mimes:pdf|max:10000",
            'idVenta'=>'required|exists:venta,id'
        ]);

        $venta=Venta::findOrFail($request->idVenta);
        if($venta->estado=="Vendido"){

        
            if ($request->hasFile('fotos')) {
                $orden=0;
                foreach ($request->fotos as $foto) {
                    $archivo=new Archivo;
                    $dir=$foto->hashName().'_'.$venta->id.'_'.Carbon::now().'.'.$foto->extension();
                    $path = $foto->storeAs('archivos', $dir,'public');
                    $archivo->direccion=$dir; 
                    $archivo->orden=$orden;
                    $archivo->nombre=$foto->getClientOriginalName();
                    $archivo->venta_id=$venta->id;
                    $archivo->save();
                    $orden++;
                
                }
            }

            $request->session()->flash('success','Archivos de respaldo ingresado exitosamente.!');
            return redirect()->route('archivos',['idVenta'=>$request->idVenta]);
        }
    }



    public function eliminar(Request $request)
    {
        $no=Archivo::findOrFail($request->key);
        try {
            $no->delete();
            Storage::disk('public')->delete('archivos/'.$no->direccion);
            return response()->json('success');
        } catch (\Exception $th) {
            return response()->json('danger');
        }
        
    }

    public function ordenar(Request $request)
    {
        
        $orden=0;
        foreach ($request->ids as $key => $id) {
            $orden++;
            $ga=Archivo::findOrFail($id);
            $ga->orden=$orden;
            $ga->save();
        }

        return response()->json("");
    }
}
