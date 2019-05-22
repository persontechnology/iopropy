@extends('layouts.app',['title'=>'Comunidades'])
@section('breadcrumbs')
    {{ Breadcrumbs::render('comunidadListaEnParroquia',$parroquia) }}
@endsection

@section('acciones')
<div class="breadcrumb justify-content-center">
   <a href="{{ route('parroquiasLista') }}" class="breadcrumb-elements-item">
        <i class="fas fa-arrow-left"></i>
        atras
    </a>
    <a href="{{ route('agregarComunidad',$parroquia->id) }}" class="breadcrumb-elements-item">
        <i class="fas fa-plus"></i>
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
	$('#m_parroquia').addClass('active');
</script>
@endsection
