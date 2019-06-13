<?php

namespace iopro\Http\Controllers;

use Illuminate\Http\Request;
use iopro\DataTables\NoticiasDataTable;
use iopro\Models\Propiedad;
use iopro\Models\Noticia;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class Noticias extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:Administrador']);
    }

    public function index(NoticiasDataTable $dataTable)
    {
    	 return $dataTable->render('noticias.index');
    }
    public function noticiaNuevo()
    {
        $data = array('propiedades' => Propiedad::all() );
        return view('noticias.nuevo',$data);
    }
    public function guardarNoticia(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'detalle' => 'required',
            'foto'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'propiedad'=>'nullable|exists:propiedad,id'
        ]);
        $n=new Noticia;
        $n->titulo=$request->titulo;
        $n->detalle=$request->detalle;
        $n->estado=false;
        if($request->propiedad){
            $n->propiedad_id=$request->propiedad;
        }

        $foto=$n->id.'_'.Carbon::now().'.'.$request->foto->extension();
        $path = $request->foto->storeAs('noticias', $foto,'public');
        $n->imagen=$foto; 

        $n->save();

      
        
        $request->session()->flash('success','Noticia ingresado exitosamente');
        return redirect()->route('noticiasAdmin');
    }

    public function estadoNoticia(Request $request,$idNot)
    {
        $no=Noticia::findOrFail($idNot);
        if($no->estado){
            $no->estado=false;
            $request->session()->flash('info','Noticia cambiado a Sin publicar');
        }else{
            $no->estado=true;
            $request->session()->flash('success','Noticia cambiado a publicar');
        }
        $no->save();
        return redirect()->route('noticiasAdmin');
    }

    public function eliminarNoticia(Request $request,$idNot)
    {
        $no=Noticia::findOrFail($idNot);
        try {
            $no->delete();
            $request->session()->flash('success','Noticia eliminado');
            Storage::disk('public')->delete('noticias/'.$no->imagen);
        } catch (\Exception $th) {
            $request->session()->flash('info','Noticia no eliminado');
        }
        return redirect()->route('noticiasAdmin');
    }

    public function editarNoticia($idNot)
    {
        $no=Noticia::findOrFail($idNot);
        $data = array('propiedades' => Propiedad::all(),'n'=>$no );
        return view('noticias.editar',$data);
    }

    public function actualizarNoticia(Request $request)
    {
        $request->validate([
            'id'=>'required',
            'titulo' => 'required|string|max:255',
            'detalle' => 'required',
            'foto'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'propiedad'=>'nullable|exists:propiedad,id'
        ]);
        $n=Noticia::findOrFail($request->id);
        $n->titulo=$request->titulo;
        $n->detalle=$request->detalle;
        
        if($request->propiedad){
            $n->propiedad_id=$request->propiedad;
        }else{
            $n->propiedad_id=null;
        }
        if ($request->hasFile('foto')) {
            Storage::disk('public')->delete('noticias/'.$n->imagen);
            $foto=$n->id.'_'.Carbon::now().'.'.$request->foto->extension();
            $request->foto->storeAs('noticias', $foto,'public');
            $n->imagen=$foto; 
        }

        $n->save();

      
        
        $request->session()->flash('success','Noticia actualizado exitosamente');
        return redirect()->route('noticiasAdmin');
    }
}
