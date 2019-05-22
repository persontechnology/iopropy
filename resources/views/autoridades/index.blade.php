@extends('layouts.app',['title'=>'Agregar autoridad en asociación'])


@section('breadcrumbs', Breadcrumbs::render('autoridadesAsociacion',$aso))

@section('acciones')
<div class="breadcrumb justify-content-center">
    
    <a href="{{ route('asociaciones') }}" class="breadcrumb-elements-item">
        <i class="fas fa-arrow-left"></i>
        atras
    </a>
</div>
@endsection


@section('content')
<div class="card">
    <div class="card-body">

        <form action="{{ route('agregarAutoridad') }}" method="post">
            @csrf
          <input type="hidden" name="asociacion" id="asociacion" value="{{ $aso->id }}" required="">
            @if(count($autoridades)>0)
                <div class="form-group">
                    <label for="autoridad">Selecione un usuario autoridad</label>
                    <select class="selectpicker show-tick form-control" name="autoridad" required="" data-live-search="true" title="Selecione una autoridad..." data-header="Selecione una autoridad" data-none-results-text="No hay resultados coincidentes {0} <a href='{{ route('nuevaAutoridad') }}' target='_blank'>Crear nueva autoridad</a>">
                        @foreach($autoridades as $au)
                            <option value="{{ $au->id }}" data-tokens="{{ $au->email }}" data-subtext="{{ $au->identificacion }}" {{ (old('autoridad') == $au->id ? 'selected':'') }}>{{ $au->nombres }} {{ $au->apellidos }}</option>
                        @endforeach
                      
                    </select>
                </div>
                @else
                <div class="alert alert-info alert-dismissible alert-styled-left fade show" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <strong>No existe asociaciones para crear una comunidad</strong>
                </div> 
            @endif

            <div class="form-group">
                <label for="autoridad">Rol</label>
                <input type="text" class="form-control" name="rol" id="rol" required="" placeholder="Ingrese.." value="{{ old('rol') }}">
            </div>


         <button type="submit" class="btn btn-primary">
                {{ __('Registrar') }}
            </button>
        
        </form>

       


    </div>
</div>
<div class="card">
    <div class="card-header">Listado</div>
    <div class="card-body">
         {!! $dataTable->table()  !!}
    </div>
</div>
{!! $dataTable->scripts() !!}

<script>
    $('#m_asociacion').addClass('active');

</script>
@endsection
