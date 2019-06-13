@extends('layouts.info',['title'=>'Detalle de la noticia'])

@section('breadcrumbs', Breadcrumbs::render('detalleNoticia',$n))
@section('content')


<meta property="og:url"                content="{{ route('detalleNoticia',$n->id) }}" />
<meta property="og:type"               content="article" />
<meta property="og:title"              content="{{ $n->titulo }}" />
<meta property="og:image"              content="{{ Storage::url('public/noticias/'.$n->imagen) }}" />


<style>
        .card-comments img{width:4rem}
</style>
<!--Section: Cards-->
<section class=" wow fadeIn">

<div class="container">
        <!--Section: Post-->
        <section class="mt-4">
  
          <!--Grid row-->
          <div class="row">
  
            <!--Grid column-->
            <div class="col-md-8 mb-4">
  
              <!--Featured Image-->
              <div class="card mb-4 wow fadeIn">
  
                <img src="{{ Storage::url('public/noticias/'.$n->imagen) }}" class="img-fluid" alt="">
  
              </div>
              <!--/.Featured Image-->
  
              <!--Card-->
              <div class="card mb-4 wow fadeIn">
  
                <!--Card content-->
                <div class="card-body text-center">
  
                  <p class="h5 my-4">{{ $n->titulo }}</p>
  
                  <p>
                      Publicado por FISCH
                  </p>
  
                  <h5 class="my-4">
                    A las: {{ $n->updated_at }} <small>{{$n->updated_at->diffForHumans()}}</small>
                  </h5>
  
                </div>
  
              </div>
              <!--/.Card-->
  
              <!--Card-->
              <div class="card mb-4 wow fadeIn">
  
                <!--Card content-->
                <div class="card-body">
  
                  {!!$n->detalle!!}
  
                </div>

                <div class="card-foot my-2 text-center">
                  
                  <div id="fb-root"></div>
                  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v3.3&appId=1026388980848745&autoLogAppEvents=1"></script>
                  <div class="fb-share-button" data-href="{{ route('detalleNoticia',$n->id) }}" data-layout="button_count" data-size="large">
                    <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ route('detalleNoticia',$n->id) }}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Compartir</a>
                  </div>

                </div>
  
              </div>
              <!--/.Card-->
  
            @if($n->propiedad)
              
              <!--Card-->
              <div class="card mb-4 wow fadeIn">
  
                <div class="card-header font-weight-bold">
                  <span>Propiedad en venta</span>
                </div>
  
                <!--Card content-->
                <div class="card-body">
  
                  @include('propiedades.datos',['propiedad'=>$n->propiedad])
  
                </div>
  
              </div>
              <!--/.Card-->
            @endif

              <!--Comments-->
              <div class="card card-comments mb-3 wow fadeIn">
                <div class="card-header font-weight-bold">Comentarios</div>
                <div class="card-body">
  
                  <div id="fb-root"></div>
                  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v3.3&appId=1026388980848745&autoLogAppEvents=1"></script>
                  <div class="fb-comments" data-href="{{ route('detalleNoticia',$n->id) }}" data-width="" data-numposts="5"></div>
  
                </div>
              </div>
              <!--/.Comments-->
  
  
            </div>
            <!--Grid column-->
  
            <!--Grid column-->
            <div class="col-md-4 mb-4">
  
              <!--Card: Jumbotron-->
              <div class="card blue-gradient mb-4 wow fadeIn">
  
                <!-- Content -->
                <div class="card-body text-white text-center">
  
                  <h4 class="mb-4">
                    <strong>FICSH</strong>
                  </h4>
                  <p>
                    <strong>
                            Organismo de Promoción Humana de derecho privado regulada por las disposiciones del Código civil, con finalidad pública y social sin fines de lucro.
                    </strong>
                  </p>
  
                </div>
                <!-- Content -->
              </div>
              <!--Card: Jumbotron-->
  
              <!--Card : Dynamic content wrapper-->
              <div class="card mb-4 text-center wow fadeIn">
  
                <div class="card-header">Contactanos</div>
  
                <!--Card content-->
                <div class="card-body">
                    <div class="text-center">
                      <button class="btn btn-info btn-md" type="submit">Contactos</button>
                    </div>
                </div>
  
              </div>
              <!--/.Card : Dynamic content wrapper-->
  
              <!--Card-->
              <div class="card mb-4 wow fadeIn">
  
                <div class="card-header">Otras noticias</div>
  
                <!--Card content-->
                <div class="card-body">
  
                  <ul class="list-unstyled">
                    
                    @foreach ($not as $no)
                    <li class="media">
                        <img class="d-flex mr-3 imf-fluid" src="{{ Storage::url('public/noticias/'.$no->imagen) }}" alt="Generic placeholder image" width="70px;" height="70px;">
                        <div class="media-body">
                            <a href="{{ route('detalleNoticia',$no->id) }}">
                            <h5 class="mt-0 mb-1 font-weight-bold">
                                {{ $no->titulo }}
                            </h5>
                            </a>
                            {!!str_limit($no->detalle, $limit = 50, $end = '...')!!}
                        </div>
                    </li> 
                    @endforeach
                   

                  </ul>
  
                </div>
  
              </div>
              <!--/.Card-->
  
            </div>
            <!--Grid column-->
  
          </div>
          <!--Grid row-->
  
        </section>
        <!--Section: Post-->
</div>

</section>
<!--Section: Cards-->
<script>
    $('#m_noticias').addClass('active')
</script>
@endsection