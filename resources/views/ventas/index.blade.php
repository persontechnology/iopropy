@extends('layouts.app',['title'=>'Ventas'])
@section('breadcrumbs')
    {{ Breadcrumbs::render('ventas') }}
@endsection

@section('acciones')

  <div class="breadcrumb justify-content-center">
    <a href="{{ route('nuevoVenta') }}" class="breadcrumb-elements-item">
        <i class="fas fa-plus"></i>
        Nuevo venta
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
	$('#m_ventas').addClass('active');
</script>
@endsection
