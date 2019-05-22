<?php

namespace iopro\Http\Controllers;

use Illuminate\Http\Request;
use iopro\DataTables\ParroquiaDataTable;
use iopro\DataTables\ParroquiaListaDataTable;
use iopro\Models\Canton;
class Parroquias extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:Administrador']);
    }

    public function index(ParroquiaDataTable $dataTable,$idCanton)
    {
        $canton=Canton::findOrFail($idCanton);
    	 return $dataTable->with('idCanton',$idCanton)->render('parroquias.index',['canton'=>$canton]);
    }


    public function lista(ParroquiaListaDataTable $dataTable)
    {
    	return $dataTable->render('parroquias.lista');
    }
}
