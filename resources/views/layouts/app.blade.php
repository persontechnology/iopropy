<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @isset($title)
            {{ $title }} | 
        @endisset
        {{ config('app.name', 'FICSH') }}
    </title>
    <link rel='shortcut icon' type='image/x-icon' href='{{ asset('/img/favicon.ico') }}' />
     <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
      <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Global stylesheets -->
    <link href="{{ asset('fonts/roboto.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('fonts/icomoon/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('fonts/fontawesome/styles.min.css') }}">

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/bootstrap_limitless.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/layout.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/components.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/colors.min.css') }}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    
    <!-- Theme JS files -->
    <script src="{{ asset('vendor/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/buttons.min.js') }}"></script>

    <script src="{{ asset('vendor/forms/select2.min.js') }}"></script>
    <script src="{{ asset('vendor/forms/uniform.min.js') }}"></script>
    
    <link rel="stylesheet" href="{{ asset('vendor/select/css/bootstrap-select.min.css') }}">
    <script src="{{ asset('vendor/select/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('vendor/select/js/i18n/defaults-es_ES.js') }}"></script>
    
    {{-- jquery confirm --}}
    <link rel="stylesheet" href="{{ asset('vendor/jquery-confirm-v3.3.4/dist/jquery-confirm.min.css') }}">
    <script src="{{ asset('vendor/jquery-confirm-v3.3.4/dist/jquery-confirm.min.js') }}"></script>

    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('vendor/forms/form_layouts.js') }}"></script>
    
    <!-- /theme JS files -->

    {{-- others --}}
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>

    <style>
            
            .colorapp{
                background-color: #00695c!important;
            }
            form input[type="text"] {
                text-transform: uppercase;
            }
           
    </style>


</head>

<body>

    <!-- Main navbar -->
    <div class="navbar navbar-expand-md navbar-dark bg-success navbar-static colorapp">
        <div class="navbar-brand">
            <a href="{{ url('/') }}" class="d-inline-block">
                <img src="{{ asset('img/logo.png') }}" alt="">
            </a>
        </div>

        <div class="d-md-none">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
                <i class="icon-tree5"></i>
            </button>
            @guest
            @else
                <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
                    <i class="icon-paragraph-justify3"></i>
                </button>
            @endguest
        </div>

        <div class="collapse navbar-collapse" id="navbar-mobile">
            {{-- menu cabecera --}}
          
            @include('layouts.menu-header')
            
            {{-- fin menu cabecera --}}
        </div>
    </div>
    <!-- /main navbar -->


    <!-- Page content -->
    <div class="page-content">
    
        {{-- menu izquierdo solo cuando existe alogin --}}
        @guest
        @else
            @include('layouts.menu')
        @endguest
        {{-- fin menu login --}}


        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Page header -->
            <div class="page-header page-header-light">

                <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                    <div class="d-flex">
                        <div class="breadcrumb">
                            @yield('breadcrumbs')
                        </div>

                        @hasSection('acciones')
                            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                        @endif
                        
                    </div>

                    <div class="header-elements d-none">
                        @hasSection('acciones')
                            @yield('acciones')
                        @endif

                    </div>
                </div>
            </div>
            <!-- /page header -->


            <!-- Content area -->
            <div class="content">
                @include('layouts.alertas')
                @yield('content')
            </div>
            <!-- /content area -->

            {{-- menu footer --}}
            @include('layouts.footer')
            {{-- end menu footer --}}

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

    <script>
        $('table').on('draw.dt', function() {
            $('[data-toggle="tooltip"]').tooltip();
        })
       function eliminar(argument) {
           var url=$(argument).data('url');
           $.confirm({
                theme: 'dark',
                title: '¿Estás seguro?',
                content: 'Tu no podrás recuperar este información!',
                buttons: {
                    confirm: {
                        text: 'Confirmar <small>[enter]</small>',
                        btnClass: 'btn-default',
                        keys: ['enter'],
                        action: function(){
                            window.location.href = url;
                        }
                    },
                    cancel:  {
                        text: 'Cancelar <small>[esc]</small>',
                        btnClass: 'btn-danger',
                        keys: ['esc'],
                        action: function(){
                        }
                    }
                }
            });
       }


       function confirmar(argument) {
        var url=$(argument).data('url');
        $.confirm({
             theme: 'dark',
             title: '¿Estás seguro?',
             content: 'De confirmar esta acción!',
             buttons: {
                 confirm: {
                     text: 'Confirmar <small>[enter]</small>',
                     btnClass: 'btn-default',
                     keys: ['enter'],
                     action: function(){
                         window.location.href = url;
                     }
                 },
                 cancel:  {
                     text: 'Cancelar <small>[esc]</small>',
                     btnClass: 'btn-danger',
                     keys: ['esc'],
                     action: function(){
                     }
                 }
             }
         });
    }

    </script>

</body>
</html>
