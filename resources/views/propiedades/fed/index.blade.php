@extends('layouts.app',['title'=>'Propiedades'])
@section('breadcrumbs', Breadcrumbs::render('propiedadesFed'))
@section('acciones')

  <div class="breadcrumb justify-content-center">
    <a href="{{ route('nuevaPropiedadFed') }}" class="breadcrumb-elements-item">
        <i class="fas fa-plus"></i>
        Nueva propiedad
    </a>
  </div>

@endsection

@section('content')

@if (session('extra'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Propiedad actualizado exitosamente.!</strong><br>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <a href="{{ route('editarPropiedadFed',session('extra')) }}" class="btn btn-success"><i class="fas fa-tasks"></i> ACTUALIZAR INFORMACIÓN</a>
  <a href="{{ route('informacionPropiedadFed',session('extra')) }}" class="btn btn-primary"><i class="fas fa-eye"></i> VER INFORMACIÓN</a>
  <a href="{{ route('verPdfPropiedadFed',session('extra')) }}" class="btn btn-dark "><i class="fas fa-file-pdf"></i></i> DESCARGAR PDF</a>
  <a href="{{ route('imprimirPropiedadFed',session('extra')) }}" class="btn btn-warning "><i class="fas fa-print"></i> IMPRIMIR</a>
  

</div>
@endif

<div class="card">
  <div class="card-body">
    	<div class="table-responsive">
        	{!! $dataTable->table()  !!}
        </div>
  </div>
</div>
{!! $dataTable->scripts() !!}

<script>
	$('#m_propiedades').addClass('active');
</script>
@endsection
