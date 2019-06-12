<?php

namespace iopro\DataTables;

use iopro\Models\Propiedad;
use iopro\User;
use Yajra\DataTables\Services\DataTable;

class MisPropiedadesDataTable extends DataTable
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
        ->editColumn('tieneCasa',function($pa){
            if($pa->tienCasa){
                return 'si';
            }return 'no';
        })
        ->editColumn('camino',function($pa){
            if($pa->camino){
                return 'si';
            }return 'no';
        })
        ->addColumn('action', function($pro){
            return view('propiedades.fed.acciones',['pro'=>$pro])->render();
        });;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \iopro\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Propiedad $model)
    {
        $user=User::find($this->idUser);
        $model=$user->propiedadesActuales();
        return $model->newQuery()->select('propiedad.*')->orderBy('created_at','desc');
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
            'serviciosBasicos'=>['title'=>' Servicios Básicos'],
            
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'MisPropiedades_' . date('YmdHis');
    }
}
