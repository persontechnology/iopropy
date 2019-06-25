@extends('layouts.app',['title'=>'Soporte del sistema'])
@section('breadcrumbs')
    {{ Breadcrumbs::render('soporte') }}
@endsection


@section('content')

<div class="container">
    
    <div class="row">
        
        <div class="col-md-12">
            <div class="card bg-dark">
                <div class="card-header">
                    Video EXPLICATIVO
                </div>
                <div class="card-body">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/vEHMG8nBW9k" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
                
            </div>
        </div>
    </div>


    <div class="row">
        
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Manual de usuario FEDERACIÓN
                </div>
                <div class="card-body">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="{{ asset('vendor/manual/aso.pdf') }}" allowfullscreen></iframe>
                    </div>
                </div>
                
            </div>
        </div>
    </div>


    <div class="row">
        
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Manual de usuario ASOCIACIÓN
                </div>
                <div class="card-body">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="{{ asset('vendor/manual/fed.pdf') }}" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    



</div>

@endsection
