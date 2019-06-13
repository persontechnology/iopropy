<?php

namespace iopro\DataTables;

use iopro\Models\Propiedad;
use Yajra\DataTables\Services\DataTable;

class PropiedadesFedDataTable extends DataTable
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
            ->addColumn('action', function($pro){
                return view('propiedades.fed.acciones',['pro'=>$pro])->render();
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \iopro\Models\Propiedad $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Propiedad $model)
    {
        return $model->newQuery()->select($this->getColumns())->orderBy('created_at','desc');
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
            'codigo',
            'medidaTotal',
            'precioEstimado',
            'tieneCasa',
            'camino',
            'serviciosBasicos',
            'created_at'
        ];
    }

    protected function getColumnsTable()
    {
        return [
            
            'codigo'=>['title'=>'Código'],
            'medidaTotal',
            'precioEstimado',
            'tieneCasa',
            'camino',
            'serviciosBasicos'=>['title'=>' Servicios Básicos'],
            'created_at'=>['title'=>'Creado']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'PropiedadesFed_' . date('YmdHis');
    }
}
