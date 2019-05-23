<!--Main sidebar -->
<div class="sidebar sidebar-light sidebar-main sidebar-expand-md">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        Navigación
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->


    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user-material">
            <div class="sidebar-user-material-body">
                <div class="card-body text-center">
                    <a href="#">
                        <img src="{{ asset('global_assets/images/demo/users/face6.jpg') }}" class="img-fluid rounded-circle shadow-1 mb-3" width="80" height="80" alt="">
                    </a>
                    <h6 class="mb-0 text-white text-shadow-dark">{{ Auth::user()->name }}</h6>
                    <span class="font-size-sm text-white text-shadow-dark">{{ Auth::user()->email }}</span>
                </div>
                                            
                <div class="sidebar-user-material-footer">
                    <a href="#user-nav" class="d-flex justify-content-between align-items-center text-shadow-dark dropdown-toggle" data-toggle="collapse">
                        <span>Mi cuenta</span>
                    </a>
                </div>
            </div>

            <div class="collapse" id="user-nav">
                <ul class="nav nav-sidebar">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="icon-user-plus"></i>
                            <span>Mi perfil</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="icon-coins"></i>
                            <span>My balance</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="icon-comment-discussion"></i>
                            <span>Messages</span>
                            <span class="badge bg-teal-400 badge-pill align-self-center ml-auto">58</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="icon-cog5"></i>
                            <span>Account settings</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="icon-switch2"></i>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /user menu -->


        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link" id="m_inicio">
                        <i class="fas fa-home"></i> <span>Inicio</span>
                    </a>
                </li>

                @role('Administrador')


                    <li class="nav-item">
                        <a href="{{ route('autoridades') }}" class="nav-link" id="m_autoridades">
                            <i class="fas fa-users-cog"></i> <span>Autoridades</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('asociaciones') }}" class="nav-link" id="m_asociacion">
                            <i class="fas fa-warehouse"></i> <span>Asociaciones</span>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="{{ route('cantones') }}" class="nav-link" id="m_canton">
                            <i class="fas fa-map-marked"></i> <span>Cantones</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('comunidadesLista') }}" class="nav-link" id="m_comunidad">
                        <i class="fas fa-map-marker-alt"></i> <span>Comunidades</span>
                        </a>
                    </li>


                @endrole

                

                @if(Auth::user()->roles('Asociacion'))
                
                @if(count(Auth::user()->periodosActivos)>0)
                    <li class="nav-item-header">
                        <div class="text-uppercase font-size-xs line-height-xs">Comunidades</div> 
                        <i class="icon-menu" title="Main"></i>
                    </li>
                    @foreach(Auth::user()->periodosActivos as $userPeriodoActivo)
                        
                        @if(count($userPeriodoActivo->comunidades)>0)

                            @foreach($userPeriodoActivo->comunidades as $comu)
                                <li class="nav-item">
                                    <a href="{{ route('propiedades',$comu->id) }}" class="nav-link" id="m_asociacionActivas{{ $userPeriodoActivo->id }}">
                                        <i class="fas fa-map-marker-alt"></i> <span>{{ $comu->nombre }}</span>
                                    </a>
                                </li>
                            @endforeach
                        @endif

                    @endforeach
                @endif

                @endif
              

            </ul>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->
    
</div>
<!-- /main sidebar