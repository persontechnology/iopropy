<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <meta property="og:url"                content="{{ url('/') }}" />
  <meta property="og:type"               content="article" />
  <meta property="og:title"              content="FEDERACION INTERPROVINCIAL DE CENTROS SHUAR" />
  <meta property="og:description"        content="Organismo de Promoción Humana de derecho privado regulada por las disposiciones del Código civil, con finalidad publica y social sin fines de lucro." />
  <meta property="og:image"              content="{{ asset('img/hombre.png') }}" />


  <title>
      @isset($title)
          {{ $title }} | 
      @endisset
      {{ config('app.name', 'FICSH') }}
  </title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="{{ asset('mdb/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="{{ asset('mdb/css/mdb.min.css') }}" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="{{ asset('mdb/css/style.css') }}" rel="stylesheet">
  <!-- JQuery -->
  <script type="text/javascript" src="{{ asset('mdb/js/jquery-3.4.1.min.js') }}"></script>
</head>

<body>

  <header>

    <!-- Navbar -->
    
        <nav class="{{ request()->is('/')?'navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar':'navbar fixed-top navbar-expand-lg navbar-dark default-color-dark' }}">
    
    

      <div class="container">

        <!-- Brand -->
        <a class="navbar-brand" href="{{ url('/') }}">
			<img src="{{ asset('img/hombre.png') }}" height="30" width="30" class="d-inline-block align-top img-thumbnail"
			alt="mdb logo"> <strong>FICSH</strong>
		</a>

        <!-- Collapse -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

          <!-- Left -->
          <ul class="navbar-nav mr-auto">
            <li class="nav-item" id="m_inicio">
              <a class="nav-link" href="{{ url('/') }}">Inicio
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item" id="m_nosotros">
              <a class="nav-link" href="{{ route('nosotros') }}">Nosotros</a>
            </li>
            <li class="nav-item" id="m_noticias">
              <a class="nav-link" href="{{ route('noticias') }}">Noticias</a>
            </li>
            <li class="nav-item" id="m_contacto">
              <a class="nav-link" href="{{ route('contactos') }}">Contactos</a>
            </li>
          </ul>

          <!-- Right -->
          <ul class="navbar-nav nav-flex-icons">
            <li class="nav-item">
              <a href="https://www.facebook.com/ficsh.sucuaecuador.9" class="nav-link" target="_blank">
                <i class="fab fa-facebook-f"></i>
              </a>
            </li>
            <li class="nav-item">
              <a href="https://twitter.com/FICSH7" class="nav-link" target="_blank">
                <i class="fab fa-twitter"></i>
              </a>
            </li>
            <li class="nav-item">
				@auth
					<a href="{{ route('home') }}" class="nav-link border border-light rounded">
						<i class="fas fa-house-damage mr-2"></i>Administración
					</a>
				@else
				<a href="{{ route('login') }}" class="nav-link border border-light rounded">
					<i class="fas fa-sign-in-alt mr-2"></i>INGRESAR
				</a>

				@endauth

              
            </li>
          </ul>

        </div>

      </div>
    </nav>
    <!-- Navbar -->
    @if (request()->is('/'))
    <style>
        /*welcome*/
        html,
        body,
        header,
        .carousel {
        height: 60vh;
        }

        @media (max-width: 740px) {

        html,
        body,
        header,
        .carousel {
            height: 100vh;
        }
        }

        @media (min-width: 800px) and (max-width: 850px) {

        html,
        body,
        header,
        .carousel {
            height: 100vh;
        }
        }

        @media (min-width: 800px) and (max-width: 850px) {
        .navbar:not(.top-nav-collapse) {
            background: #929FBA !important;
        }
        }
    </style>
    <!--Carousel Wrapper-->
    <div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel">

      <!--Indicators-->
      <ol class="carousel-indicators">
        <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-1z" data-slide-to="1"></li>
        <li data-target="#carousel-example-1z" data-slide-to="2"></li>
      </ol>
      <!--/.Indicators-->

      <!--Slides-->
      <div class="carousel-inner" role="listbox">

        <!--First slide-->
        <div class="carousel-item active">
          <div class="view" style="background-image: url('{{ asset('img/slider/3.jpg') }}'); background-repeat: no-repeat; background-size: cover;">

            <!-- Mask & flexbox options-->
            <div class="mask rgba-black-light d-flex justify-content-center align-items-center">

              <!-- Content -->
              <div class="text-center white-text mx-5 wow fadeIn">
                <h1 class="mb-4">
                  <strong>FICSH</strong>
                </h1>

                <p>
                  <strong>FEDERACIÓN INTERPROVINCIAL DE CENTROS SHUAR</strong>
                </p>

                <p class="mb-4 d-none d-md-block">
                  <strong>
						Organismo de Promoción Humana de derecho privado regulada por las disposiciones del Código civil, con finalidad publica y social sin fines de lucro.
				  </strong>
                </p>

              </div>
              <!-- Content -->

            </div>
            <!-- Mask & flexbox options-->

          </div>
        </div>
        <!--/First slide-->

        <!--Second slide-->
        <div class="carousel-item">
          <div class="view" style="background-image: url('{{ asset('img/slider/2.jpg') }}'); background-repeat: no-repeat; background-size: cover;">

            <!-- Mask & flexbox options-->
            <div class="mask rgba-black-light d-flex justify-content-center align-items-center">

              <!-- Content -->
              <div class="text-center white-text mx-5 wow fadeIn">
                <h1 class="mb-4">
                  <strong>ACUERDO MINISTERIAL</strong>
                </h1>

                <p>
                  <strong>N° 2568</strong>
                </p>

                <p class="mb-4 d-none d-md-block">
                  <strong>
					OCTUBRE 22 DE 1964
				  </strong>
                </p>

              </div>
              <!-- Content -->

            </div>
            <!-- Mask & flexbox options-->

          </div>
        </div>
        <!--/Second slide-->

        <!--Third slide-->
        <div class="carousel-item">
          <div class="view" style="background-image: url('{{ asset('img/slider/1.jpg') }}'); background-repeat: no-repeat; background-size: cover;">

            <!-- Mask & flexbox options-->
            <div class="mask rgba-black-light d-flex justify-content-center align-items-center">

              <!-- Content -->
              <div class="text-center white-text mx-5 wow fadeIn">
                <h1 class="mb-4">
                  <strong>SISTEMA DE PROPIEDADES FICSH</strong>
                </h1>

                <p>
                  <strong>
                    Contamos con un sistema eficiente,ágil y de mayor rendimiento para la gestión de propiedades.
                  </strong>
                </p>

                <p class="mb-4 d-none d-md-block">
                  <strong>
					  SISTEMA WEB A MEDIDA, EN LINEA ACCESO Y DISPONIBLE 24/7 DE LA SEMANA
				  </strong>
                </p>

                <a href="{{ route('home') }}" class="btn btn-outline-white btn-lg">
                    <i class="fas fa-sign-in-alt"></i> Ingresar
                </a>
              </div>
              <!-- Content -->

            </div>
            <!-- Mask & flexbox options-->

          </div>
        </div>
        <!--/Third slide-->

      </div>
      <!--/.Slides-->

      <!--Controls-->
      <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
      <!--/.Controls-->

    </div>
    <!--/.Carousel Wrapper-->
    @endif
  </header>

  <!--Main layout-->


     


    @if (request()->is('/'))
        <main>
    @else
        <main class="mt-4 pt-4">
    @endif
    <div class="container">

        @hasSection('breadcrumbs')
          <section class="my-4">
              @yield('breadcrumbs')
          </section>  
        @endif

        @foreach (['success', 'warn', 'info', 'danger'] as $msg)
          @if(Session::has($msg))
                            
              <div class="alert alert-{{ $msg }} alert-dismissible fade show" role="alert">
                <strong>
                    {{ Session::get($msg) }}
                </strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

          @endif
        @endforeach

        @if ($errors->any())
      
          <div class="alert alert-danger alert-dismissible fade show border-danger" role="alert">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li><strong>{{ $error }}</strong></li>
                  @endforeach
              </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif

        @yield('content')

    </div>
  </main>
  <!--Main layout-->


  <div class="modal fade" id="modalDirectivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		  <div class="modal-content">
			<div class="modal-header">
			  <h5 class="modal-title" id="exampleModalLongTitle">Directivos</h5>
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<div class="modal-body">
			  <img src="" id="imgDirectivo" alt="" class="img-fluid">
			</div>
			<div class="modal-footer">
			  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			</div>
		  </div>
		</div>
	  </div>

  <!--Footer-->
  <footer class="page-footer text-center font-small mt-4 wow fadeIn">

    <!--Call to action-->
    <div class="pt-4">
      <a class="btn btn-outline-white" href="{{ route('contactos') }}" role="button">Contactanos
        <i class="fas fa-envelope"></i>
      </a>
    </div>
    <!--/.Call to action-->

    <hr class="my-4">

    <!-- Social icons -->
    <div class="pb-4">
      <a href="https://www.facebook.com/ficsh.sucuaecuador.9" target="_blank">
        <i class="fab fa-facebook-f mr-3"></i>
      </a>

      <a href="https://twitter.com/FICSH7" target="_blank">
        <i class="fab fa-twitter mr-3"></i>
	  </a>
	  
    </div>
    <!-- Social icons -->

    <!--Copyright-->
    <div class="footer-copyright py-3">
      © {{ date('Y') }} Copyright:
      <a href="{{ url('/') }}"> centroficsh.com </a>
    </div>
    <!--/.Copyright-->

  </footer>
  <!--/.Footer-->

  <!-- SCRIPTS -->
  
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="{{ asset('mdb/js/popper.min.js') }}"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="{{ asset('mdb/js/bootstrap.min.js') }}"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="{{ asset('mdb/js/mdb.min.js') }}"></script>
  <!-- Initializations -->
  <script type="text/javascript">
    // Animations initialization
    new WOW().init();


	function verDirectivo(arg){
		$('#modalDirectivo').modal('show');
		$('#imgDirectivo').attr('src',$(arg).data('url'));
	}

  </script>
</body>

</html>
