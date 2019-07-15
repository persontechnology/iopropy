@extends('layouts.app',['title'=>'Nuevo propiedad'])

@section('breadcrumbs', Breadcrumbs::render('nuevaPropiedadFed'))

@section('acciones')

  <div class="breadcrumb justify-content-center">
    <a href="{{ route('propiedadesFed') }}" class="breadcrumb-elements-item">
        <i class="fas fa-arrow-left"></i>
        atras
    </a>
</div>
@endsection


@section('content')

<div class="card">
  <div class="card-body">
    <form action="{{ route('guardarPropiedadFed') }}" method="post" enctype="multipart/form-data">
      @csrf
      
      <div class="row">
          <div class="col-md-6">
              <fieldset>
                  <legend class="font-weight-semibold"><i class="icon-reading mr-2"></i> Complete la información de la propiedad</legend>
                

                    <div class="form-group">
                        <label for="propietariosAntiguo">Selecione una comunidad:<span class="text-danger">*</span></label>
                        <select class="selectpicker show-tick form-control" id="comunidad" name="comunidad" required="" data-live-search="true" title="Selecione una comunidad..." data-header="Selecione una comunidad">
                            @foreach($comunidades as $comu)
                                <option value="{{ $comu->id }}" data-tokens="{{ $comu->codigo }}" data-subtext="{{ $comu->parroquia->nombre }}-{{ $comu->parroquia->canton->nombre }}-{{ $comu->parroquia->canton->provincia->nombre }}" {{ old('comunidad')==$comu->id ? 'selected':'' }}>{{ $comu->nombre }}</option>
                            @endforeach
                        </select>
                    </div>



                  <div class="form-group row">
                    <label class="col-lg-3 col-form-label" for="codigo">Código:<span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control{{ $errors->has('codigo') ? ' is-invalid' : '' }}" name="codigo" id="codigo" placeholder="Ingrese.." required="" value="{{ old('codigo',str_random(15)) }}">
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
                          <input type="text" class="form-control{{ $errors->has('medidaTotal') ? ' is-invalid' : '' }}" name="medidaTotal" id="medidaTotal" placeholder="Ingrese.." required="" value="{{ old('medidaTotal') }}">
                          @if ($errors->has('medidaTotal'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('medidaTotal') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>

                  {{--  lindero norte  --}}
                  <div class="form-group row">
                    <label class="col-lg-3 col-form-label" for="linderoNorteCon">Lindero norte con:<span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control{{ $errors->has('linderoNorteCon') ? ' is-invalid' : '' }}" name="linderoNorteCon" id="linderoNorteCon" placeholder="Ingrese.." required="" value="{{ old('linderoNorteCon') }}">
                        @if ($errors->has('linderoNorteCon'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('linderoNorteCon') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                {{--  lindero sur  --}}
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label" for="linderoSurCon">Lindero sur con:<span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control{{ $errors->has('linderoSurCon') ? ' is-invalid' : '' }}" name="linderoSurCon" id="linderoSurCon" placeholder="Ingrese.." required="" value="{{ old('linderoSurCon') }}">
                        @if ($errors->has('linderoSurCon'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('linderoSurCon') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                {{--  lindero este  --}}
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label" for="linderoEsteCon">Lindero este con:<span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control{{ $errors->has('linderoEsteCon') ? ' is-invalid' : '' }}" name="linderoEsteCon" id="linderoEsteCon" placeholder="Ingrese.." required="" value="{{ old('linderoEsteCon') }}">
                        @if ($errors->has('linderoEsteCon'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('linderoEsteCon') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                {{--  lindero oeste  --}}
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label" for="linderoOesteCon">Lindero oeste con:<span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control{{ $errors->has('linderoOesteCon') ? ' is-invalid' : '' }}" name="linderoOesteCon" id="linderoOesteCon" placeholder="Ingrese.." required="" value="{{ old('linderoOesteCon') }}">
                        @if ($errors->has('linderoOesteCon'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('linderoOesteCon') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                
                
                


              </fieldset>
          </div>

          <div class="col-md-6">
            
            <fieldset>
                
                {{--  precio estimado  --}}
                
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

                {{--  servivicios basico  --}}
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label" >Servicios básicos:<span class="text-danger">*</span></label>
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input {{ $errors->has('serviciosBasicos') ? ' is-invalid' : '' }}" value="1" id="serviciosBasicosSi" name="serviciosBasicos"  required {{ old('serviciosBasicos')=='1'?'checked':'checked' }}>
                        <label class="custom-control-label" for="serviciosBasicosSi">Si</label>
                    </div>
                    <div class="custom-control custom-radio mb-3">
                        <input type="radio" class="custom-control-input{{ $errors->has('serviciosBasicos') ? ' is-invalid' : '' }}" value="0" id="serviciosBasicosNo" name="serviciosBasicos" required {{ old('serviciosBasicos')=='0'?'checked':'' }}>
                        <label class="custom-control-label" for="serviciosBasicosNo">No</label>
                        
                        @if ($errors->has('serviciosBasicos'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('serviciosBasicos') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                {{--  tiene cas  --}}

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label" >Casa:<span class="text-danger">*</span></label>
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input {{ $errors->has('tieneCasa') ? ' is-invalid' : '' }}" value="1" id="tieneCasaSi" name="tieneCasa"  required {{ old('tieneCasa')=='1'?'checked':'checked' }}>
                        <label class="custom-control-label" for="tieneCasaSi">Si</label>
                    </div>
                    <div class="custom-control custom-radio mb-3">
                        <input type="radio" class="custom-control-input{{ $errors->has('tieneCasa') ? ' is-invalid' : '' }}" value="0" id="tieneCasaNo" name="tieneCasa" required {{ old('tieneCasa')=='0'?'checked':'' }}>
                        <label class="custom-control-label" for="tieneCasaNo">No</label>
                        
                        @if ($errors->has('tieneCasa'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('tieneCasa') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                {{--  camino  --}}
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label" >Tiene camino:<span class="text-danger">*</span></label>
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input {{ $errors->has('camino') ? ' is-invalid' : '' }}" value="1" id="CaminoSi" name="camino"  required {{ old('camino')=='1'?'checked':'checked' }}>
                        <label class="custom-control-label" for="CaminoSi">Si</label>
                    </div>
                    <div class="custom-control custom-radio mb-3">
                        <input type="radio" class="custom-control-input{{ $errors->has('camino') ? ' is-invalid' : '' }}" value="0" id="CaminoNo" name="camino" required {{ old('camino')=='0'?'checked':'' }}>
                        <label class="custom-control-label" for="CaminoNo">No</label>
                        
                        @if ($errors->has('camino'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('camino') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                
                @if(count($usuarios)>0)

                {{--  propietarios antiguos  --}}
                <div class="form-group">
                    <label for="propietariosAntiguo">Selecione propietario/s antiguo/s:<span class="text-danger">*</span></label>
                    <select class="selectpicker show-tick form-control" name="propietariosAntiguo[]" required="" data-live-search="true" title="Selecione propietario/s antiguo/s..." data-header="Selecione propietario/s antiguo/s" multiple data-selected-text-format="count > 3">
                        @foreach($usuarios as $uan)
                            <option value="{{ $uan->id }}" data-tokens="{{ $uan->email }}" data-subtext="{{ $uan->identificacion }}" {{ (collect(old('propietariosAntiguo'))->contains($uan->id)) ? 'selected':'' }}>{{ $uan->nombres }} {{ $uan->apellidos }}</option>
                        @endforeach
                    </select>
                </div>



                {{--  propietarios actualues  --}}

                <div class="form-group">
                    <label for="propietariosActuales">Selecione propietario/s actual/es:<span class="text-danger">*</span></label>
                    <select class="selectpicker show-tick form-control" name="propietariosActuales[]" required="" data-live-search="true" title="Selecione propietario/s actual/es..." data-header="Selecione propietario/s actual/ess" multiple data-selected-text-format="count > 3">
                        @foreach($usuarios as $uac)
                            <option value="{{ $uac->id }}" data-tokens="{{ $uac->email }}" data-subtext="{{ $uac->identificacion }}" {{ (collect(old('propietariosActuales'))->contains($uac->id)) ? 'selected':'' }}>{{ $uac->nombres }} {{ $uac->apellidos }}</option>
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
            
          </div>
      </div>
    <button type="submit" class="btn btn-primary">{{__('Guardar')}} <i class="icon-paperplane ml-2"></i></button>
    </form>
  </div>
</div>

<script>
    $('#m_propiedades').addClass('active');
</script>
@endsection
