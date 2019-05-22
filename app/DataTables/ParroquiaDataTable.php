<?php

namespace iopro\DataTables;

use iopro\Models\Parroquia;
use Yajra\DataTables\Services\DataTable;

class ParroquiaDataTable extends DataTable
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
           
            ->addColumn('action', function($p){
                return view('parroquias.acciones', ['id'=>$p->id])->render();
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \iopro\Models\Parroquia $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Parroquia $model)
    {
        return $model->where('canton_id',$this->idCanton)->select($this->getColumns())->orderBy('codigo','asc')->orderBy('nombre','asc');
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
           
            
        ];
    }

    protected function getColumnsTable()
    {
        return [
            /*'id',*/
            'nombre',
            'codigo'=>['title'=>'Código'],
            
           
           
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Parroquia_' . date('YmdHis');
    }
}
