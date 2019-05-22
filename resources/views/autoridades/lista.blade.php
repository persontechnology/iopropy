@extends('layouts.app',['title'=>'Autoridades'])


@section('breadcrumbs', Breadcrumbs::render('autoridades'))

@section('acciones')

  <div class="breadcrumb justify-content-center">
    <a href="{{ route('nuevaAutoridad') }}" class="breadcrumb-elements-item">
        <i class="fas fa-plus"></i>
        Nueva autoridad
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
	$('#m_autoridades').addClass('active');
</script>
@endsection
