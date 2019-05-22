<?php

namespace iopro\Http\Controllers;

use Illuminate\Http\Request;
use iopro\DataTables\CantonDataTable;
class Cantones extends Controller
{
	public function __construct()
    {
        $this->middleware(['role:Administrador']);
    }

    public function index(CantonDataTable $dataTable)
    {
    	 return $dataTable->render('cantones.index');
    }
        
}
