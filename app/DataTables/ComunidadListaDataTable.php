<?php

namespace iopro\DataTables;

use iopro\Models\Comunidad;
use Yajra\DataTables\Services\DataTable;

class ComunidadListaDataTable extends DataTable
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
            ->editColumn('parroquia_id',function($comu){
                return $comu->parroquia->nombre;
            })
            ->filterColumn('parroquia_id', function($query, $keyword) {
                $query->whereHas('parroquia', function($query) use ($keyword) {
                    $query->whereRaw("nombre like ?", ["%{$keyword}%"]);
                });
            })

            ->editColumn('asociacion_id',function($comu){
                return $comu->asociacion->nombre;
            })

            ->filterColumn('asociacion_id', function($query, $keyword) {
                $query->whereHas('asociacion', function($query) use ($keyword) {
                    $query->whereRaw("nombre like ?", ["%{$keyword}%"]);
                });
            })


            ->addColumn('action', function($c){
                return 'opciones';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \iopro\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Comunidad $model)
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
            'parroquia_id',
            'asociacion_id'
        ];
    }


    protected function getColumnsTable()
    {
        return [
            
            'nombre'=>['title'=>'Comunidad'],
            'parroquia_id'=>['title'=>'Parroquia'],
            'asociacion_id'=>['title'=>'Asociación']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ComunidadLista_' . date('YmdHis');
    }
}
