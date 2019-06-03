@extends('layouts.app',['title'=>'Mis comunidades'])
@section('breadcrumbs', Breadcrumbs::render('miComunidades',$aso))

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
	$('#m_miasociaciones').addClass('active');
</script>
@endsection
