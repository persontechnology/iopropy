@extends('layouts.app',['title'=>'Autoridades'])

@section('breadcrumbs', Breadcrumbs::render('nuevaPropiedad',$comu))

@section('acciones')

  <div class="breadcrumb justify-content-center">
    <a href="{{ route('propiedades',$comu->id) }}" class="breadcrumb-elements-item">
        <i class="fas fa-arrow-left"></i>
        Cancelar
    </a>
</div>
@endsection


@section('content')

<script src="https://cdn.ckeditor.com/ckeditor5/12.1.0/classic/ckeditor.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/12.1.0/classic/translations/es.js"></script>


<div class="card">
  <div class="card-body">
    <form action="{{ route('guardarAutoridad') }}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="row">
          <div class="col-md-6">
              <fieldset>
                  <legend class="font-weight-semibold"><i class="icon-reading mr-2"></i> Detalle personal</legend>

                  <div class="form-group row">
                      <label class="col-lg-3 col-form-label" for="medidaTotal">Medidad total<span class="text-danger">*</span></label>
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
                    <label class="col-lg-3 col-form-label" for="linderoNorteCon">linderoNorteCon<span class="text-danger">*</span></label>
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
                    <label class="col-lg-3 col-form-label" for="linderoSurCon">linderoSurCon<span class="text-danger">*</span></label>
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
                    <label class="col-lg-3 col-form-label" for="linderoEsteCon">linderoEsteCon<span class="text-danger">*</span></label>
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
                    <label class="col-lg-3 col-form-label" for="linderoOesteCon">linderoOesteCon<span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control{{ $errors->has('linderoOesteCon') ? ' is-invalid' : '' }}" name="linderoOesteCon" id="linderoOesteCon" placeholder="Ingrese.." required="" value="{{ old('linderoOesteCon') }}">
                        @if ($errors->has('linderoOesteCon'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('linderoOesteCon') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                

                {{--  latitud  --}}
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label" for="latitud">latitud<span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control{{ $errors->has('latitud') ? ' is-invalid' : '' }}" name="latitud" id="latitud" placeholder="Ingrese.." required="" value="{{ old('latitud') }}">
                        @if ($errors->has('latitud'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('latitud') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                {{--  longitud  --}}
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label" for="longitud">longitud<span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control{{ $errors->has('longitud') ? ' is-invalid' : '' }}" name="longitud" id="longitud" placeholder="Ingrese.." required="" value="{{ old('longitud') }}">
                        @if ($errors->has('longitud'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('longitud') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                
                {{--  precio estimado  --}}
                
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label" for="precioEstimado">precioEstimado<span class="text-danger">*</span></label>
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
                    <label class="col-lg-3 col-form-label" >serviciosBasicos:<span class="text-danger">*</span></label>
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input {{ $errors->has('serviciosBasicos') ? ' is-invalid' : '' }}" value="Si" id="serviciosBasicosSi" name="serviciosBasicos"  required {{ old('serviciosBasicos')=='Si'?'checked':'checked' }}>
                        <label class="custom-control-label" for="serviciosBasicosSi">Si</label>
                    </div>
                    <div class="custom-control custom-radio mb-3">
                        <input type="radio" class="custom-control-input{{ $errors->has('serviciosBasicos') ? ' is-invalid' : '' }}" value="No" id="serviciosBasicosNo" name="serviciosBasicos" required {{ old('serviciosBasicos')=='No'?'checked':'' }}>
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
                    <label class="col-lg-3 col-form-label" >tieneCasa:<span class="text-danger">*</span></label>
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input {{ $errors->has('tieneCasa') ? ' is-invalid' : '' }}" value="Si" id="tieneCasaSi" name="tieneCasa"  required {{ old('tieneCasa')=='Si'?'checked':'checked' }}>
                        <label class="custom-control-label" for="tieneCasaSi">Si</label>
                    </div>
                    <div class="custom-control custom-radio mb-3">
                        <input type="radio" class="custom-control-input{{ $errors->has('tieneCasa') ? ' is-invalid' : '' }}" value="No" id="tieneCasaNo" name="tieneCasa" required {{ old('tieneCasa')=='No'?'checked':'' }}>
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
                        <input type="radio" class="custom-control-input {{ $errors->has('camino') ? ' is-invalid' : '' }}" value="Si" id="CaminoSi" name="camino"  required {{ old('camino')=='Si'?'checked':'checked' }}>
                        <label class="custom-control-label" for="CaminoSi">Si</label>
                    </div>
                    <div class="custom-control custom-radio mb-3">
                        <input type="radio" class="custom-control-input{{ $errors->has('camino') ? ' is-invalid' : '' }}" value="No" id="CaminoNo" name="camino" required {{ old('camino')=='No'?'checked':'' }}>
                        <label class="custom-control-label" for="CaminoNo">No</label>
                        
                        @if ($errors->has('camino'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('camino') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

              </fieldset>
          </div>

          <div class="col-md-6">
              <fieldset>
                  <legend class="font-weight-semibold"><i class="icon-truck mr-2"></i> Información de cuenta</legend>

             
                {{--  detalle  --}}
                  <div class="form-group row">
                      <div class="col-lg-12">
                          <label for="detalle">Detalle</label>
                          
                          <textarea id="detalle" name="detalle" class="form-control{{ $errors->has('detalle') ? ' is-invalid' : '' }}">{{ old('name') }}</textarea>

                          @if ($errors->has('detalle'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('detalle') }}</strong>
                              </span>
                          @endif
                      </div>
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
	$('#m_miasociaciones').addClass('active');
    $('#tipoIdentificacion').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
        var tp=clickedIndex;
        if (tp==5) {
            $('#identificacion').val('0000000000');
        }else{
            $('#identificacion').val('')
        }
    });

    ClassicEditor.create( document.querySelector( '#detalle' ),{
        language: 'es'
    } )
    .catch( error => {
        console.error( error );
    } );
</script>
@endsection
