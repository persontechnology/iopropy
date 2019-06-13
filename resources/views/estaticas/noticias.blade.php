@extends('layouts.info',['title'=>'Noticias'])
@section('breadcrumbs', Breadcrumbs::render('noticias'))
@section('content')

<!--Section: Cards-->
<section class="wow fadeIn">


  <!--Grid row-->
  <div class="row mb-4 wow fadeIn">
      @if(count($not)>0)
    @foreach ($not as $n)
        
    
    <!--Grid column-->
    <div class="col-lg-4 col-md-12 mb-4">

      <!--Card-->
      <div class="card">

        <!--Card image-->
        <div class="view overlay">
          <img src="{{ Storage::url('public/noticias/'.$n->imagen) }}" class="card-img-top"
            alt="">
          <a href="{{ route('detalleNoticia',$n->id) }}">
            <div class="mask rgba-white-slight"></div>
          </a>
        </div>

        <!--Card content-->
        <div class="card-body">
          <!--Title-->
          <h4 class="card-title">
              {{ $n->titulo }}
          </h4>
          <!--Text-->
          {!!str_limit($n->detalle, $limit = 150, $end = '...')!!}
          <br>
          
        </div>
        <div class="card-foot">
          <a href="{{ route('detalleNoticia',$n->id) }}" class="btn btn-primary btn-md">Ver noticia
            <i class="fas fa-eye"></i>
          </a>
        </div>

      </div>
      <!--/.Card-->

    </div>
    <!--Grid column-->
    @endforeach
    @else
    <div class="alert alert-info" role="alert">
        No tenemos noticias por el momento
    </div>
    @endif
  </div>
  <!--Grid row-->

  <!--Pagination-->
  <nav class="d-flex justify-content-center wow fadeIn">
    {{ $not->links() }}
  </nav>
  <!--Pagination-->

</section>
<!--Section: Cards-->
<script>
    $('#m_noticias').addClass('active')
</script>
@endsection