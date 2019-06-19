<?php

namespace iopro\Http\Controllers;

use Illuminate\Http\Request;
use iopro\Models\Noticia;
use iopro\Http\Requests\RqContacto;
use iopro\Mail\EmailContacto;
use Illuminate\Support\Facades\Mail;

class Estaticas extends Controller
{
    public function nosotros()
    {
        return view('estaticas.nosotros');
    }

    public function noticias()
    {
        $not=Noticia::where('estado',true)->paginate(15);
        return view('estaticas.noticias',['not'=>$not]);
    }

    public function detalleNoticia($idNot)
    {
        $not=Noticia::findOrFail($idNot);
        if($not->estado){
            $noti=Noticia::where('id','!=',$idNot)->where('estado',true)->take('10')->get();
            return view('estaticas.detalleNoticia',['n'=>$not,'not'=>$noti]);
        }
        return abort(403);
        
    }


    public function contactos()
    {
        return view('estaticas.contactos');
    }

    public function contactosEnviar(RqContacto $r)
    {
    	$data = array('email' => $r->email,'nombre'=>$r->nombre,'asunto'=>$r->asunto,'mensaje'=>$r->mensaje );
    	Mail::to(config('MAIL_FROM_ADDRESS','taishaalex123@gmail.com'))->send(new EmailContacto($data));
    	$r->session()->flash('success','FICSH te da la bienvenida y gracias por escribirnos. Intentaremos responderte lo antes posible.');
    	return redirect()->route('contactos');
    }
}
