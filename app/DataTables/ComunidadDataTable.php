<?php

namespace iopro\DataTables;

use iopro\Models\Comunidad;
use Yajra\DataTables\Services\DataTable;

class ComunidadDataTable extends DataTable
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
             ->editColumn('asociacion_id',function($c){
                return $c->asociacion->nombre;
            })

            ->filterColumn('asociacion_id', function($query, $keyword) {
                $query->whereHas('asociacion', function($query) use ($keyword) {
                    $query->whereRaw("nombre like ?", ["%{$keyword}%"]);
                });
            })

            ->addColumn('action', function($c){
                return view('comunidades.acciones', ['id'=>$c->id])->render();
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \iopro\Models\Comunidad $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Comunidad $model)
    {
        return $model->where('parroquia_id',$this->idParroquia)->select($this->getColumns())
        ->orderBy('nombre','asc');
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
            'nombre',
            'asociacion_id'
          
        ];
    }

    protected function getColumnsTable()
    {
        return [
            /*'id',*/
            'nombre',
            'codigo'=>['title'=>'Código'],
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
        return 'Comunidad_' . date('YmdHis');
    }
}
