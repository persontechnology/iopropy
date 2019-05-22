@extends('layouts.app',['title'=>'Comunidades'])
@section('breadcrumbs')
    {{ Breadcrumbs::render('comunidades',$parroquia) }}
@endsection

@section('acciones')
<div class="breadcrumb justify-content-center">
    
    <a href="{{ route('parroquias',$parroquia->canton->id) }}" class="breadcrumb-elements-item">
        <i class="fas fa-arrow-left"></i>
        atras
    </a>
    <a href="{{ route('agregarComunidad',$parroquia->id) }}" class="breadcrumb-elements-item">
        <i class="far fa-file"></i>
        Agregar comunidad
    </a>
</div>
@stop

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
	$('#m_canton').addClass('active');
</script>
@endsection
