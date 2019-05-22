@extends('layouts.app',['title'=>'Agregar comunidad'])
@section('breadcrumbs')
    {{ Breadcrumbs::render('nuevaAsociacion') }}
@endsection
@section('acciones')
<div class="breadcrumb justify-content-center">
    
    <a href="{{ route('asociaciones') }}" class="breadcrumb-elements-item">
        <i class="fas fa-arrow-left"></i>
        atras
    </a>
</div>
@stop

@section('content')
<div class="card">
     <div class="card-body">
         <form method="POST" action="{{ route('guardarAsociacion') }}">
            @csrf
            
            <div class="form-group row">
                <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}<span class="text-danger">*</span></label>

                <div class="col-md-6">
                    <input id="nombre" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" placeholder="Ingrese.." autofocus>

                    @if ($errors->has('nombre'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nombre') }}</strong>
                        </span>
                    @endif
                </div>
            </div>


            <div class="form-group row">
                <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}<span class="text-danger">*</span></label>

                <div class="col-md-6">
                    
                    <textarea id="descripcion" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}"  name="descripcion" placeholder="Ingrese.." required="">{{ old('descripcion') }}</textarea>

                    @if ($errors->has('descripcion'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('descripcion') }}</strong>
                        </span>
                    @endif
                </div>
            </div>


            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                    </button>
                </div>
            </div>
        </form>
     </div>
</div>


<script>
	$('#m_asociacion').addClass('active');
</script>
@endsection
