<?php

namespace iopro\DataTables;

use iopro\Models\Periodo;
use Yajra\DataTables\Services\DataTable;

class AutoridadesEnAsociacionDataTable extends DataTable
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
            ->editColumn('users_id',function($per){
                return $per->autoridad->nombre_completo;
            })
            ->editColumn('estado',function($per){
                if ($per->estado) {
                    return '<span class="badge badge-success">En ejecucuión</span>';
                }else{
                    return '<span class="badge badge-danger">Finalizado</span>';
                }
            })
            ->filterColumn('users_id', function($query, $keyword) {
                $query->whereHas('autoridad', function($query) use ($keyword) {
                    $query->whereRaw("CONCAT(nombres,' ',apellidos,' ',identificacion) like ?", ["%{$keyword}%"]);
                });
            })
            ->addColumn('action', function($p){
                return view('periodos.acciones',['per'=>$p])->render();
            })->rawColumns(['estado','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \iopro\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Periodo $model)
    {
        return $model->newQuery()->where('asociacion_id',$this->idAso)->select($this->getColumns());
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
            'users_id',
            'estado',
            'rol',
            'created_at',
            'updated_at'
        ];
    }


    protected function getColumnsTable()
    {
        return [
            // 'id',
            'users_id'=>['title'=>'Autoridad'],
            'rol',
            'estado',
            'created_at'=>['title'=>'Fecha creado'],
            'updated_at'=>['title'=>'Fecha finalizado']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'AutoridadesEnAsociacion_' . date('YmdHis');
    }
}
