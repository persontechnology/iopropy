@extends('layouts.app',['title'=>'Autoridades'])


@section('breadcrumbs', Breadcrumbs::render('autoridades'))

@section('acciones')

  <div class="breadcrumb justify-content-center">
    <a href="{{ route('autoridades') }}" class="breadcrumb-elements-item">
        <i class="fas fa-arrow-left"></i>
        Atras
    </a>
</div>
@endsection


@section('content')

<script src="{{ asset('vendor/validate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('vendor/validate/messages_es.min.js') }}"></script>
<script src="{{ asset('vendor/validate/jquery_validate_extras.js') }}"></script>



<div class="card">
  <div class="card-body">
    <form action="{{ route('guardarAutoridad') }}" method="post" enctype="multipart/form-data" id="formNuevo">
      @csrf
      <div class="row">
          <div class="col-md-6">
              <fieldset>
                  <legend class="font-weight-semibold"><i class="icon-reading mr-2"></i> Detalle personal</legend>

                  <div class="form-group row">
                      <label class="col-lg-3 col-form-label" for="nombres">Nombres<span class="text-danger">*</span></label>
                      <div class="col-lg-9">
                          <input type="text" class="form-control{{ $errors->has('nombres') ? ' is-invalid' : '' }}" name="nombres" id="nombres" placeholder="Ingrese.." required="" value="{{ old('nombres') }}">
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
                          <input type="text" name="apellidos" id="apellidos" class="form-control{{ $errors->has('apellidos') ? ' is-invalid' : '' }}" placeholder="Ingrese.." required="" value="{{ old('apellidos') }}">
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
                            <option value="RUC de persona natural" {{ old('tipoIdentificacion')=='RUC de persona natural'?'selected':'' }}>RUC de persona natural</option>
                            <option value="RUC de sociedad privada" {{ old('tipoIdentificacion')=='RUC de sociedad privada'?'selected':'' }}>RUC de sociedad privada</option>
                            <option value="RUC de sociedad pública" {{ old('tipoIdentificacion')=='RUC de sociedad pública'?'selected':'' }}>RUC de sociedad pública</option>
                            <option value="Pasaporte" {{ old('tipoIdentificacion')=='Pasaporte'?'selected':'' }}>Pasaporte</option>
                            <option value="Consumidor final" {{ old('tipoIdentificacion')=='Consumidor final'?'selected':'' }}>Consumidor final</option>

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
                          <input type="number" name="identificacion" id="identificacion"  class="form-control{{ $errors->has('identificacion') ? ' is-invalid' : '' }}" placeholder="Ingrese.." required=""  value="{{ old('identificacion') }}">
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
                          <input type="radio" class="custom-control-input {{ $errors->has('sexo') ? ' is-invalid' : '' }}" value="Hombre" id="Hombre" name="sexo"  required {{ old('sexo')=='Hombre'?'checked':'checked' }}>
                          <label class="custom-control-label" for="Hombre">Hombre</label>
                      </div>
                      <div class="custom-control custom-radio mb-3">
                          <input type="radio" class="custom-control-input{{ $errors->has('sexo') ? ' is-invalid' : '' }}" value="Mujer" id="Mujer" name="sexo" required {{ old('sexo')=='Mujer'?'checked':'' }}>
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
                          <input type="radio" class="custom-control-input {{ $errors->has('estadoCivil') ? ' is-invalid' : '' }}" value="Casado/a" id="Casado/a" name="estadoCivil"  required {{ old('estadoCivil')=='Casado/a'?'checked':'checked' }}>
                          <label class="custom-control-label" for="Casado/a">Casado/a</label>
                      </div>

                      <div class="custom-control custom-radio">
                          <input type="radio" class="custom-control-input {{ $errors->has('estadoCivil') ? ' is-invalid' : '' }}" value="Soltero/a" id="Soltero/a" name="estadoCivil"  required {{ old('estadoCivil')=='Soltero/a'?'checked':'' }}>
                          <label class="custom-control-label" for="Soltero/a">Soltero/a</label>
                      </div>
                     

                      <div class="custom-control custom-radio">
                          <input type="radio" class="custom-control-input {{ $errors->has('estadoCivil') ? ' is-invalid' : '' }}" value="Divorciado/a" id="Divorciado/a" name="estadoCivil"  required {{ old('estadoCivil')=='Divorciado/a'?'checked':'' }}>
                          <label class="custom-control-label" for="Divorciado/a">Divorciado/a</label>
                      </div>

                      <div class="custom-control custom-radio mb-3">
                          <input type="radio" class="custom-control-input{{ $errors->has('estadoCivil') ? ' is-invalid' : '' }}" value="Vuido/a" id="Vuido/a" name="estadoCivil" required {{ old('estadoCivil')=='Vuido/a'?'checked':'' }}>
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
                                  <input type="number" placeholder="Celular" name="celular" id="celular" class="form-control{{ $errors->has('celular') ? ' is-invalid' : '' }}" value="{{ old('celular') }}">
                                  @if ($errors->has('celular'))
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('celular') }}</strong>
                                      </span>
                                  @endif
                              </div>

                              <div class="col-md-6">
                                  <input type="number" name="telefono" id="telefono" placeholder="Télefono" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" value="{{ old('telefono') }}">
                                  @if ($errors->has('telefono'))
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('telefono') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>
                      </div>
                  </div>

              </fieldset>
          </div>

          <div class="col-md-6">
              <fieldset>
                  <legend class="font-weight-semibold"><i class="icon-truck mr-2"></i> Información de cuenta</legend>

             

                  <div class="form-group row">
                      <label for="name" class="col-lg-3 col-form-label">{{ __('Name') }} de usuario<span class="text-danger">*</span></label>

                      <div class="col-lg-9">
                          <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autocomplete="name">

                          @if ($errors->has('name'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('name') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>

                  <div class="form-group row">
                      <label for="email" class="col-lg-3 col-form-label">{{ __('E-Mail Address') }}<span class="text-danger">*</span></label>

                      <div class="col-lg-9">
                          <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autocomplete="email">

                          @if ($errors->has('email'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('email') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>

                  <div class="form-group row">
                      <label for="password" class="col-lg-3 col-form-label">{{ __('Password') }}<span class="text-danger">*</span></label>

                      <div class="col-lg-9">
                          <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required autocomplete="new-password">

                          @if ($errors->has('password'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('password') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>

                  <div class="form-group row">
                      <label for="password-confirm" class="col-lg-3 col-form-label">{{ __('Confirm Password') }}<span class="text-danger">*</span></label>

                      <div class="col-lg-9">
                          <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                      </div>
                  </div>


                  <div class="form-group row">
                      <label class="col-lg-3 col-form-label">Detalle:</label>
                      <div class="col-lg-9">
                          <textarea class="form-control{{ $errors->has('detalle') ? ' is-invalid' : '' }}" name="detalle" id="detalle"  placeholder="Ingrese..">{{ old('detalle') }} </textarea>
                          @if ($errors->has('detalle'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('detalle') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>

                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="rolfedereacion" name="rolfedereacion">
                    <label class="form-check-label" for="rolfedereacion">Asignar rol de federación</label>
                  </div>
        
              </fieldset>
          </div>
      </div>

      <div class="text-right">
          <button type="submit" class="btn btn-primary">{{__('Guardar')}} <i class="icon-paperplane ml-2"></i></button>
      </div>
    </form>
  </div>
</div>


<script>
	$('#m_autoridades').addClass('active');
   $('#tipoIdentificacion').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
        var tp=clickedIndex;
        if (tp==5) {
            $('#identificacion').val('0000000000');
        }else{
            $('#identificacion').val('')
        }
    });


    $('#formNuevo').validate(
        {
            rules:{
                identificacion:{
                    cedula:true
                }
            },
            errorElement: "em",
            errorPlacement: function ( error, element ) {
                // Add the `invalid-feedback` class to the error element
                error.addClass( "invalid-feedback" );

                if ( element.prop( "type" ) === "checkbox" ) {
                    error.insertAfter( element.next( "label" ) );
                } else {
                    error.insertAfter( element );
                }
            },
            highlight: function ( element, errorClass, validClass ) {
                $( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
            },
            unhighlight: function (element, errorClass, validClass) {
                $( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
            }
        }
    );
</script>
@endsection
