@extends('layouts.app',['title'=>'Mis asociaciones'])
@section('breadcrumbs', Breadcrumbs::render('miAsociaciones'))
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
