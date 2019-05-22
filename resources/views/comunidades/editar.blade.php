@extends('layouts.app',['title'=>'Actualizar comunidad'])

@section('breadcrumbs', Breadcrumbs::render('editarComunidad',$comunidad))

@section('acciones')

    <a href="{{ route('comunidades',$comunidad->parroquia->id) }}" class="breadcrumb-elements-item">
        <i class="fas fa-arrow-left"></i>
        atras
    </a>

@endsection


@section('content')
<div class="card">
     <div class="card-body">
         <form method="POST" action="{{ route('actualizarComunidad') }}">
            @csrf
            <input type="hidden" name="comunidad" value="{{ $comunidad->id }}">

            @if(count($aso)>0)
            <div class="form-group">
                <select class="selectpicker show-tick form-control" name="asociacion" required="" data-live-search="true" title="Selecione una asociación..." autofocus="" data-header="Selecione una comunidad">
                    @foreach($aso as $as)
                        <option value="{{ $as->id }}" data-subtext="{{ $as->descripcion }}" {{ ( (old('asociacion') == $as->id || $comunidad->asociacion->id==$as->id) ? 'selected':'') }}>{{ $as->nombre }}</option>
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
                    <input id="nombre" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="nombre" value="{{ $comunidad->nombre }}" required autocomplete="nombre" autofocus placeholder="Ingrese..">

                    @if ($errors->has('nombre'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nombre') }}</strong>
                        </span>
                    @endif
            </div>

            <div class="form-group">
                <label for="codigo" class="">{{ __('Código') }}</label>
                
                    <input id="codigo" type="text" class="form-control{{ $errors->has('codigo') ? ' is-invalid' : '' }}" name="codigo" value="{{ $comunidad->codigo }}" required autocomplete="codigo" placeholder="Ingrese..">

                    @if ($errors->has('codigo'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('codigo') }}</strong>
                        </span>
                    @endif
                
            </div>

            <button type="submit" class="btn btn-primary">
                {{ __('Actualizar') }}
            </button>
        </form>
     </div>
</div>


<script>
	$('#m_canton').addClass('active');
</script>
@endsection
