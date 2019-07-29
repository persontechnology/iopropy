@extends('layouts.app',['title'=>'Administración'])

@section('breadcrumbs', Breadcrumbs::render('home'))


@section('content')

@if (session('status'))
    
    <div class="alert alert-success alert-styled-left alert-arrow-left alert-dismissible">
		<button type="button" class="close" data-dismiss="alert"><span>×</span></button>
		<span class="font-weight-semibold">{{ session('status') }}</span> 
	</div>
    
@endif

<div class="card">
    <div class="card-header">
        <h1>Bienvenidos</h1>
    </div>
    <div class="card-body">
        <img src="{{ asset('img/fed.png') }}" alt="" class="img img-fluid">
    </div>
    <div class="card-footer text-muted">
        Federación Interprovincial de Centro Shuar <strong>FICSH</strong>
    </div>
</div>

<script>
    $('#m_home').addClass('active');

</script>


@endsection
