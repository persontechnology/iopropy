@extends('layouts.app',['title'=>'Información ventas'])
@section('breadcrumbs')
    {{ Breadcrumbs::render('infoVenta',$venta) }}
@endsection

@section('acciones')

<div class="breadcrumb justify-content-center">
  <a href="{{ route('ventas') }}" class="breadcrumb-elements-item">
      <i class="fas fa-arrow-left"></i>
      Cancelar
  </a>
</div>
@endsection

@section('content')
<div class="card">
  <div class="card-body">
    	@include('ventas.datos')
  </div>
</div>


<script>
	$('#m_ventas').addClass('active');
</script>
@endsection
