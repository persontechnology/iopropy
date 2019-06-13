
@extends('layouts.app',['title'=>'Parroquias'])

 @section('breadcrumbs', Breadcrumbs::render('noticiasAdmin')) 

@section('acciones')

    <a href="{{ route('noticiaNuevo') }}" class="breadcrumb-elements-item">
        <i class="fas fa-plus"></i>
        Nuevo noticia
    </a>

@endsection


@section('content')
<div class="card">
  <div class="card-body">
    	<div class="table-responsive">
        	{!! $dataTable->table()  !!}
        </div>
  </div>
</div>
{!! $dataTable->scripts() !!}

<script>
	$('#m_noticia').addClass('active');
</script>
@endsection
