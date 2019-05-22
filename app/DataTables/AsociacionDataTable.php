<?php

namespace iopro\DataTables;

use iopro\Models\Asociacion;
use Yajra\DataTables\Services\DataTable;

class AsociacionDataTable extends DataTable
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
            ->addColumn('comunidades',function($aso){
                return view('asociaciones.comunidades', ['aso'=>$aso])->render();
            })
            ->addColumn('action', function($aso){
                return view('asociaciones.acciones', ['id'=>$aso->id])->render();
            })->rawColumns(['comunidades','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \iopro\Asociacion $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Asociacion $model)
    {
        return $model->newQuery()->select($this->getColumns());
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
                    ->addAction(['width' => '80px','printable' => false, 'exportable' => false,'title'=>'Acciones'])
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
            'nombre',
            'descripcion',
        ];
    }
    protected function getColumnsTable()
    {
        return [
            
            'nombre',
            'descripcion'=>['title'=>'Descripción'],
            'comunidades'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Asociacion_' . date('YmdHis');
    }
}
