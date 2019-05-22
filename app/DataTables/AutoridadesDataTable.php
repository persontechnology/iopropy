<?php

namespace iopro\DataTables;

use iopro\User;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Auth;

class AutoridadesDataTable extends DataTable
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
            ->addColumn('action', function($user){
                return view('autoridades.acciones',['user'=>$user])->render();
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \iopro\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()->where('id','!=',Auth::id())->role('Asociacion')->select($this->getColumns());
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
            'id',
            'identificacion',
            'nombres',
            'apellidos',
            'email'
        ];
    }

    protected function getColumnsTable()
    {
        return [
            // 'id',
            'identificacion'=>['title'=>'Identificación'],
            'nombres',
            'apellidos',
            'email'
        ];
    }
    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Autoridades_' . date('YmdHis');
    }
}
