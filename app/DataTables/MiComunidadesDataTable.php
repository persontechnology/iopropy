<?php

namespace iopro\DataTables;

use iopro\User;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Auth;
use iopro\Models\Asociacion;

class MiComunidadesDataTable extends DataTable
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
         
            ->addColumn('action', function($micomu){
                return view('comunidades.misComunidades.acciones',['micomu'=>$micomu]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \iopro\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $model=Asociacion::find($this->idAso);
        
        return $model->comunidades()->select('*');
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
            
            'nombre'=>['title'=>'Comunidad'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'MiComunidades_' . date('YmdHis');
    }
}
