@extends('layouts.app')

@section('breadcrumbs', Breadcrumbs::render('home'))

@section('acciones')

  <div class="breadcrumb justify-content-center">
    <a href="#" class="breadcrumb-elements-item">
        <i class="icon-comment-discussion mr-2"></i>
        Soporte
    </a>

    <div class="breadcrumb-elements-item dropdown p-0">
        <a href="#" class="breadcrumb-elements-item dropdown-toggle" data-toggle="dropdown">
            <i class="icon-gear mr-2"></i>
            Configuraciones
        </a>

        <div class="dropdown-menu dropdown-menu-right">
            <a href="#" class="dropdown-item"><i class="icon-user-lock"></i> Account security</a>
            <a href="#" class="dropdown-item"><i class="icon-statistics"></i> Analytics</a>
            <a href="#" class="dropdown-item"><i class="icon-accessibility"></i> Accessibility</a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item"><i class="icon-gear"></i> All settings</a>
        </div>
    </div>
</div>
@endsection


@section('content')

@if (session('status'))
    
    <div class="alert alert-success alert-styled-left alert-arrow-left alert-dismissible">
		<button type="button" class="close" data-dismiss="alert"><span>×</span></button>
		<span class="font-weight-semibold">{{ session('status') }}</span> 
	</div>
    
@endif

 <div class="card">
    <div class="card-header">Dashboard</div>

    <div class="card-body">
        You are logged in!
    </div>
</div>


<script>
    $('#m_inicio').addClass('active');
</script>
@endsection
