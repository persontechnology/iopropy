@extends('layouts.app',['title'=>'Propiedades'])

@section('acciones')

  <div class="breadcrumb justify-content-center">
    <a href="{{ route('nuevaPropiedad',$comu->id) }}" class="breadcrumb-elements-item">
        <i class="fas fa-plus"></i>
        Nueva propiedad
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
	$('#m_canton').addClass('active');
</script>
@endsection
