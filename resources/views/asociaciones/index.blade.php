@extends('layouts.app',['title'=>'Asociaciones'])

@section('breadcrumbs', Breadcrumbs::render('asociaciones'))

@section('acciones')

    <a href="{{ route('nuevaAsociacion') }}" class="breadcrumb-elements-item">
        <i class="fas fa-plus"></i>
        Nueva asociación
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
	$('#m_asociacion').addClass('active');
</script>
@endsection
