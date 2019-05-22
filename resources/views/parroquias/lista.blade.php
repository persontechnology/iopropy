@extends('layouts.app',['title'=>'Parroquias'])
@section('breadcrumbs')
    {{ Breadcrumbs::render('parroquiasLista') }}
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
	$('#m_parroquia').addClass('active');
</script>
@endsection
