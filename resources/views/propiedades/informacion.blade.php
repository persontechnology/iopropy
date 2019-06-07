@extends('layouts.app',['title'=>'Información propiedad'])
@section('breadcrumbs', Breadcrumbs::render('informacionPropiedad',$propiedad))
@section('acciones')

  <div class="breadcrumb justify-content-center">
    <a href="{{ route('propiedades',$propiedad->comunidad->id) }}" class="breadcrumb-elements-item">
        <i class="fas fa-arrow-left"></i>
        Cancelar
    </a>
</div>
@endsection
@section('content')

<div class="card">
  <div class="card-header">
    <a href="{{ route('verPdfPropiedad',$propiedad->id) }}" class="btn btn-info">
        <i class="fas fa-file-pdf"></i> DESCARGAR PDF
    </a>
    <a href="{{ route('imprimirPropiedad',$propiedad->id) }}" class="btn btn-primary">
        <i class="fas fa-print"></i> IMPRIMIR
    </a>
  </div>
  <div class="card-body">
      @include('propiedades.datos')
  </div>
  <div class="card-footer text-muted">
    
  </div>
</div>


<script>
	$('#m_miasociaciones').addClass('active');
</script>
@endsection
