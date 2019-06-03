@extends('layouts.app',['title'=>'Comunidades'])


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
