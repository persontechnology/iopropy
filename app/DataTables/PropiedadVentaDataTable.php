<?php

namespace iopro\DataTables;

use iopro\Models\Propiedad;
use Yajra\DataTables\Services\DataTable;

class PropiedadVentaDataTable extends DataTable
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
            ->editColumn('latitud',function($pro){
                return '<a href="'.route('informacionPropiedadFed',$pro->id).'" target="_blanck">Ver propiedad</a>';
            })
            ->addColumn('action', function($pro){
                return '<button type="button" data-id="'.$pro->id.'" data-precio="'.$pro->precioEstimado.'" data-medida="'.$pro->medidaTotal.'" data-codigo="'.$pro->codigo.'" onclick="selecionar(this);" class="btn btn-info btn-sm"><i class="fas fa-check-circle"></i></button>';
            })
            ->rawColumns(['latitud','action']);
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
                    ->addAction(['width' => '80px','printable' => false, 'exportable' => false,'title'=>'Selecionar'])
                    ->parameters($this->getBuilderParameters());
    }  

    public function getBuilderParameters()
    {
        return [
            'dom'     => '<"datatable-header"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
            'order'   => [[0, 'desc']],
            'sPaginationType'=> 'full_numbers',
            'autoWidth' => false,
            'lengthMenu'=> [
                [ 10, 25, 50, -1 ],
                [ '10 filas', '25 filas', '50 filas', 'Mostrar todo' ]
            ],
            'buttons' => [
              [
                'extend'=>'reset',
                'className'=> 'btn btn-light btn-sm',
                'text'=>'<i class="fas fa-undo-alt"></i> Resetear'
              ],
              [
                'extend'=>'reload',
                'className'=> 'btn btn-light btn-sm',
                'text'=>'<i class="fas fa-sync"></i> Recargar'
              ]
            ],
            'language'=> [
                "sProcessing"=> "Procesando...",
                "sLengthMenu"=> "Mostrar _MENU_ registros",
                "sZeroRecords"=> "No se encontraron resultados",
                "sEmptyTable"=> "Ningún dato disponible en esta tabla",
                "sInfo"=> "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty"=> "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered"=> "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix"=> "",
                "sSearch"=> "Buscar:",
                "sUrl"=> "",
                "sInfoThousands"=> ",",
                "sLoadingRecords"=> "Cargando...",
        
                "oPaginate"=> [
                    "sFirst"=> "Primero",
                    "sLast"=> "Último",
                    "sNext"=> "Siguiente",
                    "sPrevious"=> "Anterior"
                ],
                "oAria"=> [
                    "sSortAscending"=> ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending"=> ": Activar para ordenar la columna de manera descendente"
                ]
                ]
            
        ];
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
            'latitud'
        ];
    }

    protected function getColumnsTable()
    {
        return [
            
            'codigo'=>['title'=>'Código'],
            'medidaTotal',
            'precioEstimado',
            'latitud'=>['title'=>'Información']
        ];
    }
    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'PropiedadVenta_' . date('YmdHis');
    }
}
