<?php

namespace iopro\DataTables;

use iopro\Models\Canton;
use iopro\Models\Provincia;
use Yajra\DataTables\Services\DataTable;

class CantonDataTable extends DataTable
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

            ->editColumn('provincia_id',function($c){
                return $c->provincia->nombre;
            })

            ->filterColumn('provincia_id', function($query, $keyword) {
                $query->whereHas('provincia', function($query) use ($keyword) {
                    $query->whereRaw("nombre like ?", ["%{$keyword}%"]);
                });
            })

            ->addColumn('action', function($c){
                return view('cantones.acciones', ['id'=>$c->id])->render();
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \iopro\Canton $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Canton $model)
    {
        return $model->whereIn('provincia_id',['16','14','9','3'])->select($this->getColumns())->orderBy('codigo','asc');
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
                    ->addAction(['width' => '80px','printable' => false, 'exportable' => false,'title'=>'Parroquias'])
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
            'provincia_id'
        ];
    }

    protected function getColumnsTable()
    {
        return [
            /*'id',*/
           
            'nombre'=>['title'=>'Cantón'],
            'codigo'=>['title'=>'Código'],
            'provincia_id'=>['title'=>'Provincia']
            
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Canton_' . date('YmdHis');
    }
}
