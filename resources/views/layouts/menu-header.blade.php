@guest
@else
   <ul class="navbar-nav">
        <li class="nav-item">
            <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                <i class="icon-paragraph-justify3"></i>
            </a>
        </li>
    </ul>

<span class="navbar-text ml-md-3">
    <span class="badge badge-mark border-success-300 mr-2"></span>
    Bienvenido, {{ Auth::user()->name }}
</span>
@endguest

<ul class="navbar-nav ml-md-auto">
    

 
    @guest
        <li class="nav-item">
            <a class="navbar-nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
       
    @else


        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>

    @endguest
</ul>