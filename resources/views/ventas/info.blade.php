@extends('layouts.app',['title'=>'Ventas'])
@section('breadcrumbs')
    {{ Breadcrumbs::render('ventas') }}
@endsection

@section('acciones')

  <div class="breadcrumb justify-content-center">
    <a href="{{ route('nuevoVenta') }}" class="breadcrumb-elements-item">
        <i class="fas fa-plus"></i>
        Nuevo venta
    </a>
</div>
@endsection

@section('content')
<div class="card">
  <div class="card-body">
    	<div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th class="text-center" colspan="3">
                        Información de venta 

                    </th>
                </tr>
                <tr>
                    <td>
                        <b>Número de venta:</b> {{ $venta->numero }}
                    </td>
                    <td>
                        <b>Fecha de ingreso:</b> {{ $venta->created_at }}
                    </td>
                    <td>
                            <b>Fecha última actualización:</b> {{ $venta->updated_at }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Precio:</b> {{ $venta->precio }}
                    </td>
                    <td>
                        <b>Medida total:</b>{{ $venta->medidaTotal }}
                    </td>
                    <td>
                        <b>Estado:</b> {{ $venta->estado }}
                    </td>
                </tr>
                
                @if(count($venta->propietariosIniciales)>0)
                <tr>
                    <th colspan="3" class="text-center">Propietarios iniciales</th>
                </tr>
                <tr>
                    
                    <td colspan="3">
                        <table class="table table-bordered">
                            <tr>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Cédula</th>
                                <th>Tipo identificación</th>
                                <th>Sexo</th>
                            </tr>
                            
                                @foreach ($venta->propietariosIniciales as $paVentaIni)
                                <tr>
                                    <td>{{ $paVentaIni->nombres }}</td>
                                    <td>{{ $paVentaIni->apellidos }}</td>
                                    <td>{{ $paVentaIni->identificacion }}</td>
                                    <td>{{ $paVentaIni->tipoIdentificacion }}</td>
                                    <td>{{ $paVentaIni->sexo }}</td>
                                </tr>
                                @endforeach
                            
                        </table>
                    </td>
                </tr>
                @endif
                <tr>
                    <th colspan="3" class="text-center">Propietarios antiguos</th>
                </tr>
                <tr>
                    <td colspan="3">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Cédula</th>
                                    <th>Tipo identificación</th>
                                    <th>Sexo</th>
                                </tr>
                                
                                    @foreach ($venta->propietariosAntiguos as $paVenta)
                                    <tr>
                                        <td>{{ $paVenta->nombres }}</td>
                                        <td>{{ $paVenta->apellidos }}</td>
                                        <td>{{ $paVenta->identificacion }}</td>
                                        <td>{{ $paVenta->tipoIdentificacion }}</td>
                                        <td>{{ $paVenta->sexo }}</td>
                                    </tr>
                                    @endforeach
                                
                            </table>
                    </td>
                </tr>

                <tr>
                    <th colspan="3" class="text-center">Propietarios actuales</th>
                </tr>
                <tr>
                    <td colspan="3">
                        <table class="table table-bordered">
                            <tr>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Cédula</th>
                                <th>Tipo identificación</th>
                                <th>Sexo</th>
                            </tr>
                            
                                @foreach ($venta->propietariosActuales as $paxVenta)
                                <tr>
                                    <td>{{ $paxVenta->nombres }}</td>
                                    <td>{{ $paxVenta->apellidos }}</td>
                                    <td>{{ $paxVenta->identificacion }}</td>
                                    <td>{{ $paxVenta->tipoIdentificacion }}</td>
                                    <td>{{ $paxVenta->sexo }}</td>
                                </tr>
                                @endforeach
                            
                        </table>
                    </td>
                </tr>
                
                <tr>
                    <th class="text-center" colspan="3">Información adicional </th>
                </tr>
                <tr>
                    <td colspan="2">
                        <b>Creado por:</b> 
                        {{ $venta->usuario($venta->usuarioCreado)->nombres??'' }} 
                        {{ $venta->usuario($venta->usuarioCreado)->apellidos??'' }}
                        {{ $venta->usuario($venta->usuarioCreado)->identificacion??'' }}
                    </td>
                    <td>
                        <b>Última actualización por:</b> 
                        {{ $venta->usuario($venta->usuarioEditado)->nombres??'' }} 
                        {{ $venta->usuario($venta->usuarioEditado)->apellidos??'' }}
                        {{ $venta->usuario($venta->usuarioEditado)->identificacion??'' }}
                    </td>
                </tr>
            </table>

            <hr>
            @include('propiedades.datos',['propiedad'=>$venta->propiedad])
        </div>
  </div>
</div>


<script>
	$('#m_ventas').addClass('active');
</script>
@endsection
