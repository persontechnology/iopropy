<?php

namespace iopro\Http\Controllers;

use Illuminate\Http\Request;
use iopro\DataTables\UsuariosDataTable;
use iopro\Http\Requests\Usuarios\RqGuardar;
use iopro\User;
use Illuminate\Support\Facades\Hash;
use iopro\Http\Requests\Usuarios\RqEditar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class Usuarios extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(UsuariosDataTable $dataTable)
    {
        $this->authorize('crear', User::class);
        return $dataTable->render('usuarios.index');
    }

    public function nuevo()
    {
        $this->authorize('crear', User::class);
        return view('usuarios.nuevo');
    }

    public function guardar(RqGuardar $request)
    {
        $this->authorize('crear', User::class);
        $user=new User();
        $user->name=$request->nombres;
        $user->email=$request->identificacion.str_random(50).'@hmail.com';
        $user->password=Hash::make($request->identificacion);
        $user->nombres=$request->nombres;
        $user->apellidos=$request->apellidos;
        $user->identificacion=$request->identificacion;
        $user->tipoIdentificacion=$request->tipoIdentificacion;
        $user->sexo=$request->sexo;
        $user->telefono=$request->telefono;
        $user->celular=$request->celular;
        $user->detalle=$request->detalle;
        $user->estadoCivil=$request->estadoCivil;
        $user->assignRole('Usuarios');
        $user->save();

        $request->session()->flash('success','Usuario creado');
        return redirect()->route('usuarios');
    }

    public function editar(Request $request,$idUser)
    {
        $user=User::findOrFail($idUser);
        $this->authorize('editar', $user);
        return view('usuarios.editar',['user'=>$user]);

    }
    
    public function actualizar(RqEditar $request)
    {
        $this->authorize('crear', User::class);
        $user=User::findOrFail($request->id);
        if($request->rol){
            if(Auth::user()->hasRole('Administrador')){
                $user->assignRole('Asociacion');
            }
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
        $user->save();

        $request->session()->flash('success','Usuario actualizado');
        return redirect()->route('usuarios');

    }

    public function eliminar(Request $request,$idUser)
    {
        $user=User::findOrFail($idUser);
        try {
            DB::beginTransaction();
            $user->delete();
            $request->session()->flash('success','Usuario eliminado');
            DB::commit();
        } catch (\Exception $e) {
            $request->session()->flash('info','Usuario no eliminado');
            DB::rollBack();
        }
        return redirect()->route('usuarios');
    }


}
