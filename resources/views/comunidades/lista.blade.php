@extends('layouts.app',['title'=>'Comunidades'])
@section('breadcrumbs')
    {{ Breadcrumbs::render('comunidadesLista') }}
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
	$('#m_comunidad').addClass('active');
</script>
@endsection
