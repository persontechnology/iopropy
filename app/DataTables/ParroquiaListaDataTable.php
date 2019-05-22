<?php

namespace iopro\DataTables;

use iopro\Models\Parroquia;
use Yajra\DataTables\Services\DataTable;

class ParroquiaListaDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->editColumn('canton_id',function($p){
                return $p->canton->nombre;
            })
            ->addColumn('action', function($p){
                return view('parroquias.accionesLista', ['id'=>$p->id])->render();
            })
            ->rawColumns(['action','canton_id']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \iopro\Models\Parroquia $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Parroquia $model)
    {
        return $model->newQuery()->select($this->getColumns())->orderBy('codigo','asc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumnsTable())
                    ->minifiedAjax()
                    ->addAction(['width' => '80px','printable' => false, 'exportable' => false,'title'=>'Comunidades'])
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id',
            'codigo',
            'nombre',
            'canton_id',
          
        ];
    }

    protected function getColumnsTable()
    {
        return [
            /*'id',*/
            'codigo'=>['title'=>'Código'],
            'nombre',
            'canton_id'=>['title'=>'Cantón'],
           
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ParroquiaLista_' . date('YmdHis');
    }
}
