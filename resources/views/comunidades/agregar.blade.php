@extends('layouts.app',['title'=>'Agregar comunidad'])
@section('breadcrumbs')
    {{ Breadcrumbs::render('agregarComunidad',$parroquia) }}
@endsection
@section('acciones')
<div class="breadcrumb justify-content-center">
    
    <a href="{{ route('comunidades',$parroquia->id) }}" class="breadcrumb-elements-item">
        <i class="fas fa-arrow-left"></i>
        atras
    </a>
</div>
@stop

@section('content')
<div class="card">
     <div class="card-body">
         <form method="POST" action="{{ route('guardarComunidad') }}">
            @csrf
            <input type="hidden" name="parroquia" value="{{ $parroquia->id }}">
            
            @if(count($aso)>0)
            <div class="form-group">
                <select class="selectpicker show-tick form-control" name="asociacion" required="" data-live-search="true" title="Selecione una asociación..." autofocus="" data-header="Selecione una comunidad" data-none-results-text="No hay resultados coincidentes {0} <a href='{{ route('nuevaAsociacion') }}' target='_blank'>Crear nueva asociación</a>">
                    @foreach($aso as $as)
                        <option value="{{ $as->id }}" data-subtext="{{ $as->descripcion }}" {{ (old('asociacion') == $as->id ? 'selected':'') }}>{{ $as->nombre }}</option>
                    @endforeach
                  
                </select>
            </div>
            @else
            <div class="alert alert-info alert-dismissible alert-styled-left fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <strong>No existe asociaciones para crear una comunidad</strong>
            </div> 
            @endif


            <div class="form-group">
                <label for="nombre" class="">{{ __('Name') }}</label>
       
                    <input id="nombre" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" >
                    @if ($errors->has('nombre'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nombre') }}</strong>
                        </span>
                    @endif
                
            </div>

           <button type="submit" class="btn btn-primary">
                {{ __('Register') }}
            </button>
        </form>
     </div>
</div>


<script>
	$('#m_canton').addClass('active');
</script>
@endsection
