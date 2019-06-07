<table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col" colspan="4" class="text-center">Información de propiedad</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td colspan="2"><b>Código: </b>{{ $propiedad->codigo }}</td>
            <td colspan="2"><b>Medida total: </b>{{ $propiedad->medidaTotal }}</td>
          </tr>
          <tr>
              <td><b>Precio estimado:</b> $ {{ $propiedad->precioEstimado }}</td>
              <td><b>Tiene camino:</b> {{ $propiedad->tieneCasa==true?'Si':'No' }}</td>
              <td><b>Tiene servicios básicos:</b> {{ $propiedad->tieneServiciosBasicos==true?'Si':'No' }}</td>
              <td><b>Tiene casa:</b> {{ $propiedad->tieneCamino==true?'Si':'No' }}</td>
          </tr>
          <tr>
              <th colspan="4" class="text-center">Ubicación</th>
          </tr>
          <tr>
            <td><b>Latitud:</b>{{ $propiedad->latitud ?? '' }}</td>
            <td><b>Longitud:</b>{{ $propiedad->longitud ??'' }}</td>
            <td colspan="2"><a href="https://maps.google.com/?q={{ $propiedad->latitud??'' }},{{ $propiedad->longitud??'' }}" target="_blanck">Ver en google maps</a></td>
          </tr>
          <tr>
            <td>
              <b>Comunidad: </b>{{ $propiedad->comunidad->nombre }}
            </td>
            <td><b>Parroquia: </b>{{ $propiedad->comunidad->parroquia->nombre }}</td>
            <td><b>Cantón: </b>{{ $propiedad->comunidad->parroquia->canton->nombre }}</td>
            <td><b>Provincia: </b>{{ $propiedad->comunidad->parroquia->canton->provincia->nombre }}</td>
          </tr>
          <tr>
            <td colspan="4"><b>Asociación: </b>{{ $propiedad->comunidad->asociacion->nombre }}</td>
          </tr>
  
          <tr>
            <th colspan="4" class="text-center">Linderos</th>
          </tr>
          <tr>
            <th scope="row">Lindero norte con:</th>
            <td>{{ $propiedad->linderoNorteCon }}</td>
            <th scope="row">Lindero sur con:</th>
            <td>{{ $propiedad->linderoSurCon }}</td>
          </tr>
          <tr>
            <th scope="row">Lindero este con:</th>
            <td>{{ $propiedad->linderoEsteCon }}</td>
            <th scope="row">Lindero oeste con:</th>
            <td>{{ $propiedad->linderoOesteCon }}</td>
          </tr>
          <tr>
            <th colspan="4" class="text-center">Propierios antiguos</th>
          </tr>
          <tr>
            <td colspan="4">
                <table class="table table-bordered">
                    <tr>
                      <th>Nombres</th>
                      <th>Apellidos</th>
                      <th>Cédula</th>
                      <th>Tipo identificación</th>
                      <th>Sexo</th>
                    </tr>
                    
                      @foreach ($propiedad->propietariosAntiguos as $pa)
                      <tr>
                          <td>{{ $pa->nombres }}</td>
                          <td>{{ $pa->apellidos }}</td>
                          <td>{{ $pa->identificacion }}</td>
                          <td>{{ $pa->tipoIdentificacion }}</td>
                          <td>{{ $pa->sexo }}</td>
                      </tr>
                      @endforeach
                    
                  </table>
            </td>
          </tr>
          <tr>
            <th colspan="4" class="text-center">Propierios actuales</th>
          </tr>
          <tr>
            <td colspan="4">
                <table class="table table-bordered">
                    <tr>
                      <th>Nombres</th>
                      <th>Apellidos</th>
                      <th>Cédula</th>
                      <th>Tipo identificación</th>
                      <th>Sexo</th>
                    </tr>
                    
                      @foreach ($propiedad->propietariosActuales as $pax)
                      <tr>
                          <td>{{ $pax->nombres }}</td>
                          <td>{{ $pax->apellidos }}</td>
                          <td>{{ $pax->identificacion }}</td>
                          <td>{{ $pax->tipoIdentificacion }}</td>
                          <td>{{ $pax->sexo }}</td>
                      </tr>
                      @endforeach
                    
                  </table>
            </td>
          </tr>
          <tr>
            <th colspan="4" class="text-center">Detalle</th>
          </tr>
          <tr>
            <td colspan="4">
              {!! $propiedad->detalle !!}
            </td>
          </tr>
          <tr>
            <th class="text-center" colspan="4">Información adicional</th>
          </tr>
          <tr>
            <td colspan="2">
              <b>Fecha creado:</b> {{ $propiedad->created_at }} {{ $propiedad->created_at->diffForHumans() }}
            </td>
            <td colspan="2">
                <b>Última actualización:</b> {{ $propiedad->updated_at }} {{ $propiedad->updated_at->diffForHumans() }}
            </td>
          </tr>
          <tr>
              <td colspan="2">
                  <b>Creado por:</b> 
                  {{ $propiedad->usuario($propiedad->usuarioCreado)->nombres??'' }}
                  {{ $propiedad->usuario($propiedad->usuarioCreado)->apellidos??'' }} - 
                  {{ $propiedad->usuario($propiedad->usuarioCreado)->identificacion??'' }}
              </td>
              <td colspan="2">
                  <b>Última actualización por:</b> 
                  {{ $propiedad->usuario($propiedad->usuarioEditado)->nombres ??'' }}
                  {{ $propiedad->usuario($propiedad->usuarioEditado)->apellidos ??''}} - 
                  {{ $propiedad->usuario($propiedad->usuarioEditado)->identificacion ??'' }}
  
              </td>
          </tr>
  
          
          
        </tbody>
      </table>