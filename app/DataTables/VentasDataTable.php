<?php

namespace iopro\DataTables;

use iopro\Models\Venta;
use Yajra\DataTables\Services\DataTable;

class VentasDataTable extends DataTable
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
            ->editColumn('propiedad_id',function($ve){
                return '<a href="'.route('informacionPropiedadFed',$ve->propiedad->id).'">'.$ve->propiedad->codigo.'</a>';
            })
            ->editColumn('created_at',function($ve){
                return $ve->created_at.' '.$ve->created_at->diffForHumans();
            })
            ->editColumn('estado',function($ve){
                return view('ventas.estado',['venta'=>$ve])->render();
            })
            
            ->addColumn('action', function($ve){
                return view('ventas.acciones',['venta'=>$ve])->render();
            })
            ->rawColumns(['propiedad_id','estado','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \iopro\Models\Venta $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Venta $model)
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
            'numero',
            'medidaTotal',
            'estado',
            'propiedad_id',
            'created_at',
            'updated_at'
        ];
    }


    protected function getColumnsTable()
    {
        return [
            
            'numero'=>['title'=>'Número de venta'],
            'medidaTotal',
            'estado',
            'propiedad_id',
            'created_at',
            'updated_at'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Ventas_' . date('YmdHis');
    }
}
