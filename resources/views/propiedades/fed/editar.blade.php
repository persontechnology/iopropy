@extends('layouts.app',['title'=>'Autoridades'])

@section('breadcrumbs', Breadcrumbs::render('editarPropiedadFed',$propiedad))

@section('acciones')

  <div class="breadcrumb justify-content-center">
    <a href="{{ route('propiedadesFed') }}" class="breadcrumb-elements-item">
        <i class="fas fa-arrow-left"></i>
        Cancelar
    </a>
</div>
@endsection


@section('content')
<script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>

<style>
    #map {
        height: 100vh;
    }
</style>

<div class="card">

    <form action="{{ route('actualizarPropiedadFed') }}" method="post" enctype="multipart/form-data">
        <div class="card-header">
            <button type="submit" class="btn btn-primary">{{__('Actualizar')}} <i class="icon-paperplane ml-2"></i></button>
        </div>
        <div class="card-body">
            @csrf
            <input type="hidden" name="id" value="{{ $propiedad->id }}" required>
            <div class="row">
                <div class="col-md-6">
                    <fieldset>
                        <legend class="font-weight-semibold"><i class="icon-reading mr-2"></i> Complete la información de la propiedad</legend>
                        
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="codigo">Código:<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control{{ $errors->has('codigo') ? ' is-invalid' : '' }}" name="codigo" id="codigo" placeholder="Ingrese.." required="" value="{{ old('codigo',$propiedad->codigo) }}">
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
                                <input type="text" class="form-control{{ $errors->has('medidaTotal') ? ' is-invalid' : '' }}" name="medidaTotal" id="medidaTotal" placeholder="Ingrese.." required="" value="{{ old('medidaTotal',$propiedad->medidaTotal) }}">
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
                                <input type="text" class="form-control{{ $errors->has('linderoNorteCon') ? ' is-invalid' : '' }}" name="linderoNorteCon" id="linderoNorteCon" placeholder="Ingrese.." required="" value="{{ old('linderoNorteCon',$propiedad->linderoNorteCon) }}">
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
                                <input type="text" class="form-control{{ $errors->has('linderoSurCon') ? ' is-invalid' : '' }}" name="linderoSurCon" id="linderoSurCon" placeholder="Ingrese.." required="" value="{{ old('linderoSurCon',$propiedad->linderoSurCon) }}">
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
                                <input type="text" class="form-control{{ $errors->has('linderoEsteCon') ? ' is-invalid' : '' }}" name="linderoEsteCon" id="linderoEsteCon" placeholder="Ingrese.." required="" value="{{ old('linderoEsteCon',$propiedad->linderoEsteCon) }}">
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
                                <input type="text" class="form-control{{ $errors->has('linderoOesteCon') ? ' is-invalid' : '' }}" name="linderoOesteCon" id="linderoOesteCon" placeholder="Ingrese.." required="" value="{{ old('linderoOesteCon',$propiedad->linderoOesteCon) }}">
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
                                <input type="text" class="form-control{{ $errors->has('precioEstimado') ? ' is-invalid' : '' }}" name="precioEstimado" id="precioEstimado" placeholder="Ingrese.." required="" value="{{ old('precioEstimado',$propiedad->precioEstimado) }}">
                                @if ($errors->has('precioEstimado'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('precioEstimado') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
    
                        {{--  servivicios basico  --}}
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" >Tiene servicios básicos:<span class="text-danger">*</span></label>
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input {{ $errors->has('serviciosBasicos') ? ' is-invalid' : '' }}" value="1" id="serviciosBasicosSi" name="serviciosBasicos"  required {{ old('serviciosBasicos',$propiedad->serviciosBasicos)=='1'?'checked':'checked' }}>
                                <label class="custom-control-label" for="serviciosBasicosSi">Si</label>
                            </div>
                            <div class="custom-control custom-radio mb-3">
                                <input type="radio" class="custom-control-input{{ $errors->has('serviciosBasicos') ? ' is-invalid' : '' }}" value="0" id="serviciosBasicosNo" name="serviciosBasicos" required {{ old('serviciosBasicos',$propiedad->serviciosBasicos)=='0'?'checked':'' }}>
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
                            <label class="col-lg-3 col-form-label" >Tiene casa:<span class="text-danger">*</span></label>
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input {{ $errors->has('tieneCasa') ? ' is-invalid' : '' }}" value="1" id="tieneCasaSi" name="tieneCasa"  required {{ old('tieneCasa',$propiedad->tieneCasa)=='1'?'checked':'checked' }}>
                                <label class="custom-control-label" for="tieneCasaSi">Si</label>
                            </div>
                            <div class="custom-control custom-radio mb-3">
                                <input type="radio" class="custom-control-input{{ $errors->has('tieneCasa') ? ' is-invalid' : '' }}" value="0" id="tieneCasaNo" name="tieneCasa" required {{ old('tieneCasa',$propiedad->tieneCasa)=='0'?'checked':'' }}>
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
                                <input type="radio" class="custom-control-input {{ $errors->has('camino') ? ' is-invalid' : '' }}" value="1" id="CaminoSi" name="camino"  required {{ old('camino',$propiedad->camino)=='1'?'checked':'checked' }}>
                                <label class="custom-control-label" for="CaminoSi">Si</label>
                            </div>
                            <div class="custom-control custom-radio mb-3">
                                <input type="radio" class="custom-control-input{{ $errors->has('camino') ? ' is-invalid' : '' }}" value="0" id="CaminoNo" name="camino" required {{ old('camino',$propiedad->camino)=='0'?'checked':'' }}>
                                <label class="custom-control-label" for="CaminoNo">No</label>
                                
                                @if ($errors->has('camino'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('camino') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        
    
                        {{--  propietarios antiguos  --}}
                        <div class="form-group">
                            <label for="propietariosAntiguo">Selecione propietario/s antiguo/s:<span class="text-danger">*</span></label>
                            <select class="selectpicker show-tick form-control" name="propietariosAntiguo[]" required="" data-live-search="true" title="Selecione propietario/s antiguo/s..." data-header="Selecione propietario/s antiguo/s" multiple data-selected-text-format="count > 3">
                                @foreach($propietariosAntiguos as $pact)
                                    <option value="{{ $pact->id }}" data-tokens="{{ $pact->email }}" data-subtext="{{ $pact->identificacion }}" {{ (collect(old('propietariosAntiguo'))->contains($pact->id)) ? 'selected':'selected' }}>{{ $pact->nombres }} {{ $pact->apellidos }}</option>
                                @endforeach
                                @foreach($usuariosAntiguos as $uact)
                                    <option value="{{ $uact->id }}" data-tokens="{{ $uact->email }}" data-subtext="{{ $uact->identificacion }}" {{ (collect(old('propietariosAntiguo'))->contains($uact->id)) ? 'selected':'' }}>{{ $uact->nombres }} {{ $uact->apellidos }}</option>
                                @endforeach
                                
                            </select>
                        </div>
    
    
    
                        {{--  propietarios actualues  --}}
    
                        <div class="form-group">
                            <label for="propietariosActuales">Selecione propietario/s actual/es:<span class="text-danger">*</span></label>
                            <select class="selectpicker show-tick form-control" name="propietariosActuales[]" required="" data-live-search="true" title="Selecione propietario/s actual/es..." data-header="Selecione propietario/s actual/ess" multiple data-selected-text-format="count > 3">
                                @foreach($propietariosActuales as $pactx)
                                    <option value="{{ $pactx->id }}" data-tokens="{{ $pactx->email }}" data-subtext="{{ $pactx->identificacion }}" {{ (collect(old('propietariosActuales'))->contains($pactx->id)) ? 'selected':'selected' }}>{{ $pactx->nombres }} {{ $pactx->apellidos }}</option>
                                @endforeach
                                @foreach($usuariosActuales as $uactx)
                                    <option value="{{ $uactx->id }}" data-tokens="{{ $uactx->email }}" data-subtext="{{ $uactx->identificacion }}" {{ (collect(old('propietariosActuales'))->contains($uactx->id)) ? 'selected':'' }}>{{ $uactx->nombres }} {{ $uactx->apellidos }}</option>
                                @endforeach
                                
                            </select>
                        </div>
    
                        
    
                    </fieldset>
                    
                </div>
            </div>
    
            <div class="row">
                <div class="col">
                    <label for="detalle">Detalle</label>
                    <textarea name="detalle" id="detalle">{{ $propiedad->detalle }}</textarea>
                </div>
            </div>
            
            <input type="hidden" name="latitud" id="latitud" value="{{ $propiedad->latitud }}">
            <input type="hidden" name="longitud" id="longitud" value="{{ $propiedad->longitud }}">
            <div class="row mt-1">
                <div class="col">
                    <label for="">Ubicación</label>
                    <div id="map"></div>
                        
                </div>
            </div>
        </div>
        <div class="card-footer text-muted">
            <button type="submit" class="btn btn-primary mt-2 btn-lg">{{__('Actualizar')}} <i class="icon-paperplane ml-2"></i></button>
        </div>
    </form>

</div>


<script>
	$('#m_propiedades').addClass('active');
        
    CKEDITOR.replace( 'detalle' );
    
</script>

<script>
        function initMap() {
            
            @if($propiedad->latitud && $propiedad->longitud)
            var uluru = { {{ $propiedad->posicion }} };
            @else
            var uluru = {lat: -2.601847, lng: -77.971980};
            @endif
            var map = new google.maps.Map(document.getElementById('map'), {
              zoom: 9,
              center: uluru
            });
    
            var contentString = '<p><b>Medida total</b>: {{ $propiedad->medidaTotal }}</p></br><p><b>Código</b>:{{ $propiedad->codigo }}</p>';
    
            var infowindow = new google.maps.InfoWindow({
              content: contentString
            });

            var marker = new google.maps.Marker({
              position: uluru,
              map: map,
              title: '{{ $propiedad->medidaTotal }}',
              draggable: true,
              animation: google.maps.Animation.DROP,
            });
            marker.addListener('click', function() {
              infowindow.open(map, marker);
            });
            google.maps.event.addListener(marker, 'dragend', function (event) {
                $('#latitud').val(this.getPosition().lat());
                $('#longitud').val(this.getPosition().lng());
            });
          }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD4bcJ39miYRDXIr4ux3484nqQP1XqS9Bw&libraries=places&callback=initMap"
async defer></script>
@endsection
