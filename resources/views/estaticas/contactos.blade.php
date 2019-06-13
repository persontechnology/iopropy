@extends('layouts.info',['title'=>'Contactos'])
@section('breadcrumbs', Breadcrumbs::render('contactos'))
@section('content')

<div class="container">

<div class="container">
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-center">
                    <h1 class="text-white"><strong>Escribenos</strong></h1>
                    <p class="text-white">
                        Nuestro equipo regresará a usted en cuestión de horas para ayudarlo.
                    </p>
                </div>

                <div class="card-body">
                    <form  action="{{ route('contactosEnviar') }}" method="POST">
                      @csrf
                        <!--Grid row-->
                        <div class="row">
                            
                         
                            <!--Grid column-->
                            <div class="col-md-6">
                                <div class="md-form mb-0 md-outline form-lg">
                                    <input type="text" id="nombre" name="nombre" class="form-control form-control-lg{{ $errors->has('nombre') ? ' is-invalid' : '' }}" required="" autofocus="" value="{{ old('nombre') }}">
                                    <label for="nombre" class="">Nombres y apellidos</label>
                                    @if ($errors->has('nombre'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nombre') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <!--Grid column-->

                            <!--Grid column-->
                            <div class="col-md-6">
                                <div class="md-form mb-0 md-outline form-lg">
                                    <input type="text" id="email" name="email" class="form-control form-control-lg{{ $errors->has('email') ? ' is-invalid' : '' }}" required="" value="{{ old('email') }}">
                                    <label for="email" class="">Correo electrónico</label>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <!--Grid column-->

                        </div>
                        <!--Grid row-->

                        <!--Grid row-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="md-form mb-0 md-outline form-lg">
                                    <input type="text" id="asunto" name="asunto" class="form-control form-control-lg{{ $errors->has('asunto') ? ' is-invalid' : '' }}" required="" value="{{ old('asunto') }}">
                                    <label for="asunto" class="">Asunto</label>
                                    @if ($errors->has('asunto'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('asunto') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!--Grid row-->

                        <!--Grid row-->
                        <div class="row">

                            <!--Grid column-->
                            <div class="col-md-12">
                                <div class="md-form md-outline">
                                    <textarea  id="mensaje" name="mensaje" rows="3" class="form-control{{ $errors->has('mensaje') ? ' is-invalid' : '' }}" required="">{{ old('mensaje') }}</textarea>
                                    <label for="mensaje">Su mensaje</label>
                                    @if ($errors->has('mensaje'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('mensaje') }}</strong>
                                        </span>
                                    @endif

                                </div>

                            </div>
                        </div>
                        <!--Grid row-->
                        <button class="btn btn-deep-purple" type="submit">Enviar</button>
                    </form>
                </div>

                <div class="card-foot">
                    <div id="map-container" class="z-depth-1-half map-container" style="height: 500px">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3986.1428377417346!2d-78.17393168523176!3d-2.459527038724894!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91cdf78be38254f7%3A0x96c2ec46319e9773!2sMercado+Federaci%C3%B3n+Shuar!5e0!3m2!1ses-419!2sec!4v1560441532628!5m2!1ses-419!2sec" width="100%;" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            
          <div class="card blue text-white p-1 mt-1">
            
                <blockquote class="blockquote">
                  <h1><strong>Contáctenos</strong></h1>
                  <h3>¿Tiene usted alguna pregunta? </h3>
                  <h5>Por favor no dude en contactarnos directamente.</h5>
                </blockquote>
            
          </div>

          <div class="card mt-2">
               
              <div class="card-body text-center">
                  <ul class="list-unstyled mb-0">
                    <li>
                        <i class="fas fa-map-marker-alt fa-2x"></i>
                        <p>"Sucua" <br><strong>Ecuador-Morona Santiago-Sucua</strong></p>

                    </li>

                    <li>
                        <i class="fas fa-phone mt-4 fa-2x"></i>
                        <p>+593 0982837920</p>

                    </li>

                    <li><i class="fas fa-envelope mt-4 fa-2x"></i>
                        <p>escorpel@hotmail.com<br>
                        info@centroficsh.com</p>
                    </li>
                </ul>
              </div>
          </div>


        </div>
    </div>
</div>  
</div>

<script>
    $('#m_contacto').addClass('active')
</script>
@endsection