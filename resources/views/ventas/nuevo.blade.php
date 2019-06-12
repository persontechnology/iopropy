@extends('layouts.app',['title'=>'Nuevo venta'])

 @section('breadcrumbs', Breadcrumbs::render('nuevoVenta'))

@section('acciones')

  <div class="breadcrumb justify-content-center">
    <a href="{{ route('ventas') }}" class="breadcrumb-elements-item">
        <i class="fas fa-arrow-left"></i>
        Cancelar
    </a>
</div>
@endsection


@section('content')

<div class="card">
  <div class="card-body">
    <form action="{{ route('guardarVenta') }}" method="post" >
      @csrf
      
        <fieldset>
            <legend class="font-weight-semibold"><i class="icon-reading mr-2"></i> Complete la información de la propiedad</legend>

            <button type="button" class="btn btn-outline-dark btn-block btn-lg" data-toggle="modal" data-target="#modalPropiedad">
                <i class="fas fa-globe-europe"></i> Selecione una propiedad
            </button>

            
            {{--  prpiedad  --}}
            <input type="hidden" name="propiedad" id="propiedad" value="{{ old('propiedad') }}" required>

            <div class="form-group row mt-2">
                <label class="col-lg-3 col-form-label" for="numeroVenta">Número de venta:<span class="text-danger">*</span></label>
                <div class="col-lg-9">
                    <input type="text" class="form-control{{ $errors->has('numeroVenta') ? ' is-invalid' : '' }}" name="numeroVenta" id="numeroVenta" placeholder="Ingrese.." required="" value="{{ old('numeroVenta',($venta->id??0)+1) }}">
                    @if ($errors->has('numeroVenta'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('codigo') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-3 col-form-label" for="codigo">Código de propiedad:<span class="text-danger">*</span></label>
                <div class="col-lg-9">
                    <input type="text" class="form-control{{ $errors->has('codigo') ? ' is-invalid' : '' }}" name="codigo" id="codigo" placeholder="Ingrese.." required="" value="{{ old('codigo') }}" disabled>
                    @if ($errors->has('codigo'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('codigo') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-3 col-form-label" for="medidaTotal">Medida total:<span class="text-danger">*</span></label>
                <div class="col-lg-9">
                    <input type="text" class="form-control{{ $errors->has('medidaTotal') ? ' is-invalid' : '' }}" name="medidaTotal" id="medidaTotal" placeholder="Ingrese.." required="" value="{{ old('medidaTotal') }}" disabled>
                    @if ($errors->has('medidaTotal'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('medidaTotal') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-3 col-form-label" for="precioEstimado">Precio estimado:<span class="text-danger">*</span></label>
                <div class="col-lg-9">
                    <input type="text" class="form-control{{ $errors->has('precioEstimado') ? ' is-invalid' : '' }}" name="precioEstimado" id="precioEstimado" placeholder="Ingrese.." required="" value="{{ old('precioEstimado') }}">
                    @if ($errors->has('precioEstimado'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('precioEstimado') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            
            @if(count($usuarios)>0)
            {{--  propietarios actualues  --}}

            <div class="form-group">
                <label for="propietariosNuevos">Selecione propietario/s nuevo/s:<span class="text-danger">*</span></label>
                <select class="selectpicker show-tick form-control" id="propietariosNuevos" name="propietariosNuevos[]" required="" data-live-search="true" title="Selecione propietario/s nuevos..." data-header="Selecione propietario/s nuevos" multiple data-selected-text-format="count > 3">
                    @foreach($usuarios as $uac)
                        <option value="{{ $uac->id }}" data-tokens="{{ $uac->email }}" data-subtext="{{ $uac->identificacion }}" {{ (collect(old('propietariosNuevos'))->contains($uac->id)) ? 'selected':'' }}>{{ $uac->nombres }} {{ $uac->apellidos }}</option>
                    @endforeach
                </select>
            </div>


            @else
            <div class="alert alert-info alert-dismissible alert-styled-left fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                <strong>No existe usuarios para asignar a la propiedad.</strong>
            </div> 
        @endif
        


        </fieldset>
        
    <button type="submit" class="btn btn-primary">{{__('Guardar')}} <i class="icon-paperplane ml-2"></i></button>
    </form>
  </div>
</div>


{{--  modal propiedades  --}}
<div class="modal fade bd-example-modal-lg" id="modalPropiedad" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="table-responsive">
                    {!! $dataTable->table()  !!}
            </div>
        </div>
    </div>
</div>


{!! $dataTable->scripts() !!}

<script>
	$('#m_ventas').addClass('active');
        
    function selecionar(arg){
        $('#codigo').val($(arg).data('codigo'))
        $('#propiedad').val($(arg).data('id'))
        $('#medidaTotal').val($(arg).data('medida'))
        $('#precioEstimado').val($(arg).data('precio'))
        $('#modalPropiedad').modal('hide');
    }
    
</script>
@endsection
