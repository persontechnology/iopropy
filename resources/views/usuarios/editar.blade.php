@extends('layouts.app',['title'=>'Autoridades'])


@section('breadcrumbs', Breadcrumbs::render('editarUsuario',$user))

@section('acciones')

  <div class="breadcrumb justify-content-center">
    <a href="{{ route('usuarios') }}" class="breadcrumb-elements-item">
        <i class="fas fa-arrow-left"></i>
        Atras
    </a>
</div>
@endsection


@section('content')
<div class="card">
  <div class="card-body">
    <form action="{{ route('actualizarUsuario') }}" method="post" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="id" value="{{ $user->id }}" required="">
      
              <fieldset>
                  <legend class="font-weight-semibold"><i class="icon-reading mr-2"></i> Detalle personal</legend>

                  <div class="form-group row">
                      <label class="col-lg-3 col-form-label" for="nombres">Nombres<span class="text-danger">*</span></label>
                      <div class="col-lg-9">
                          <input type="text" class="form-control{{ $errors->has('nombres') ? ' is-invalid' : '' }}" name="nombres" id="nombres" placeholder="Ingrese.." required="" value="{{ old('nombres',$user->nombres) }}">
                          @if ($errors->has('nombres'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('nombres') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>

                  <div class="form-group row">
                      <label class="col-lg-3 col-form-label" for="apellidos">Apellidos<span class="text-danger">*</span></label>
                      <div class="col-lg-9">
                          <input type="text" name="apellidos" id="apellidos" class="form-control{{ $errors->has('apellidos') ? ' is-invalid' : '' }}" placeholder="Ingrese.." required="" value="{{ old('apellidos',$user->apellidos) }}">
                           @if ($errors->has('apellidos'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('apellidos') }}</strong>
                              </span>
                          @endif

                      </div>
                      
                  </div>

                  <div class="form-group row">
                      <label class="col-lg-3 col-form-label" for="tipoIdentificacion">Tipo de identificación<span class="text-danger">*</span></label>
                      <div class="col-lg-9">
                          <select class="selectpicker form-control{{ $errors->has('tipoIdentificacion') ? ' is-invalid' : '' }}" id="tipoIdentificacion" name="tipoIdentificacion" required="">
                            <option value="Cédula" {{ old('tipoIdentificacion')=='Cédula'?'selected':'' }}>Cédula</option>
                            <option value="RUC de persona natural" {{ old('tipoIdentificacion',$user->tipoIdentificacion)=='RUC de persona natural'?'selected':'' }}>RUC de persona natural</option>
                            <option value="RUC de sociedad privada" {{ old('tipoIdentificacion',$user->tipoIdentificacion)=='RUC de sociedad privada'?'selected':'' }}>RUC de sociedad privada</option>
                            <option value="RUC de sociedad pública" {{ old('tipoIdentificacion',$user->tipoIdentificacion)=='RUC de sociedad pública'?'selected':'' }}>RUC de sociedad pública</option>
                            <option value="Pasaporte" {{ old('tipoIdentificacion',$user->tipoIdentificacion)=='Pasaporte'?'selected':'' }}>Pasaporte</option>
                            <option value="Consumidor final" {{ old('tipoIdentificacion',$user->tipoIdentificacion)=='Consumidor final'?'selected':'' }}>Consumidor final</option>

                          </select>
                          @if ($errors->has('tipoIdentificacion'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('tipoIdentificacion') }}</strong>
                              </span>
                          @endif

                      </div>
                  </div>

                  <div class="form-group row">
                      <label class="col-lg-3 col-form-label" for="identificacion">Identificación<span class="text-danger">*</span></label>
                      <div class="col-lg-9">
                          <input type="number" name="identificacion" id="identificacion"  class="form-control{{ $errors->has('identificacion') ? ' is-invalid' : '' }}" placeholder="Ingrese.." required=""  value="{{ old('identificacion',$user->identificacion) }}">
                          @if ($errors->has('identificacion'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('identificacion') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>

                  <div class="form-group row">
                      <label class="col-lg-3 col-form-label" for="sexo">Sexo:<span class="text-danger">*</span></label>
                      <div class="custom-control custom-radio">
                          <input type="radio" class="custom-control-input {{ $errors->has('sexo') ? ' is-invalid' : '' }}" value="Hombre" id="Hombre" name="sexo"  required {{ old('sexo',$user->sexo)=='Hombre'?'checked':'checked' }}>
                          <label class="custom-control-label" for="Hombre">Hombre</label>
                      </div>
                      <div class="custom-control custom-radio mb-3">
                          <input type="radio" class="custom-control-input{{ $errors->has('sexo') ? ' is-invalid' : '' }}" value="Mujer" id="Mujer" name="sexo" required {{ old('sexo',$user->sexo)=='Mujer'?'checked':'' }}>
                          <label class="custom-control-label" for="Mujer">Mujer</label>
                          
                          @if ($errors->has('sexo'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('sexo') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>

                  <div class="form-group row">
                      <label class="col-lg-3 col-form-label" for="sexo">Estado civil:<span class="text-danger">*</span></label>
                      
                      <div class="custom-control custom-radio">
                          <input type="radio" class="custom-control-input {{ $errors->has('estadoCivil') ? ' is-invalid' : '' }}" value="Casado/a" id="Casado/a" name="estadoCivil"  required {{ old('estadoCivil',$user->estadoCivil)=='Casado/a'?'checked':'checked' }}>
                          <label class="custom-control-label" for="Casado/a">Casado/a</label>
                      </div>

                      <div class="custom-control custom-radio">
                          <input type="radio" class="custom-control-input {{ $errors->has('estadoCivil') ? ' is-invalid' : '' }}" value="Soltero/a" id="Soltero/a" name="estadoCivil"  required {{ old('estadoCivil',$user->estadoCivil)=='Soltero/a'?'checked':'' }}>
                          <label class="custom-control-label" for="Soltero/a">Soltero/a</label>
                      </div>
                     

                      <div class="custom-control custom-radio">
                          <input type="radio" class="custom-control-input {{ $errors->has('estadoCivil') ? ' is-invalid' : '' }}" value="Divorciado/a" id="Divorciado/a" name="estadoCivil"  required {{ old('estadoCivil',$user->estadoCivil)=='Divorciado/a'?'checked':'' }}>
                          <label class="custom-control-label" for="Divorciado/a">Divorciado/a</label>
                      </div>

                      <div class="custom-control custom-radio mb-3">
                          <input type="radio" class="custom-control-input{{ $errors->has('estadoCivil') ? ' is-invalid' : '' }}" value="Vuido/a" id="Vuido/a" name="estadoCivil" required {{ old('estadoCivil',$user->estadoCivil)=='Vuido/a'?'checked':'' }}>
                          <label class="custom-control-label" for="Vuido/a">Vuido/a</label>
                          
                          @if ($errors->has('estadoCivil'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('estadoCivil') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>

                  
                  <div class="form-group row">
                      <label class="col-lg-3 col-form-label">Contactos:</label>
                      <div class="col-lg-9">
                          <div class="row">
                              <div class="col-md-6">
                                  <input type="number" placeholder="Celular" name="celular" id="celular" class="form-control{{ $errors->has('celular') ? ' is-invalid' : '' }}" value="{{ old('celular',$user->celular) }}">
                                  @if ($errors->has('celular'))
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('celular') }}</strong>
                                      </span>
                                  @endif
                              </div>

                              <div class="col-md-6">
                                  <input type="number" name="telefono" id="telefono" placeholder="Télefono" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" value="{{ old('telefono',$user->telefono) }}">
                                  @if ($errors->has('telefono'))
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('telefono') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Detalle:</label>
                        <div class="col-lg-9">
                            <textarea class="form-control{{ $errors->has('detalle') ? ' is-invalid' : '' }}" name="detalle" id="detalle"  placeholder="Ingrese..">{{ old('detalle',$user->detalle) }} </textarea>
                            @if ($errors->has('detalle'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('detalle') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    @role('Administrador')
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="rol" id="exampleCheck1" {{ $user->hasRole('Asociacion')?'checked':'' }}>
                        <label class="form-check-label" for="exampleCheck1">Asignar rol de Autoridad</label>
                    </div>
                    @endrole

              </fieldset>
      

      <div class="text-right">
          <button type="submit" class="btn btn-primary">{{__('Actualizar')}} <i class="icon-paperplane ml-2"></i></button>
      </div>
    </form>
  </div>
</div>


<script>
	$('#m_usuarios').addClass('active');
   $('#tipoIdentificacion').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
        var tp=clickedIndex;
        if (tp==5) {
            $('#identificacion').val('0000000000');
        }else{
            $('#identificacion').val('')
        }
    });
</script>
@endsection
