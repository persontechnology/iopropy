<!-- Footer -->
<div class="navbar navbar-expand-lg navbar-light">
    <div class="text-center d-lg-none w-100">
        <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
            <i class="icon-unfold mr-2"></i>
            Footer
        </button>
    </div>

    <div class="navbar-collapse collapse" id="navbar-footer">
        <span class="navbar-text">
            &copy; {{ date('Y') }}. <a href="{{ url('/') }}">Ficsh</a> by <a href="http://www.utc.edu.ec/" target="_blank">UTC</a>
        </span>

        <ul class="navbar-nav ml-lg-auto">
            <li class="nav-item"><a href="{{ route('soporte') }}" class="navbar-nav-link"><i class="icon-lifebuoy mr-2"></i> Soporte</a></li>
        </ul>
    </div>
</div>
<!-- /footer -->