@extends('layouts.app',['title'=>'Usuarios'])
@section('breadcrumbs')
    {{ Breadcrumbs::render('usuarios') }}
@endsection

@section('acciones')

  <div class="breadcrumb justify-content-center">
    <a href="{{ route('nuevoUsuario') }}" class="breadcrumb-elements-item">
        <i class="fas fa-plus"></i>
        Nuevo usuario
    </a>
</div>
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
	$('#m_usuarios').addClass('active');
</script>
@endsection
