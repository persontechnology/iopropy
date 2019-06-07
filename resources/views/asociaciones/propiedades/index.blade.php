@extends('layouts.app',['title'=>'Propiedades'])
@section('breadcrumbs', Breadcrumbs::render('propiedades',$comu))
@section('acciones')

  <div class="breadcrumb justify-content-center">
    <a href="{{ route('nuevaPropiedad',$comu->id) }}" class="breadcrumb-elements-item">
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
  <a href="{{ route('editarPropiedad',session('extra')) }}" class="btn btn-success"><i class="fas fa-tasks"></i> ACTUALIZAR INFORMACIÓN</a>
  <a href="{{ route('informacionPropiedad',session('extra')) }}" class="btn btn-primary"><i class="fas fa-eye"></i> VER INFORMACIÓN</a>
  <a href="{{ route('verPdfPropiedad',session('extra')) }}" class="btn btn-dark "><i class="fas fa-file-pdf"></i></i> DESCARGAR PDF</a>
  <a href="{{ route('imprimirPropiedad',session('extra')) }}" class="btn btn-warning "><i class="fas fa-print"></i> IMPRIMIR</a>
  

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
	$('#m_miasociaciones').addClass('active');
</script>
@endsection
