<?php

namespace iopro\DataTables;

use iopro\User;
use Yajra\DataTables\Services\DataTable;
use iopro\Models\Propiedad;
use iopro\Models\Comunidad;

class PropiedadEnComunidadDataTable extends DataTable
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
            ->editColumn('tieneCasa',function($pro){
                if($pro->tieneca){
                    return 'Si';
                }else{
                    return 'No';
                }
            })
            ->editColumn('camino',function($pro){
                if($pro->camino){
                    return 'Si';
                }else{
                    return 'No';
                }
            })
            ->editColumn('serviciosBasicos',function($pro){
                if($pro->serviciosBasicos){
                    return 'Si';
                }else{
                    return 'No';
                }
            })
            ->addColumn('action', function($pro){
                return view('propiedades.acciones',['pro'=>$pro])->render();
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \iopro\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Propiedad $model)
    {
        return $model->where('comunidad_id',$this->idComu)->select('*')->orderBy('created_at','desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->addAction(['width' => '80px'])
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
            'codigo',
            'medidaTotal',
            'precioEstimado',
            'tieneCasa',
            'camino',
            'serviciosBasicos'=>['title'=>' Servicios Básicos']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'PropiedadEnComunidad_' . date('YmdHis');
    }
}
