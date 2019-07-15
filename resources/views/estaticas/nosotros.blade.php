@extends('layouts.info',['title'=>'Acerca de nosotros'])
@section('breadcrumbs', Breadcrumbs::render('nosotros'))

@section('content')

@include('estaticas.nosotrosinfo')

<script>
    $('#m_nosotros').addClass('active')
</script>
@endsection