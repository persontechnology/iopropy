<?php

namespace iopro\DataTables;

use iopro\Models\Noticia;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Storage;

class NoticiasDataTable extends DataTable
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
            ->editColumn('imagen',function($n){
                if($n->imagen){
                    $link=Storage::url('public/noticias/'.$n->imagen);
                    return '<a href="'.$link.'"><img src="'.$link.'" alt="" width="50px" height="50px" class="img-fluid"></a>';
                }else{
                    return '';
                }
            })


            ->editColumn('detalle',function($n){
                return str_limit($n->detalle, $limit = 10, $end = '...');
            })
            ->editColumn('estado',function($n){
                if($n->estado){
                    return '<a href="'.route('estadoNoticia',$n->id).'" class="badge badge-success" data-toggle="tooltip" data-placement="top" title="Cambiar a Sin publicar">Publicado</a>';
                }else{
                    return '<a href="'.route('estadoNoticia',$n->id).'" class="badge badge-danger" data-toggle="tooltip" data-placement="top" title="Cambiar a publicar">Sin publicar</a>';
                }
            })
            ->editColumn('propiedad_id',function($n){
                
                if($n->propiedad){
                    $cod=$n->propiedad->codigo??'';
                    return '<a href="'.route('informacionPropiedadFed',$n->propiedad->id).'">'.$cod.'</a>';
                }else{
                    return '';
                }
                
            })

            ->filterColumn('propiedad_id', function($query, $keyword) {
                $query->whereHas('propiedad', function($query) use ($keyword) {
                    $query->whereRaw("codigo like ?", ["%{$keyword}%"]);
                });
            })
            ->addColumn('action', function($n){
                return view('noticias.acciones',['n'=>$n])->render();
            })
            ->rawColumns(['propiedad_id','action','estado','imagen','detalle']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \iopro\Models\Noticia $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Noticia $model)
    {
        return $model->newQuery()->select($this->getColumns())->orderBy('updated_at','desc');
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
            'titulo',
            'detalle',
            'imagen',
            'propiedad_id',
            'estado',
            'created_at',
            'updated_at'
        ];
    }
    protected function getColumnsTable()
    {
        return [
            
            'titulo'=>['title'=>'Título'],
            'detalle',
            'imagen'=>['title'=>'Imagén'],
            'propiedad_id'=>['title'=>'Propiedad'],
            'estado',
            'created_at'=>['title'=>'Creado'],
            'updated_at'=>['title'=>'Actualizado']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Noticias_' . date('YmdHis');
    }
}
