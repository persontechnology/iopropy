
@extends('layouts.app',['title'=>'Parroquias'])

@section('breadcrumbs', Breadcrumbs::render('parroquias',$canton))

@section('acciones')

    <a href="{{ route('cantones') }}" class="breadcrumb-elements-item">
        <i class="fas fa-arrow-left"></i>
        atras
    </a>

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
